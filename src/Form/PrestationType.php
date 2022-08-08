<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Prestation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etablissement = new Etablissement();
        $builder
            ->add('price')
            ->add('type')
            ->add('paymentmethod', ChoiceType::class, [
                'choices' => [
                    'Espèce' => 'cash',
                    'Virement' => 'virement',
                    'Chèque' => 'cheque',
                    ]
            ])
            ->add('paymentstatus', ChoiceType::class, [
                    'choices' => [
                        'Payé' => 1,
                        'Non payé' => 0,
                    ]
                ])
            ->add('date', DateType::class, ['widget' => 'single_text'])
            ->add('etablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => function ($etablissement) {
                    return $etablissement->getCity() . ' - ' . $etablissement->getName();
                }
            ])
            ->add('startTime', TimeType::class, ['widget' => 'single_text'])
            ->add('endTime', TimeType::class, ['widget' => 'single_text'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
