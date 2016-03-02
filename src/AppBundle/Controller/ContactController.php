<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContactController
 * @package AppBundle\Controller
 * @author Rafał Lorenz <vardius@gmail.com>
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * @ApiDoc(
     *  section="Contact",
     *  resource=false,
     *  description="Send email tru contact form",
     *  input="AppBundle\Form\Type\ContactType"
     * )
     * @Route("/email", name="contact_email")
     * @Method({"POST"})
     * @Rest\View
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Contact from BeerCoders')
                ->setFrom([$data['email'] => $data['name']])
                ->setTo('recipient@example.com')
                ->setBody(
                    $this->renderView(
                        'Email/contact.html.twig',
                        array('body' => $data['body'])
                    ),
                    'text/html'
                )
                ->addPart(
                    $this->renderView(
                        'Email/contact.txt.twig',
                        array('body' => $data['body'])
                    ),
                    'text/plain'
                );

            $this->get('mailer')->send($message);

            return new JsonResponse([
                'message' => 'Email sent'
            ]);
        } else {
            $formErrorHandler = $this->get('vardius_crud.form.error_handler');

            return new JsonResponse([
                'message' => 'Invalid form data',
                'errors' => $formErrorHandler->getErrorMessages($form),
            ], 400);
        }
    }
}
