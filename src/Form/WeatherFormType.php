<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class WeatherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchText', HiddenType::class)
            ->add('country', HiddenType::class)
            ->add('cityName', HiddenType::class)
            ->add('lat', HiddenType::class)
            ->add('lon', HiddenType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Sprawdź pogodę',
                'attr' => ['disabled' => true]
            ])
        ;
    }
}