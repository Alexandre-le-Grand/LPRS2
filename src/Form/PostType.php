<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenuPost')  // Champ de texte pour le contenu
            ->add('titre')        // Champ pour le titre
            ->add('canal')         // Champ pour le canal
            // Suppression des champs date_heure_publication et ref_utilisateur
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'user' => null,  // Option pour passer l'utilisateur connecté
        ]);
    }
}
