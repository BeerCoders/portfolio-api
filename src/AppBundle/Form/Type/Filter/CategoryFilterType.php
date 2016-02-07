<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 * (c) Szymon Kunowski <szymon.kunowski@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class CategoryFilterType
 * @package AppBundle\Form\Type\Filter
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
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