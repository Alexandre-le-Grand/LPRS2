<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control m-2'],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est obligatoire']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control m-2'],
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom est obligatoire']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control m-2'],
                'constraints' => [
                    new NotBlank(['message' => 'L\'email est obligatoire']),
                    new Email(['message' => 'L\'email n\'est pas valide']),
                ],
            ]);

        // Only add terms checkbox for new registrations
        if (!$options['is_edit']) {
            $builder->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
                'attr' => ['class' => 'form-check-input m-2'],
                'label_attr' => ['class' => 'form-check-label'],
            ]);
        }

        // Add password field with different validation for edit/register
        $passwordConstraints = [
            new Length([
                'min' => 6,
                'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                'max' => 4096,
            ]),
        ];

        if (!$options['is_edit']) {
            $passwordConstraints[] = new NotBlank([
                'message' => 'Le mot de passe est obligatoire',
            ]);
        }

        $builder->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control m-2'
            ],
            'required' => !$options['is_edit'],
            'constraints' => $passwordConstraints,
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
        ]);

        // Add professor-specific fields if user has ROLE_PROFESSEUR
        if ($options['is_edit'] && $builder->getData() instanceof User && 
            in_array('ROLE_PROFESSEUR', $builder->getData()->getRoles())) {
            $builder
                ->add('discipline', TextType::class, [
                    'label' => 'Discipline',
                    'attr' => [
                        'class' => 'form-control m-2',
                        'maxlength' => 255,
                    ],
                    'required' => true,
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank(['message' => 'La discipline est obligatoire']),
                    ],
                ])
                ->add('formation', TextType::class, [
                    'label' => 'Formation',
                    'attr' => [
                        'class' => 'form-control m-2',
                        'maxlength' => 255,
                    ],
                    'required' => true,
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank(['message' => 'La formation est obligatoire']),
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false,
        ]);
    }
}