<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom du produit'
                ]
            ])
            ->add('code', TextType::class, [
                'label' => 'Code produit',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le code du produit'
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Électronique' => 'electronique',
                    'Vêtements' => 'vetements',
                    'Maison & Jardin' => 'maison_jardin',
                    'Sports & Loisirs' => 'sports_loisirs',
                    'Livres' => 'livres',
                    'Automobile' => 'automobile',
                    'Beauté & Santé' => 'beaute_sante',
                    'Alimentaire' => 'alimentaire',
                    'Autre' => 'autre'
                ],
                'attr' => [
                    'class' => 'form-select'
                ],
                'placeholder' => 'Choisir une catégorie'
            ])
            ->add('prixachat', MoneyType::class, [
                'label' => 'Prix d\'achat',
                'currency' => 'EUR',
                'attr' => [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'min' => '0'
                ]
            ])
            ->add('prixvente', MoneyType::class, [
                'label' => 'Prix de vente',
                'currency' => 'EUR',
                'attr' => [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'min' => '0'
                ]
            ])
            ->add('quantiteinitiale', IntegerType::class, [
                'label' => 'Quantité initiale',
                'attr' => [
                    'class' => 'form-control',
                    'min' => '0',
                    'placeholder' => 'Quantité en stock'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}