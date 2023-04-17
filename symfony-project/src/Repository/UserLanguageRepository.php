<?php

namespace App\Repository;

use App\Entity\UserLanguage;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Intl\Languages;

/**
 * @extends ServiceEntityRepository<UserLanguage>
 *
 * @method UserLanguage|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLanguage|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLanguage[]    findAll()
 * @method UserLanguage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLanguage::class);
    }

    public function add(UserLanguage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



    public function getUserLanguages(User $user): array
    {
        $languages = $this->findBy(['user_id' => $user]);
        $newLanguages = [];
        foreach ($languages as $lang) {
            array_push($newLanguages, $lang->getLanguage());
        }
        return $newLanguages;
    }
  

    public function remove(UserLanguage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UserLanguage[] Returns an array of UserLanguage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserLanguage
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
