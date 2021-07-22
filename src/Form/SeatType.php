<?php

namespace App\Form;

use App\Entity\Seat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Model',
                'attr' => [
                    'placeholder' => 'Marque'
                ]
            ])
            ->add('size', TextType::class, [
                'label' => 'Hauteur*Largeur*Profondeur',
                'attr' => [
                    'placeholder' => 'Hauteur: 85cm, Largeur:39cm, Profondeur: 52cm'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'help' => 'Uniquement en euros',
                'attr' => [
                    'placeholder' => '200'
                ]
            ])
            ->add('weight', TextType::class, [
                'label' => 'Limite Kg',
                'attr' => [
                    'placeholder' => '100Kg'
                ]
            ])
            ->add('density', TextType::class, [
                'label' => 'Densité de la mousse',
                'attr' => [
                    'placeholder' => '50Kg/m3'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Coussin appui-tête: oui, ...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seat::class,
        ]);
    }
}
