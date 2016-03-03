<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Icon;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class IconData
 * @package AppBundle\DataFixtures\ORM
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class IconData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $icons = [
            [
                'name' => 'stackoverflow',
                'class' => 'fa-stack-overflow',
            ],
            [
                'name' => 'linkedin',
                'class' => 'fa-linkedin',
            ],
            [
                'name' => 'facebook',
                'class' => 'fa-facebook',
            ],
            [
                'name' => 'twitter',
                'class' => 'fa-twitter',
            ],
            [
                'name' => 'google-plus',
                'class' => 'fa-google-plus',
            ],
            [
                'name' => 'github',
                'class' => 'fa-github',
            ],
            [
                'name' => 'bitbucket',
                'class' => 'fa-bitbucket',
            ],
            [
                'name' => 'git',
                'class' => 'fa-git',
            ],
            [
                'name' => 'youtube',
                'class' => 'fa-youtube',
            ],
            [
                'name' => 'reddit',
                'class' => 'fa-reddit',
            ],
            [
                'name' => 'tumblr',
                'class' => 'fa-tumblr',
            ],
            [
                'name' => 'drupal',
                'class' => 'fa-drupal',
            ],
            [
                'name' => 'instagram',
                'class' => 'fa-instagram',
            ],
            [
                'name' => 'jsfiddle',
                'class' => 'fa-jsfiddle',
            ],
            [
                'name' => 'soundcloud',
                'class' => 'fa-soundcloud',
            ],
            [
                'name' => 'steam',
                'class' => 'fa-steam',
            ],
            [
                'name' => 'wordpress',
                'class' => 'fa-wordpress',
            ],
            [
                'name' => 'yelp',
                'class' => 'fa-yelp',
            ],
            [
                'name' => 'yahoo',
                'class' => 'fa-yahoo',
            ],
            [
                'name' => 'whatsapp',
                'class' => 'fa-whatsapp',
            ],
            [
                'name' => 'twitch',
                'class' => 'fa-twitch',
            ],
            [
                'name' => 'skype',
                'class' => 'fa-skype',
            ],
            [
                'name' => 'lastfm',
                'class' => 'fa-lastfm',
            ],
            [
                'name' => 'hacker-news',
                'class' => 'fa-hacker-news',
            ],
            [
                'name' => 'codepen',
                'class' => 'fa-codepen',
            ],
            [
                'name' => 'apple',
                'class' => 'fa-apple',
            ],
            [
                'name' => 'amazon',
                'class' => 'fa-amazon',
            ],
            [
                'name' => 'pinterest',
                'class' => 'fa-pinterest',
            ],
            [
                'name' => 'vimeo',
                'class' => 'fa-vimeo',
            ],
            [
                'name' => 'android',
                'class' => 'fa-android',
            ],
            [
                'name' => 'html5',
                'class' => 'fa-html5',
            ],
            [
                'name' => 'slideshare',
                'class' => 'fa-slideshare',
            ],
            [
                'name' => 'windows',
                'class' => 'fa-windows',
            ],
        ];

        foreach ($icons as $icon) {
            $object = $manager->getRepository('AppBundle:Icon')->findOneByName($icon['name']);
            if (!$object) {
                $object = new Icon();
                $object->setName($icon['name']);
                $object->setClass($icon['class']);
                $manager->persist($object);
            }
        }

        $manager->flush();
    }
}