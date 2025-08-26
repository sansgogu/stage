<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Lignefacture;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignefactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('referencedeproduit')
            ->add('nom_de_produit')
            ->add('qte')
            ->add('prixunitaire')
            ->add('prixtotale')
            ->add('facture', EntityType::class, [
                'class' => Facture::class,
                'choice_label' => 'id',
            ])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lignefacture::class,
        ]);
    }
}
