<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class FosUserListener
 * @package AppBundle\EventListener
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class FosUserListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_CONFIRM => 'onConfirm',
            FOSUserEvents::RESETTING_RESET_SUCCESS => 'onReset'
        );
    }

    public function onConfirm(GetResponseUserEvent $event)
    {
        $event->setResponse(new JsonResponse([
            'message' => 'Account confirmed',
            'user' => $event->getUser()
        ]));
    }

    public function onReset(FormEvent $event)
    {
        $event->setResponse(new JsonResponse([
            'message' => 'Reset Success',
        ]));
    }

}
