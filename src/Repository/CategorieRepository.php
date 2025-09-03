<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    /**
     * Recherche par nom de catégorie
     */
    public function searchByName(?string $term): array
    {
        $qb = $this->createQueryBuilder('c');

        if ($term) {
            $qb->andWhere('c.nom LIKE :term')
               ->setParameter('term', '%' . $term . '%');
        }

        return $qb->getQuery()->getResult();
    }
}
