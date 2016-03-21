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
use AppBundle\Entity\Tech;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TechData
 * @package AppBundle\DataFixtures\ORM
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class TechData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $icons = [
            [
                'name' => 'HTML5',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/html5-logo.png',
            ],
            [
                'name' => 'CSS3',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/css3-logo.png',
            ],
            [
                'name' => 'JavaScript',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/javascript-logo.png',
            ],
            [
                'name' => 'PHP',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/php-logo.png',
            ],
            [
                'name' => 'Bootstrap',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/bootstrap-logo.png',
            ],
            [
                'name' => 'Git',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/git-logo.png',
            ],
            [
                'name' => 'AngularJS',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/angular-logo.png',
            ],
            [
                'name' => 'Symfony',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/symfony-logo.png',
            ],
            [
                'name' => 'Docker',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/docker-logo.png',
            ],
            [
                'name' => 'Jenkins',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/jenkins-logo.png',
            ],
            [
                'name' => 'SASS',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/sass-logo.png',
            ],
            [
                'name' => 'AWS',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/aws-logo.png',
            ],
            [
                'name' => 'Webpack',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/webpack-logo.png',
            ],
            [
                'name' => 'ElasticSearch',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/elasticsearch-logo.png',
            ],
            [
                'name' => 'Redis',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/redis-logo.png',
            ],
            [
                'name' => 'NodeJS',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/nodejs-logo.png',
            ],
            [
                'name' => 'EcmaScript6',
                'logo' => '//beercoders.s3-website-eu-west-1.amazonaws.com/dist/stack/es6-logo.png',
            ],
        ];

        foreach ($icons as $icon) {
            $object = $manager->getRepository('AppBundle:Tech')->findOneByName($icon['name']);
            if (!$object) {
                $object = new Tech();
                $object->setName($icon['name']);
                $object->setLogo($icon['logo']);
                $manager->persist($object);
            }
        }

        $manager->flush();
    }
}