<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est obligatoire.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.',
                    ]),
                ],
            ])
            ->add('nom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/u',
                        'message' => 'Votre nom contient des caractères spéciaux non valides.'
                    ]),
                ],
            ])
            ->add('prenom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prénom est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/u',
                        'message' => 'Votre prénom contient des caractères spéciaux non valides.'
                    ]),
                ],
            ])
            ->add('nom_de_la_rue', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de la rue est obligatoire',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/u',
                        'message' => 'Le nom de la rue contient des caractères spéciaux non valides.'
                    ]),
                ],
            ])
            ->add('numero_rue', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le numéro de rue est obligatoire.',
                    ]),
                ],
            ])
            ->add('code_postal', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le code postal est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/',
                        'message' => 'Le code postal doit se composer de 5 chiffres et doit être valide.',
                    ]),
                ],
            ])
            ->add('ville', ChoiceType::class, [
                'choices' => null,
                'label' => 'Villes',
                'placeholder' => $options['data']->getVille(),
            ])
            ->add('numero_telephone', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le numéro de téléphone est obligatoire.',
                    ]),
                    new Regex([
                        'pattern' => '/^\+(?:\d{1,4}\-?)?\(?\d{1,}\)?[\s\-]?\d{1,}[\s\-]?\d{1,}[\s\-]?\d{1,}$/',
                        'message' => 'Votre numéro de téléphone n\'est pas valide. Il doit être sous le format international.',
                    ]),
                ],
            ])
        ;$builder->get('ville')->resetViewTransformers();

        /*$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
            $form = $event->getForm();
            $user = $options['data'];
            dd($user->getVille());
            $form->get("ville")->setData($user->getVille());
        });*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
