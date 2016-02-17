<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class UserFilterType
 * @package AppBundle\Form\Type\Filter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserFilterType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', [
                'required' => false
            ])
            ->add('username', 'text', [
                'required' => false
            ])
            ->add('name', 'text', [
                'required' => false
            ])
            ->add('surname', 'text', [
                'required' => false
            ])
            ->add('roles', 'text', [
                'required' => false,
                'mapped' => false
            ])
            ->add('enabled', 'checkbox', [
                'required' => false
            ])
            ->setMethod('GET');
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'validation_group' => ['filter'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'user_filter';
    }

}