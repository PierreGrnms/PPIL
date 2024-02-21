<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AjoutDispoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('selectedDate', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date',
        ])
        ->add('debutPlageHoraire', TimeType::class, [
            'label' => 'Début de la plage horaire',
            
        ])
        ->add('finPlageHoraire', TimeType::class, [
            'label' => 'Fin de la plage horaire',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
