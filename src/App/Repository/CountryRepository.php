<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository
{
    /**
     * @return Country[]
     */
    public function findAllPublishedOrderedBySize()
    {
        return $this->createQueryBuilder('country')
            ->andWhere('country.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('country.name', 'DESC')
            ->getQuery()
            ->execute();
    }
}