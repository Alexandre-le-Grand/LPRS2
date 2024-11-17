<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreOffre', TextType::class, [
                'label' => 'Titre de l\'offre',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le titre de l\'offre',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Décrivez l\'offre',
                    'rows' => 5,
                ],
            ])
            ->add('typeOffre', TextType::class, [
                'label' => 'Type d\'offre',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le type de l\'offre',
                ],
            ])
            ->add('etatOffre', TextType::class, [
                'label' => 'État de l\'offre',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Indiquez l\'état de l\'offre',
                ],
            ])
            ->add('datePublication', null, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('ref_entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'id',
                'label' => 'Entreprise',
                'placeholder' => 'Sélectionnez une entreprise',
                'attr' => [
                    'class' => 'form-control',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
