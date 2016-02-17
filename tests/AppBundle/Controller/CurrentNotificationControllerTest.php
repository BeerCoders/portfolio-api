<?php
/**
 * Created by PhpStorm.
 * User: Szymon Kunowski <szymon.kunowski@gmail.com>
 * Date: 07.12.15
 * Time: 10:21
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\User;
use Tests\AppBundle\Controller\BaseTestCase as BaseTestCase;

/**
 * Class CurrentNotificationControllerTest
 * @package Tests\AppBundle\Controller
 *
 */
class CurrentNotificationControllerTest extends BaseTestCase
{

    /** @var  User */
    protected $user;

    protected $properlyNotification;
    protected $notificationId;

    public function setUp()
    {
        parent::setUp();
        $this->user = $this->em->getRepository('AppBundle:User')->findOneBy(['username' => $this->client_username]);
        $this->properlyNotification = [
            'notification' => [
                'body' => 'test Notification',
                'from' => 'test From',
                'fromUrl' => 'http://google.pl',
                'img' => 'http://img.jpg',
                'user' => $this->user->getId()
            ]
        ];
    }

    /**
     * @return array
     */
    public function urlProvider()
    {
        return [
            ['/current-notification']
        ];
    }

    //CREATE

    /**
     * @dataProvider urlProvider
     */
    public function testCreateIsSuccessful($url)
    {
        $this->client->request(
            'POST',
            $url . "?access_token=" . $this->access_token,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->properlyNotification)
        );

        $response = $this->client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $response = json_decode($response->getContent());
        $this->assertTrue(property_exists($response, 'notification'));
        $this->notificationId = $response->notification;
    }

    /**
     * @dataProvider urlProvider
     */
    public function testCreateNoAccessToken($url)
    {
        $this->client->request('POST', $url . "?access_token=");
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testCreateNotificationFalseData($url)
    {
        $this->client->request('POST', $url . "?access_token=" . $this->access_token, ['false' => 'data']);
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testCreateNotificationNoData($url)
    {
        $this->client->request('POST', $url . "?access_token=" . $this->access_token, []);
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    //INDEX

    /**
     * @dataProvider urlProvider
     */
    public function testIndexIsSuccessful($url)
    {
        $this->client->request('GET', $url . "?access_token=" . $this->access_token);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testIndexNoAccessToken($url)
    {
        $this->client->request('GET', $url . "?access_token=");
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    //DELETE

    /**
     * @dataProvider urlProvider
     */
    public function testDeleteNotification($url)
    {
        $this->client->request('DELETE', $url . "/" . $this->notificationId . "?access_token=" . $this->access_token, []);
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }
}