<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StuffRepository extends EntityRepository
{
    public function getStuffLike($name)
    {
        $name .=  "%";
        $qb = $this->createQueryBuilder('s')
            ->select('s.name, s.id')
            ->Where('s.name LIKE :name')
            ->setParameter('name', $name)
            ->orderBy('s.name')
            ->getQuery();

        return $qb->getResult();
    }
}
