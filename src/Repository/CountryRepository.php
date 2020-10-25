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

    public function findAllAsc()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }

    public function findAllDesc()
    {
        return $this->findBy(array(), array('name' => 'DESC'));
    }

    public function findAllLike($country)
    {
        return $this->createQueryBuilder('country')
            ->andWhere('country.name LIKE :name')
            ->setParameter('name', '%' . $country . '%')
            ->getQuery()
            ->getResult();
    }
}