<?php
/**
 * Created by PhpStorm.
 * User: Szymon Kunowski <szymon.kunowski@gmail.com>
 * Date: 07.12.15
 * Time: 15:38
 */

namespace Tests\AppBundle\Controller;

use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseTestCase
 * @package Tests\AppBundle\Controller
 *
 */
class BaseTestCase extends WebTestCase
{
    /** @var \Symfony\Bundle\FrameworkBundle\Client $client */
    protected $client;
    protected $client_id;
    protected $client_secret;
    protected $client_username;
    protected $client_password;
    protected $access_token;
    protected $refresh_token;
    protected $url;
    /** @var  \Doctrine\ORM\EntityManager */
    protected $em;

    public function setUp()
    {
        /** @var \Symfony\Bundle\FrameworkBundle\Client client */
        $this->client = static::createClient();
        $this->em = $this->client->getKernel()->getContainer()->get('doctrine')->getManager();
        $this->url = $this->client->getKernel()->getContainer()->getParameter('domain');
        $this->client_id = $this->client->getKernel()->getContainer()->getParameter('client_id');
        $this->client_secret = $this->client->getKernel()->getContainer()->getParameter('client_secret');
        $this->client_username = $this->client->getKernel()->getContainer()->getParameter('client_test_username');
        $this->client_password = $this->client->getKernel()->getContainer()->getParameter('client_test_password');
        $this->oAuthLogin();
    }

    private function oAuthLogin()
    {
//        var_dump(JWT::encode(
//            [
//                'username' => $this->client_username, 'password' => $this->client_password
//            ],
//            $this->client_id
//        ));die;

        $this->client->request('POST', 'http://' . $this->url . '/oauth/v2/token',
            [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'api_key' => JWT::encode(
                    [
                        'username' => $this->client_username, 'password' => $this->client_password
                    ],
                    $this->client_id
                ),
                'grant_type' => 'http://'. $this->url . '/grants/api_key',
            ]
        );
        $response = json_decode($this->client->getResponse()->getContent());
        $this->access_token = $response->access_token;
        $this->refresh_token = $response->refresh_token;
    }

}