<?php

namespace App\Repository;

use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function findByUtilisateur($utilisateur)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.refUtilisateur = :utilisateur')
            ->setParameter('utilisateur', $utilisateur)
            ->orderBy('r.dateHeureReponse', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findLatestByUtilisateur($utilisateur)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.refUtilisateur = :utilisateur')
            ->setParameter('utilisateur', $utilisateur)
            ->orderBy('r.dateHeureReponse', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
