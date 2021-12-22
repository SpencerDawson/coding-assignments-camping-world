<?php
// src/Controller/CamperController.php
namespace App\Controller;

use App\Entity\Documents;
use App\Entity\Campers;
use App\Form\Type\CSVType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

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
    public function import(Request $request, FileUploader $fileUploader, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(CSVType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            /** @var UploadedFile $csv */
            $csv = $form->get('file')->getData();
            /** @var Documents $doc */
            $doc = new Documents();

            $doc->setPath("");
            $doc->setType($csv->getMimeType());
            $doc->setName($fileUploader->upload($csv));

            $em->persist($doc);
            $em->flush();

            $rowNo = 1;
            if (($fp = fopen($doc->getAbsolutePath().$doc->getName(),"r")) !== false)
            {
                while (($row = fgetcsv($fp, 1000, ",")) !== FALSE)
                {
                    if($rowNo == 1){ $rowNo++; continue; }
                    /** @var Campers $camper */
                    $camper = new Campers();
                    
                    $camper->setDoc($doc);
                    $camper->setMake($row[0]);
                    $camper->setBrand($row[1]);
                    $camper->setCapacity((int)$row[2]);
                    $camper->setPrice((int)$row[3]);
                    
                    $em->persist($camper);
                    $em->flush();
                    unset($camper);
                }
                fclose($fp);
            }

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