<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null,['label'=>'Nom', 'empty_data' => ''])
            ->add('password', null, ['label'=>'Mot de passe', 'empty_data' => ''])
            ->add('userFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false, // True to display a delete checkbox
                'download_uri' => false, // True to display a link of the picture
                'label' => "Photo",
                'attr' => ['placeholder' => 'Ajoutez votre photo ici']
            ])

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
