<?php
// src/Controller/AdminController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;



class AdminController extends AbstractController {

    /**
     * @Route("/administration", name="admin") 
     */
    public function index_admin() {
        return $this->render('admin.html.twig', [
        ]);
    }
    /**
     * @Route("/administration", name="button_test")
     * 
     */
    public function buttonCall(): Response {
       //j99MYuH7ghxGwq5p
    //http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=classic&limit=5,4

    $httpClient = HttpClient::create();
    $response = $httpClient->request('GET', 'http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=Rap&limit=2,1', [
        'headers' => [
            'Accept' => 'application/xhtml+xml',
        ],
     ]);  
        $content = $response->getContent();
        $content = $response->toArray();


       return new Response(
        '<html><body>'.$content.'</body></html>'
    );
    }
}