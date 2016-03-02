<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContactType
 * @package AppBundle\Form\Type
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ContactType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3])
                ],
            ])
            ->add('email', 'email', [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])
            ->add('phone', 'integer', [
                'constraints' => new Assert\NotBlank(),
            ])
            ->add('body', 'textarea', [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 20])
                ]
            ]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return 'contact';
    }
}
