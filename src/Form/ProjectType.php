<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Techno;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label'=>'Nom', 'empty_data' => ''])
            ->add('description', null,['label'=>'Description', 'empty_data' => ''])
            ->add('date', DateType::class, [
                'label' => "Date",
                'format' => 'dd-MM-yyyy',
                "data" => new DateTime(),
            ])
            ->add('client', null, ['choice_label' => 'name', 'empty_data'=> ''])
            ->add('techno', EntityType::class, [
                'class' => Techno::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
                'label' => 'TechnoUsed\'s',
            ])
            ->add('nameRepo', null, ['label' => 'Repo associé', 'empty_data'=> ''])
            ->add('link', null, ['label' => 'Lien vers le projet', 'empty_data'=> ''])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
