<?php
// src/Controller/CamperController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CamperController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'title' => 'Camping World - Index'
        ]);
    }

    public function import(): Response
    {
        return $this->render('import.html.twig', [
            'title' => 'Camping World - Import'
        ]);
    }

    public function info(): Response
    {
        return new Response(
            phpinfo()
        );
    }
}