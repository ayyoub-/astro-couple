<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\AstroCouple;

class AstroCoupleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $personIndex = $options['person_index'];
        $builder
            ->add('nom1', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('date_naissance1', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance1', TextType::class, [
                'label' => 'Lieu de naissance'
            ])
            ->add('nom2', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('date_naissance2', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance2', TextType::class, [
                'label' => 'Lieu de naissance'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AstroCouple::class,
            'person_index' => null,
        ]);
    }
}
