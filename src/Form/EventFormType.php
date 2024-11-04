<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Evenement;
use App\Entity\Professeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreEvenement', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le titre de l\'événement ne peut pas être vide.']),
                ],
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide.']),
                ],
            ])
            ->add('lieu', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le lieu ne peut pas être vide.']),
                ],
            ])
            ->add('nombrePlaces', IntegerType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nombre de places ne peut pas être vide.']),
                    new Range([
                        'min' => 1,
                        'minMessage' => 'Le nombre de places doit être au moins {{ limit }}.',
                    ]),
                ],
            ])
            ->add('dateEvenement', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'La date de l\'événement ne peut pas être vide.']),
                ],
            ])
            ->add('typeEvenement', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le type d\'événement ne peut pas être vide.']),
                ],
            ])
            ->add('ref_professeur', EntityType::class, [
                'class' => Professeur::class,
                'choice_label' => 'id',
                'label' => 'Professeur',
            ])
            ->add('ref_entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'id',
                'label' => 'Entreprise',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}