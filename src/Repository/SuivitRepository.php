<?php

namespace App\Repository;

use App\Entity\Suivit;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Suivit>
 *
 * @method Suivit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Suivit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Suivit[]    findAll()
 * @method Suivit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuivitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Suivit::class);
    }

    public function add(Suivit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findSujetsByNature($nature)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.nature = :nature')
            ->setParameter('nature', $nature)
            ->getQuery()
            ->getResult();
    }
    
    // Ajoutez cette méthode pour trouver les valeurs distinctes de la nature
    public function findDistinctNatureValues()
    {
        return $this->createQueryBuilder('s')
            ->select('DISTINCT s.nature')
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Recherche de suivit en fonction de critères.
     *
     * @param array $criteria
     * @return Suivit[] Returns an array of Suivit objects
     */
    public function search(array $criteria): array
    {
        $queryBuilder = $this->createQueryBuilder('s');

        // Ajouter des conditions à la requête en fonction des valeurs passées
        if ($criteria['nature'] && $criteria['nature'] !== '' && isset($criteria['nature'])) {
            $queryBuilder
                ->andWhere('s.nature = :nature')
                ->setParameter('nature', $criteria['nature']);
        }

        if ($criteria['sujet'] && $criteria['sujet'] !== '' && isset($criteria['sujet'])) {
            $queryBuilder
                ->andWhere('s.sujet LIKE :sujet')
                ->setParameter('sujet', '%' . $criteria['sujet'] . '%');
        }

        if ($criteria['cout'] && $criteria['cout'] !== '' && isset($criteria['cout'])) {
            $queryBuilder
                ->andWhere('s.cout = :cout')
                ->setParameter('cout', $criteria['cout']);
        }

        if ($criteria['proprietaire'] && $criteria['proprietaire'] !== '' && isset($criteria['proprietaire'])) {
            $queryBuilder
                ->andWhere('s.proprietaire LIKE :proprietaire')
                ->setParameter('proprietaire', '%' . $criteria['proprietaire'] . '%');
        }

        if ($criteria['debut'] !== null && $criteria['debut'] !== '' && isset($criteria['debut'])) {
            $queryBuilder
                ->andWhere('s.debut >= :debut')
                ->setParameter('debut', $criteria['debut']);
        }

        // Vérifiez si le champ 'fin' est non null, non vide et défini
        if ($criteria['fin'] !== null && $criteria['fin'] !== '' && isset($criteria['fin'])) {
            $queryBuilder
                ->andWhere('s.fin <= :fin')
                ->setParameter('fin', $criteria['fin']);
        }
        if ($criteria['jourDeRetard'] && $criteria['jourDeRetard'] !== '' && isset($criteria['jourDeRetard'])) {
            $queryBuilder
                ->andWhere('s.jourDeRetard = :jourDeRetard')
                ->setParameter('jourDeRetard', $criteria['jourDeRetard']);
        }

        if ($criteria['causeRetard'] && $criteria['causeRetard'] !== '' && isset($criteria['causeRetard'])) {
            $queryBuilder
                ->andWhere('s.causeRetard LIKE :causeRetard')
                ->setParameter('causeRetard', '%' . $criteria['causeRetard'] . '%');
        }

        if ($criteria['dateCauseResiliation'] && $criteria['dateCauseResiliation'] !== '' && isset($criteria['dateCauseResiliation'])) {
            $queryBuilder
                ->andWhere('s.dateCauseResiliation LIKE :dateCauseResiliation')
                ->setParameter('dateCauseResiliation', '%' . $criteria['dateCauseResiliation'] . '%');
        }

        if ($criteria['dateValidationFinal'] && $criteria['dateValidationFinal'] !== '' && isset($criteria['dateValidationFinal'])) {
            $queryBuilder
                ->andWhere('s.dateValidationFinal = :dateValidationFinal')
                ->setParameter('dateValidationFinal', $criteria['dateValidationFinal']);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function remove(Suivit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Suivit[] Returns an array of Suivit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Suivit
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
