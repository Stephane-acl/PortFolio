<?php

namespace App\Form;

use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label'=>'Nom', 'empty_data' => ''])
            ->add('description', null,['label'=>'Description', 'empty_data' => ''])
            ->add('date',null,['label'=>'Date', 'empty_data' => ''])
            ->add('clients', null, ['choice_label' => 'name', 'empty_data'=> ''])
            ->add('technos', null, ['choice_label' => 'name', 'empty_data'=> ''])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
