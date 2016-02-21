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
 * Class ArticleType
 * @package AppBundle\Form\Type
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ArticleType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('body', 'text')
            ->add('cover', 'url')
            ->add('author', 'entity', [
                'class' => 'AppBundle\Entity\User',
                'property' => 'id',
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Article',
        ]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return 'article';
    }
}
