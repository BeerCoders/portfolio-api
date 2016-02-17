<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthController
 * @package AppBundle\Controller
 * @author Rafał Lorenz <vardius@gmail.com>
 *
 * @Route("/oauth/v2")
 */
class AuthController extends Controller
{
    /**
     * @ApiDoc(
     *  section="Authorization",
     *  resource=false,
     *  description="Revoke token"
     * )
     * @Route("/revoke", name="oauth_token_revoke")
     * @Method({"GET|POST"})
     * @return JsonResponse
     * @Rest\View
     */
    public function revokeAction(Request $request)
    {
        $entityManager = $this->get('doctrine.orm.entity_manager');
        $repository = $entityManager->getRepository('AppBundle:RefreshToken');

        $token = $request->get('token');
        $accessToken = $repository->findOneBy(['token' => $token]);

        if ($accessToken) {
            $entityManager->remove($accessToken);
            $entityManager->flush();

            return new JsonResponse(array(
                'message' => 'Revoked access for token: ' . $token
            ));
        }

        return new JsonResponse(array(
            'message' => 'Token not found: ' . $token
        ));
    }
}
