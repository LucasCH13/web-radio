<?php
// src/Controller/AdminController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;


class AdminController extends AbstractController {
    
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
        $selectedGenre = isset($_POST["selectedGenre"]);
        
                $httpClient = HttpClient::create();
                    //requête vers l'api
                    $response = $httpClient->request('GET',  'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&genre=&limit=1', [
                        'query' => [
                            'genre' => $selectedGenre,
                        ],
                       
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
                             //On récupère le contenue du fichier .pls de l'API pour obtenir le lien audio de la radio
                             $lines =  file_get_contents("http://yp.shoutcast.com/".$base."?id=".$id. "");
                             $lien_audio = preg_split("/[\s,]+/", $lines);
                             $lien_audio = str_replace("File1=", "", $lien_audio);
                             
                  return new Response(
                            $this->renderView('index.html.twig',  [
                                'content' => $content,
                                'data' => $id,
                                'base' => $base,
                                'url_audio' => $lien_audio[2],
                                'logo' => $logo,
                                'name' => $name,

                            ]));
                          
                         
             
                  
    }
    
}