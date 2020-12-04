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
     * Affiche une station random 
     * 
     */
    public function shoutcastAPI_random(): Response {
       //j99MYuH7ghxGwq5p
    //http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=classic&limit=5,4
        $selectedGenre = isset($_POST["selectedGenre"]);
       
                $httpClient = HttpClient::create();
            
                    $response = $httpClient->request('GET',  'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&genre=&limit=1', [
                        'query' => [
                            'genre' => $selectedGenre,
                        ],
                       
                    ]);
                   
                            //$content = $response->getContent();
                            $content = $response->toArray();
                            //on récupère dans $id et $base les valeurs pour construire l'url  :  http://yp.shoutcast.com/<base>?id=<id>
                            foreach($content as $arr)
                            {
                                foreach($arr["data"] as $val) 
                                {
                                    $id = $val["station"]["id"];
                                    $base = $val["tunein"]["base"];
                                } 
                            }
                            /*
                            $line = 0;
                                    $fh = fopen($myFile, 'r');

                                    while (($buffer = fgets($fh)) !== FALSE) {
                                    if ($line == 1) {
                                        // $buffer is the second line.
                                        break;
                                    }   
                                    $line++;
                                    }
                            */
                           
                           // $fichier = fopen("http://yp.shoutcast.com/".$base."?id=".$id. "", "r");
                           /*
                            if ($fichier) { 
                                while (!feof($fichier)) { 
                                    $lines[] = fgets($fichier, 4096); 
                                } 
                                fclose($fichier); 
                                preg_split("/(=)/", $lines);
                             } */
                             //$lines = file("http://yp.shoutcast.com/".$base."?id=".$id. "", FILE_IGNORE_NEW_LINES);
                             
                             $lines = explode("=", file_get_contents("http://yp.shoutcast.com/".$base."?id=".$id. ""));
                             
                             

                             /*
                             $str = 'Monsters are SUPER scary, bro!';
                                $del = array('a', 'b', 'c');

                                // In one fell swoop...
                                $arr = explode( $del[0], str_replace($del, $del[0], $str) ); 
                             */
                  return new Response(
                            $this->renderView('index.html.twig',  [
                                'content' => $content,
                                'data' => $id,
                                'base' => $base,
                                'url_audio' => $lines[2],
                            ]));
                          
                         
             
                  
    }
    
}