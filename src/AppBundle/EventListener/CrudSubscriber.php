<?php
/**
 * This file is part of the vcard package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Vardius\Bundle\CrudBundle\Event\CrudEvent;
use Vardius\Bundle\CrudBundle\Event\CrudEvents;
use Vardius\Bundle\ListBundle\Event\ListEvent;
use Vardius\Bundle\ListBundle\Event\ListEvents;

/**
 * Lorenz\MainBundle\EventListener\AccessSubscriber
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class CrudSubscriber implements EventSubscriberInterface
{
    /** @var User */
    protected $user;

    /**
     * @param TokenStorage $security
     */
    public function __construct(TokenStorage $security)
    {
        $token = $security->getToken();
        if ($token) {
            $this->user = $token->getUser();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            CrudEvents::CRUD_PRE_CREATE => 'preCreate',
            CrudEvents::CRUD_PRE_UPDATE => 'checkAccess',
            CrudEvents::CRUD_PRE_DELETE => 'checkAccess',
            CrudEvents::CRUD_SHOW => 'checkAccess',
            ListEvents::POST_QUERY_BUILDER => 'filterList',
        );
    }

    public function checkAccess(CrudEvent $event)
    {
        $data = $event->getData();
        if ($data instanceof FormInterface) {
            $data = $data->getData();
        }

        if ($data instanceof User) {
            if ($data !== $this->user) {

                throw new AccessDeniedException();
            }

        } elseif (method_exists($data, 'getUser') && $this->user !== $data->getUser()) {

            throw new AccessDeniedException();
        } elseif (method_exists($data, 'getAuthor') && $this->user !== $data->getAuthor()) {

            throw new AccessDeniedException();
        }
    }

    public function preCreate(CrudEvent $event)
    {
        $data = $event->getData();
        if ($data instanceof FormInterface) {
            $data = $data->getData();
        }

        if (method_exists($data, 'setUser')) {
            $data->setUser($this->user);
        }

        if (method_exists($data, 'setAuthor')) {
            $data->setAuthor($this->user);
        }
    }

    public function filterList(ListEvent $event)
    {
        $route = $event->getRouteName();
        $nonRestrictedRoutes = [
            'crud_controller.articles.list',
            'crud_controller.projects.list'
        ];

        if (in_array($route, $nonRestrictedRoutes) || !$this->user instanceof User) {
            return;
        }

        $queryBuilder = $event->getQueryBuilder();

        $aliases = $queryBuilder->getRootAliases();
        $alias = array_values($aliases)[0];

        $queryBuilder
            ->andWhere($alias . '.user = :user')
            ->setParameter('user', $this->user);
    }
}
