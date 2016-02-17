<?php

namespace UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller managing the resetting of the password
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class ResettingController extends \FOS\UserBundle\Controller\ResettingController
{
    /**
     * @ApiDoc(
     *  resource=false,
     *  section="Resetting",
     *  description="Request reset user password: submit form and send email",
     *  requirements={
     *      {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="Username or email"
     *      }
     *  },
     *  parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="Username or email"}
     *  }
     * )
     */
    public function sendEmailAction(Request $request)
    {
        $username = $request->request->get('username');

        /** @var $user UserInterface */
        $user = $this->get('fos_user.user_manager')->findUserByUsernameOrEmail($username);

        if (null === $user) {
            return new JsonResponse([
                'errors' => [
                    'invalid_username' => $username
                ]
            ], 404);
        }

        if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            return new JsonResponse([
                'errors' => [
                    'password_already_requested' => $this->get('translator')->trans('resetting.password_already_requested', [], 'FOSUserBundle')
                ]
            ], 400);
        }

        if (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }

        $template = $this->getParameter('fos_user.resetting.email.template');
        $rendered = $this->render($template, array(
            'user' => $user,
            'confirmationUrl' => $this->getParameter('dashboard_domain') . '/reset/' . $user->getConfirmationToken()
        ));

        $renderedLines = explode("\n", trim($rendered));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->getParameter('fos_user.resetting.email.from_email'))
            ->setTo($user->getEmail())
            ->setBody($body);

        $this->get('mailer')->send($message);

        $user->setPasswordRequestedAt(new \DateTime());
        $this->get('fos_user.user_manager')->updateUser($user);

        return new JsonResponse([
            'email' => $this->getObfuscatedEmail($user)
        ]);
    }

    /**
     * @ApiDoc(
     *  resource=false,
     *  section="Resetting",
     *  description="Reset user password",
     *  input="FOS\UserBundle\Form\Type\ResettingFormType"
     * )
     */
    public function resetAction(Request $request, $token)
    {
        return parent::resetAction($request, $token);
    }
}
