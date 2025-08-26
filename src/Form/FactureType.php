<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence',
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'widget' => 'single_text', // input HTML5
            ])
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantité',
            ])
            ->add('total', MoneyType::class, [
                'label' => 'Total',
                'currency' => 'TND', // tu peux mettre EUR, USD...
            ])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'titre', // adapte selon ton champ dans Produit (ex: name, titre, etc.)
                'label' => 'Produit',
                'placeholder' => 'Choisir un produit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
