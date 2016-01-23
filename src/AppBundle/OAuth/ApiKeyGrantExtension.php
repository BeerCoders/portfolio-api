<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\OAuth;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectRepository;
use Firebase\JWT\JWT;
use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;
use OAuth2\Model\IOAuth2Client;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class ApiKeyGrantExtension
 * @package AppBundle\OAuth
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ApiKeyGrantExtension implements GrantExtensionInterface
{
    protected $userRepository;
    protected $encoderFactory;

    /**
     * ApiKeyGrantExtension constructor.
     * @param ObjectRepository $userRepository
     * @param EncoderFactory $encoderFactory
     */
    public function __construct(ObjectRepository $userRepository, EncoderFactory $encoderFactory)
    {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param IOAuth2Client $client
     * @param array $inputData
     * @param array $authHeaders
     * @return array|bool
     */
    public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
    {
        try {
            $token = JWT::decode($inputData['api_key'], $client->getPublicId(), ['HS256']);
        } catch (\Exception $e) {
            return false;
        }

        /** @var User $user */
        $user = $this->userRepository->findOneByEmail($token->email);

        if ($user) {
            $encoder = $this->encoderFactory->getEncoder($user);
            if ($encoder->isPasswordValid($user->getPassword(), $token->password, $user->getSalt())) {

                return array(
                    'data' => $user
                );
            }
        }

        return false;
    }
}
