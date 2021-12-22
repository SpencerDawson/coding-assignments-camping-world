<?php
// src/Form/Type/CSVType.php
namespace App\Form\Type;

use App\Entity\Documents;
use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

use Symfony\UX\Dropzone\Form\DropzoneType;

class CSVType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', DropzoneType::class, [
                'label' => 'Campers (CSV file)',
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'data-controller' => 'import',
                    'placeholder' => 'Drag and drop or browse',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '10k',
                        'mimeTypes' => [
                            'text/plain',
                            'text/csv',
                            'application/vnd.ms-excel',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid csv document',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }

}