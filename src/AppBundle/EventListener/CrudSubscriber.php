<?php
/**
 * This file is part of the vcard package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Vardius\Bundle\CrudBundle\Event\CrudEvent;
use Vardius\Bundle\CrudBundle\Event\CrudEvents;

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
        );
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
    }
}
