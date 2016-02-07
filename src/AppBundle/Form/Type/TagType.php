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

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class TagType
 * @package AppBundle\Form\Type
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class TagType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('articles', 'entity', [
                'multiple' => true,
                'class' => 'AppBundle\Entity\User',
                'property' => 'id',
                'required' => false,
            ])
            ->add('name', 'text')
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Tag',
        ]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return 'tag';
    }

}