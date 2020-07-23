<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label'=>'Nom', 'empty_data' => ''])
            ->add('description', null,['label'=>'Description', 'empty_data' => ''])
            ->add('date',null,['label'=>'Date', 'empty_data' => ''])
            ->add('client', null, ['choice_label' => 'name', 'empty_data'=> ''])
            ->add('techno', null, ['choice_label' => 'name', 'empty_data'=> ''])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
