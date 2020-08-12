<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>' ', 'attr' => [
                'placeholder' => 'Nom *'],
                'empty_data' => ''])
            ->add('email', TextType::class, ['label'=>' ', 'attr' => [
                'placeholder' => 'E-mail *'],
                'empty_data' => ''])
            ->add('message', TextareaType::class, ['label'=>' ', 'attr' => [
                'placeholder' => 'Message *'],
                'empty_data' => '']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
