<?php
/**
 * This file is part of the tactic-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @author Rafał Lorenz <vardius@gmail.com>
 *
 * @Route("/users")
 */
class UsersController extends Controller
{
    /**
     * @ApiDoc(
     *  section="Users",
     *  resource=false,
     *  description="Get current user"
     * )
     * @Route("/me", name="users_current")
     * @Method({"GET"})
     * @return JsonResponse
     * @Rest\View
     */
    public function currentAction()
    {
        $user = $this->getUser();
        if ($user) {
            $responseHandler = $this->get('vardius_crud.response.handler');

            return $responseHandler->getResponse('json', null, null, $user, 200, [], ['Default', 'show']);
        }

        return new JsonResponse(array(
            'message' => 'User is not identified'
        ));
    }
}
