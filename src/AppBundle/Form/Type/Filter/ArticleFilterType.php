<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type\Filter;

/**
 * Class ArticleFilterType
 * @package AppBundle\Form\Type\Filter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ArticleFilterType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'required' => false
            ])
            ->add('author', 'entity', [
                'class' => 'AppBundle\Entity\User',
                'property' => 'id',
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
            'data_class' => 'AppBundle\Entity\Article',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'article_filter';
    }
}
