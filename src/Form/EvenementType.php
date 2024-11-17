<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreEvenement', TextType::class, [
                'label' => 'Titre de l\'événement',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le titre de l\'événement',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Décrivez l\'événement',
                    'rows' => 5,
                ],
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le lieu de l\'événement',
                ],
            ])
            ->add('nombrePlaces', IntegerType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Indiquez le nombre de places disponibles',
                ],
            ])
            ->add('dateEvenement', null, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('typeEvenement', TextType::class, [
                'label' => 'Type d\'événement',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le type d\'événement',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
