<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null,['label'=>'Nom', 'empty_data' => ''])

            ->add('password', null, ['label'=>'Mot de passe', 'empty_data' => ''])
            ->add('picture',null,['label'=>'Photo', 'empty_data' => ''])
            ->add('linkedin',null, ['label'=>'Linkedin', 'empty_data' => ''])
            ->add('fonction', null, ['label'=>'Fonction', 'empty_data' => ''])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
