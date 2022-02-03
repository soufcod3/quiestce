<?php

namespace App\Form;

use App\Entity\Wilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WilderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('promo')
            ->add('hair')
            ->add('reconversion')
            ->add('glasses')
            ->add('beard')
            ->add('long_hair')
            ->add('children')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wilder::class,
        ]);
    }
}
