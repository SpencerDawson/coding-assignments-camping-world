<?php
// src/Controller/CamperController.php
namespace App\Controller;

use App\Entity\Documents;
use App\Form\Type\CSVType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CamperController extends AbstractController
{
    /**
     * Path "/"
     * Name "app_camper"
     */
    public function index(): Response
    {
        return $this->render('tables.html.twig', [
            'title' => 'Camping World - Index'
        ]);
    }

    /**
     * Path "/import"
     * Name "app_import"
     */
    public function import(Request $request, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(CSVType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $doc = new Documents();
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $csv */
            $csv = $form->get('file')->getData();
            // $csvFileName = $fileUploader->upload($csv);
            $doc->setName($fileUploader->upload($csv));
            $doc->setType();
            // $product->setBrochureFilename($csvFileName);
    
            return $this->redirectToRoute('app_camper', [
                'file_name' => $doc->getName(),
            ]);
        }

        return $this->renderForm('import.html.twig', [
            'title' => 'Camping World - Import',
            'form' => $form,
        ]);
    }

    public function info(): Response
    {
        return new Response(
            phpinfo()
        );
    }
}