<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
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
            /*->add('email', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email address',
                    ]),
                    new Email([
                        'message' => 'The email "{{ value }}" is not a valid email address.',
                    ]),
                ],
            ])*/
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/',
                        'message' => 'Your password must contain at least one lowercase letter, one uppercase letter, and one digit.',
                    ]),
                ],
            ])
            ->add('nom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your last name',
                    ]),
                ],
            ])
            ->add('prenom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your first name',
                    ]),
                ],
            ])
            ->add('nom_de_la_rue', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the street name',
                    ]),
                ],
            ])
            ->add('numero_rue', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the street number',
                    ]),
                ],
            ])
            ->add('code_postal', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the postal code',
                    ]),
                ],
            ])
            ->add('numero_telephone', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your phone number',
                    ]),
                    new Regex([
                        'pattern' => '/^\+(?:[0-9] ?){6,14}[0-9]$/',
                        'message' => 'Please enter a valid phone number with country code.',
                    ]),
                ],
            ])
            ->add('porte_monnaie', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your wallet information',
                    ]),
                    // Add any additional constraints for the wallet field
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
