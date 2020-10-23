<?php


namespace Repository;

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
}