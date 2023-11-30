<?php

namespace App\Repository;

use App\Entity\ListeDeRecherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListeDeRecherche>
 *
 * @method ListeDeRecherche|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeDeRecherche|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeDeRecherche[]    findAll()
 * @method ListeDeRecherche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeDeRechercheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeDeRecherche::class);
    }

    public function add(ListeDeRecherche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ListeDeRecherche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ListeDeRechercheCrudController[] Returns an array of ListeDeRechercheCrudController objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ListeDeRechercheCrudController
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
