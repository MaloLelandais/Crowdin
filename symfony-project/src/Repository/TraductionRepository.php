<?php

namespace App\Repository;

use App\Entity\Traduction;
use App\Entity\User;
use App\Entity\UserLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Traduction>
 *
 * @method Traduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traduction[]    findAll()
 * @method Traduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traduction::class);
    }

    public function add(Traduction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Traduction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getTrad(User $user): array
    {
        $languages = $this->findBy(['user' => $user]);
        $newLanguages = $lang_to;
        return $newLanguages;
    }

    public function getTraductionForUser($userLanguages)
    {
        return $this->findBy(['lang_from' => $userLanguages, 'lang_to' => $userLanguages]);
    }

    public function getIdForUser($userId)
    {
        return $this->findBy(['user' => $userId]);
    }

//    /**
//     * @return Traduction[] Returns an array of Traduction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Traduction
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
