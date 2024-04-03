<?php

namespace App\Form;

use App\Entity\Offre;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints as Assert;

class AjouterUneOffreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('choiceField', ChoiceType::class, [
            'choices' => [
                'Prêt' => 'pret',
                'Service' => 'service',
            ],
            'expanded' => true, 
            'label' => 'Il s\'agit d\'une offre de :',
        ])
            ->add('titre_offre',TextType::class, [
                'attr' => ['placeholder' => 'L\'intitulé de votre offre'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre titre ne doit pas être vide !',
                    ]),
                ], ])

            ->add('texte_offre',TextareaType::class,[
                'attr' => ['placeholder' => 'La description de votre offre']],)

            ->add('prix',NumberType::class,[
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d+$/', // Expression régulière pour vérifier que seuls des chiffres sont présents
                        'message' => 'Veuillez entrer uniquement des chiffres.',
                    ]),
                ],
                // Autres options de champ
            ])


            ->add('fichiers', FileType::class, [
                'label' => "Ajouter des images",

                'multiple' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Veuillez ajouter une image au format valide (JPEG, PNG, GIF).',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
