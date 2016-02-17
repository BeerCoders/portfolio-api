<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class UserType
 * @package AppBundle\Form\Type
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['required' => false,])
            ->add('email', 'email', ['required' => false,])
            ->add('surname', 'text', ['required' => false,])
            ->add('username', 'text', ['required' => false,])
            ->add('avatar', 'url', ['required' => false,])
            ->add('birth', 'date', [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'required' => false,
            ])
            ->add('enabled', 'checkbox', ['required' => false])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'validation_group' => ['Profile'],
        ]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return 'user';
    }

}