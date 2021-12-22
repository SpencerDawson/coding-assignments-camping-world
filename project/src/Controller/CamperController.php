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
     * Name "app_camper_list"
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $uploads = $em->getRepository("App\Entity\Documents")->findAll();

        return $this->render('camper-lists.html.twig', [
            'title' => 'Camping World - Index',
            'uploads' => $uploads,
        ]);
    }

    /**
     * Path "/{list_id}"
     * Name "app_camper"
     */
    public function show(string $list_id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $campers = $em->getRepository("App\Entity\Campers")->findBy(
            ['doc' => $list_id],
            ['price' => 'ASC'],
        );

        return $this->render('campers.html.twig', [
            'title' => 'Camping World - List '.$list_id,
            'campers' => $campers,
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
                    
                    // NOTE: Assumtions made here, see /README.md
                    $camper->setDoc($doc);
                    $camper->setMake(     strcmp($row[0], 'n/a') ? $row[0] : null);
                    $camper->setBrand(    strcmp($row[1], 'n/a') ? $row[1] : null);
                    $camper->setCapacity( strcmp($row[2], 'n/a') ? (int)$row[2] : null);
                    $camper->setPrice(    strcmp($row[3], 'n/a') ? (int)$row[3] : null);
                    
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