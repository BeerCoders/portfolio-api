<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Entity\User;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends \FOS\UserBundle\Controller\RegistrationController
{
    /**
     * @ApiDoc(
     *  resource=false,
     *  section="Register",
     *  description="Register new user",
     *  input="UserBundle\Form\Type\RegistrationFormType"
     * )
     */
    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        /** @var User $user */
        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                return new JsonResponse([
                    'message' => 'Check your Email to confirm registration',
                    'user' => $user->getId()
                ]);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        } else {
            $formErrorHandler = $this->get('vardius_crud.form.error_handler');

            return new JsonResponse([
                'message' => 'Invalid form data',
                'errors' => $formErrorHandler->getErrorMessages($form),
            ], 400);
        }
    }

    /**
     * @ApiDoc(
     *  resource=false,
     *  section="Register",
     *  description="Receive the confirmation token from user email provider, login the user"
     * )
     */
    public function confirmAction(Request $request, $token)
    {
        return parent::confirmAction($request, $token);
    }
}
