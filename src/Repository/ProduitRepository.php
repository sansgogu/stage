<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * Recherche un terme dans tous les attributs textuels d'un produit
     * S'adapte automatiquement aux champs disponibles
     */
    public function rechercheTousAttributs(string $searchTerm): array
    {
        $metadata = $this->getEntityManager()->getClassMetadata(Produit::class);
        $fieldNames = $metadata->getFieldNames();
        
        $queryBuilder = $this->createQueryBuilder('p');
        $orX = $queryBuilder->expr()->orX();
        $hasSearchableField = false;
        
        foreach ($fieldNames as $field) {
            $fieldType = $metadata->getTypeOfField($field);
            
            // Ne rechercher que dans les champs de type string
            if (in_array($fieldType, ['string', 'text'])) {
                $orX->add($queryBuilder->expr()->like("p.$field", ':searchTerm'));
                $hasSearchableField = true;
            }
        }
        
        if (!$hasSearchableField) {
            // Fallback si aucun champ textuel n'est trouvé
            return $this->findAll();
        }
        
        return $queryBuilder
            ->where($orX)
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Méthode alternative avec champs spécifiques
     * (À utiliser une fois que vous connaissez les vrais noms de champs)
     */
    public function rechercheParChampsSpecifiques(string $searchTerm): array
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $orX = $queryBuilder->expr()->orX();
        
        // Liste des champs possibles - ajustez selon votre entité réelle
        $possibleFields = ['titre', 'name', 'title', 'designation', 'libelle'];
        
        foreach ($possibleFields as $field) {
            if (property_exists(Produit::class, $field)) {
                $orX->add($queryBuilder->expr()->like("p.$field", ':searchTerm'));
            }
        }
        
        // Si aucun champ standard n'est trouvé, chercher dans tous les champs string
        if ($orX->count() === 0) {
            return $this->rechercheTousAttributs($searchTerm);
        }
        
        return $queryBuilder
            ->where($orX)
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}