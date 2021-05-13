<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Media|null find($id, $lockMode = null, $lockVersion = null)
 * @method Media|null findOneBy(array $criteria, array $orderBy = null)
 * @method Media[]    findAll()
 * @method Media[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    /**
     * Requête qui me permet de récuperer les articles en fonction de la recherche de l'utilisateur
     * @return Media[]
     */
     public function findWithSearch(Search $search)
    {
        $query = $this
            ->createQueryBuilder('m')
            ->select('c', 'm')
            ->join('m.category', 'c');

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('m.titre LIKE :string')
                ->orWhere('m.contenu LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        if (!empty($search->categories)) {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);
        }

        return $query->getQuery()->getResult();
    }



    // /**
    //  * @return Media[] Returns an array of Media objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Media
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
