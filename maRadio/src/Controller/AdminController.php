<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

class AdminController extends AbstractController  {
    
    /**
     * @Route("/administration", name="admin") 
     * Affiche la page
     */
    public function index_admin() {
        return $this->render('admin.html.twig', [
        ]);
        
    }
    /**
     * @Route("/")
     * Affiche une radio aléatoire 
     * 
     */
    public function shoutcastAPI_random(): Response {
                $httpClient = HttpClient::create();

                    //requête vers l'api
                   
                        $response = $httpClient->request('GET',  'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&limit=1', [
                        
                        ]); 
                                               
                            $content = $response->toArray();
                            //on récupère dans $id et $base les valeurs pour construire l'url  :  http://yp.shoutcast.com/<base>?id=<id>
                            foreach($content as $arr)
                            {
                                foreach($arr["data"] as $val) 
                                {
                                    $id = $val["station"]["id"];
                                    $base = $val["tunein"]["base"];
                                    $logo = $val["station"]["logo"];
                                    $name = $val["station"]["name"];
                                } 
                            }
                             //On récupère le contenu du fichier .pls de l'API pour obtenir le lien audio de la radio
                             $lines =  file_get_contents("http://yp.shoutcast.com/".$base."?id=".$id. "");
                             $lien_audio = preg_split("/[\s,]+/", $lines);
                             $lien_audioValid = str_replace("File1=", "", $lien_audio);
                             
                  return new Response(
                            $this->renderView('index.html.twig',  [
                                'url_audio' => $lien_audioValid[2],
                                'logo' => $logo,
                                'name' => $name,
                            ]));

    }
    
    /**
     * @Route("/genre", name="genre")
     * Affiche sur la page /genre une station basée sur le genre sélectionné
     */
    public function shoutcastAPI_byGenre(): Response {
        $genre = $_POST['genreName'];
        $httpClient = HttpClient::create();

        //requête avec paramètre query prenant en compte le genre choisis
          $response = $httpClient->request('GET',  'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&genre=&limit=1', [
                        'query' => [
                            'genre' => $genre, 
                            ]
                        ]); 
                           
                        $content = $response->toArray();
                        foreach($content as $arr)
                        {
                            foreach($arr["data"] as $val) 
                            {
                                $id = $val["station"]["id"];
                                $base = $val["tunein"]["base"];
                                $logo = $val["station"]["logo"];
                                $name = $val["station"]["name"];
                            } 
                        }
                             $lines =  file_get_contents("http://yp.shoutcast.com/".$base."?id=".$id. "");
                             $lien_audio = preg_split("/[\s,]+/", $lines);
                             $lien_audioValid = str_replace("File1=", "", $lien_audio);

          return new Response(
              $this->renderView('genre.html.twig', [
                  'url_audioGenre' => $lien_audioValid[2],
                  'logoGenre' => $logo,
                  'nameGenre' => $name,
              ])
          );
        
    }
}