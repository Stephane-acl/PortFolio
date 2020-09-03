<?php

namespace App\Form;

use App\Entity\Techno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class TechnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,['label'=>'Nom', 'empty_data' => ''])
            ->add('technoFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false, // True to display a delete checkbox
                'download_uri' => false, // True to display a link of the picture
                'label' => "Photo",
                'attr' => ['placeholder' => 'Ajoutez votre photo ici']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Techno::class,
        ]);
    }
}
