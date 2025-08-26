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
            ->add('titre', null, [
                'attr' => ['class' => 'form-control mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('soustitre', null, [
                'attr' => ['class' => 'form-control mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('prix', null, [
                'attr' => ['class' => 'form-control mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('code', null, [
                'attr' => ['class' => 'form-control mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image (JPG file)',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'attr' => ['class' => 'form-select mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'attr' => ['class' => 'form-select mb-3'],
                'label_attr' => ['class' => 'form-label fw-bold'],
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
