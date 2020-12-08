<?php

namespace App\Form;

use App\Entity\Artist;
use App\Repository\StyleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArtistType extends AbstractType
{

    private $styleRepo;
    public function __construct(StyleRepository $styleRepository)
    {
        $this->styleRepo = $styleRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture', FileType::class, [
                'label' => "Choisissez une image",
                "mapped" => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Importer une image en .jpg .png .jpeg',
                    ])
                ],
            ])
            ->add('style', ChoiceType::class, [
                "choices" => $this->styleRepo->findAll(),
                "choice_label" => "name"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
