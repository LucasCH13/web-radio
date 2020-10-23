<?php
// src/Controller/AdminController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController {

    /**
     * @Route("/administration", name="admin") 
     */
    public function index_admin() {
        return $this->render('admin.html.twig', [
        ]);
    }
}