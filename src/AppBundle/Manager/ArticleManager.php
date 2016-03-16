<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;

use Vardius\Bundle\CrudBundle\Manager\CrudManagerInterface;

/**
 * Class ArticleManager
 * @package AppBundle\Manager
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ArticleManager implements CrudManagerInterface
{
    /** @var EntityManager */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        if ($id !== null) {
            $repository = $this->entityManager->getRepository('AppBundle:Article');
            $query = $repository->createQueryBuilder('a');

            return $query
                ->andWhere('a.slug = :slug')
                ->setParameter('slug', $id)
                ->getQuery()
                ->getOneOrNullResult();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function remove($entity)
    {
        $this->entityManager->remove($entity);
    }

    /**
     * @inheritDoc
     */
    public function add($entity)
    {
        $this->entityManager->persist($entity);
    }

    /**
     * @inheritDoc
     */
    public function update($entity)
    {
        $this->entityManager->persist($entity);
    }

}