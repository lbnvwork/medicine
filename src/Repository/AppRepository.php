<?php

namespace App\Repository;

use LogicException;
use App\Entity\Role;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class AppRepository extends ServiceEntityRepository
{
    /**
     * Добавляет данные в БД
     *
     * @param array $params
     * @param $entity
     * @param array $persistArr
     *
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function setEntityData(array $params, $entity, array $persistArr = [])
    {
        foreach ($params as $key => $param) {
            if (array_key_exists($key, $persistArr)) {
                if (gettype($persistArr[$key]) === 'string') {
                    $persistArr[$key] = trim($persistArr[$key]) ? trim($persistArr[$key]) : null;
                }
                $method = 'set' . ucfirst($key);
                $entity->{$method}($persistArr[$key]);
                continue;
            }
            if (gettype($param) === 'string') {
                $param = trim($param) ? trim($param) : null;
            }
            $method = 'set' . ucfirst($key);
            $entity->{$method}($param);
        }
        $this->getEntityManager()->persist($entity);
        return $entity;
    }
}
