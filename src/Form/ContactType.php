<?php

namespace App\Form;

use Mael\MaelRecaptchaBundle\Type\MaelRecaptchaCheckboxType;
use Mael\MaelRecaptchaBundle\Validator\MaelRecaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Dupont'
                    ]
                ])


            ->add('prenom', TextType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Jean',
                    ]
                ])

            ->add('fonction', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 3, 'minMessage' => "Veuillez saisir minimum 3 caractères"]),
                    ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Médecin',
                    ]
                ])

            ->add('telephone', TelType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8, 'minMessage' => "Veuillez saisir minimum 8 caractères"]),
                    new Length(['max' => 14, 'maxMessage' => "Veuillez saisir minimum 14 caractères"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => '0312345678'
                    ]
                ])

            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'minMessage' => "Veuillez saisir minimum 6 caractères"]),
                        ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'mon@mail.com',
                ]
            ])

            ->add('objet', ChoiceType::class, [
                'choices'  => [
                    'Demande de démonstration' => 'Demande de démonstration',
                    'Information sur nos produits' => 'Information sur nos produits',
                    'Partenariat technique' => 'Partenariat technique',
                    'Autres (à préciser dans le message)'=> 'Autres'
                ],
                'required'   => true,
            ])

            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Veuillez saisir minimum 10 caractères"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Votre message (minimum 10 caractères.)',
                    'rows' => 8,
                    ]
                ])

            ->add('captcha_checkvox', MaelRecaptchaCheckboxType::class, [
                'constraints' =>[
                    new MaelRecaptcha()
                ]
            ])


            ->add('envoyer', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here


        ]);
    }
}
