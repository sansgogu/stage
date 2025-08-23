<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produit1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('soustitre')
            ->add('prix')
            ->add('code')
            ->add('image' , FileType::class, [
                'label' => 'Image (JPG file)',
                'mapped' => false,
                'required' => false,
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
             ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
