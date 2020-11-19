<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Doctrine\DBAL\Abstraction\Result;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminController extends AbstractController {

    
    
    /**
     * @Route("/administration", name="admin") 
     */
    public function index_admin() {
        return $this->render('admin.html.twig', [
        ]);
        
    }
   /**
    * @Route("/administration/result"),name="ajouter_genre")
    * 
    */
    public function shoutcast_api_call(): Response {
       //j99MYuH7ghxGwq5p
    //http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=classic&limit=5,4
        
    $httpClient = HttpClient::create();
    $response = $httpClient->request('GET', 'http://api.shoutcast.com/station/randomstations?k=j99MYuH7ghxGwq5p&f=json&mt=audio/mpeg&br=128&genre=Rock&limit=1', [
        'headers' => [
            'Accept' => 'application/json',
        ],
     ]);  
        $content = $response->getContent();
      //  $content = $response->toArray();
        return new Response($content);
       
    }
    
}