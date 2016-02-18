<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * CurrentJobSubscriber
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class CurrentJobSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        );
    }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();

        $isCurrentJob = array_key_exists('currentJob', $data) ? $data['currentJob'] : false;

        if ($isCurrentJob) {
            $data['dateTo'] = null;
            $event->setData($data);
        }
    }
}
