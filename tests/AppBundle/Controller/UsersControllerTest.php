<?php

/**
 * This file is part of the rest-api package.
 *
 * (c) Mateusz Bosek <bosek.mateusz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class CurrentNotificationControllerTest
 * @package Tests\AppBundle\Controller
 */
class UserControllerTest extends BaseTestCase
{
    const ID_FOR_TESTS = '/1';

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $this->client->request('GET', $url . "?access_token=" . $this->access_token);
        $this->client->followRedirect();
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testListAction($url)
    {
        $this->client->request('GET', $url . "?access_token=" . $this->access_token);
        $this->client->followRedirect();
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode()
        );
    }

//    /**
//     * @dataProvider urlProvider
//     */
//    public function testShowAction($url)
//    {
//        $this->client->request('GET', $url . self::ID_FOR_TESTS . "?access_token=" . $this->access_token);
//        $this->assertTrue($this->client->getResponse()->isSuccessful());
//    }

//    /**
//     * @dataProvider urlProvider
//     */
//    public function testDeleteAction($url)
//    {
//        $session = new Session();
//        $session->start();
//        $this->client->request('DELETE', $url . self::ID_FOR_TESTS . "?access_token=" . $this->access_token);
//        $this->assertTrue($this->client->getResponse()->getContent());
//    }

    public function urlProvider()
    {
        return [
            ['/users'],
        ];
    }

}