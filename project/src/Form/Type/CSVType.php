<?php
// src/Form/Type/CSVType.php
namespace App\Form\Type;

// use App\Entity\Campers;
use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\UX\Dropzone\Form\DropzoneType;

class CSVType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', DropzoneType::class, [
                'label' => 'CSV File',
                'attr' => [
                    'data-controller' => 'import',
                    'placeholder' => 'Drag and drop or browse',
                ],
                // 'constraints' => [

                // ],
                'required' => true,
            ]);
    }

}