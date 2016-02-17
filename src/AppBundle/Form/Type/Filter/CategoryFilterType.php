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
 * Class CategoryFilterType
 * @package AppBundle\Form\Type\Filter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class CategoryFilterType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->setMethod('GET');
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Category',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'category_filter';
    }
}
