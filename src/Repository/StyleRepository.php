<?php


namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class StyleRepository extends EntityRepository
{
    /**
     * @return Style[]
     */
    public function findAllPublished()
    {
        return $this->createQueryBuilder('style')
            ->andWhere('style.is_published = :is_published')
            ->setParameter('is_published', true)
            ->getQuery()
            ->execute();
    }

    public function sortBy($name, $sort)
    {
        return $this->findBy(
            array(),
            array($name => $sort));
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