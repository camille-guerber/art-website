<?php

namespace App\Form;

use App\Entity\Hashtag;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Couverture',
                'required' => true,
            ])
            ->add('imageFile2', VichImageType::class, [
                'label' => 'Image n°2',
                'required' => true,
            ])
            ->add('imageFile3', VichImageType::class, [
                'label' => 'Image n°3',
                'required' => true,
            ])
            ->add('hashtags', EntityType::class, [
                'class' => Hashtag::class,
                'label' => 'Hashtags (ctrl + clic pour en sélectionner plusieurs)',
                'multiple' => true,
                'expanded' => false,
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'query_builder' => function(EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('h')
                        ->orderBy('h.nom', 'ASC');
                }
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Ajouter',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
