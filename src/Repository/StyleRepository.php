<?php


namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class StyleRepository extends EntityRepository
{
    public function findAllAsc()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }

    public function findAllDesc()
    {
        return $this->findBy(array(), array('name' => 'DESC'));
    }

    public function findAllLike($style)
    {
        return $this->createQueryBuilder('style')
            ->andWhere('style.name LIKE :name')
            ->setParameter('name', '%' . $style . '%')
            ->getQuery()
            ->getResult();
    }
}