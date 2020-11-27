<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * @return Article[]
     */
    public function findAllPublished()
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.is_published = :is_published')
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

    public function findAllLike($article)
    {
        return $this->createQueryBuilder('article')
            ->andWhere('article.name LIKE :name')
            ->setParameter('name', '%' . $article . '%')
            ->getQuery()
            ->getResult();
    }
}