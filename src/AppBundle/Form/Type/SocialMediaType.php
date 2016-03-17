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
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SocialMediaType
 * @package AppBundle\Form\Type
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class SocialMediaType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('icon', 'entity', [
                'class' => 'AppBundle\Entity\Icon',
                'property' => 'id',
            ])
            ->add('url', 'url');
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\SocialMedia',
            'validation_group' => ['update']
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'social_media';
    }

}