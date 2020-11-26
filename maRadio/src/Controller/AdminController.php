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
       
        //$response ='';
        $urlStation = '';
        $url_station_random = isset($_POST["url_station_random"]);
        $selectedGenre = isset($_POST["selectedGenre"]);
        $tunein_url = isset($_POST["tunein_url"]);
                $httpClient = HttpClient::create();
            
                    $response = $httpClient->request('GET',  'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&genre=&limit=1', [
                        'query' => [
                            'genre' => $selectedGenre,
                        ],
                       
                    ]);  
                        
                            //$content = $response->getContent();
                            
                            $content = $response->toArray();//
                            
                  return new Response(
                            $this->renderView('index.html.twig',  [
                                'data' => $content,
                                'tuneIn' => $tunein_url,
                            
                            ]));
            

    }
    
}