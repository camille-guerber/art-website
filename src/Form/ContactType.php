<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'required' => true,
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Votre addresse mail',
                'required' => true,
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet',
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'required' => true,
            ])
            ->add('envoyer', SubmitType::class, [
                'label' => 'Envoyer le message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
