<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * @return Article[]
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

    public function findAllLike($article)
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.name LIKE :name')
            ->setParameter('name', '%' . $article . '%')
            ->getQuery()
            ->getResult();
    }
}