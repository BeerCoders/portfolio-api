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
 * Class ArticleType
 * @package AppBundle\Form\Type
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class ArticleType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', 'entity', [
                'class' => 'AppBundle\Entity\User',
                'property' => 'id',
                'required' => true,
            ])
            ->add('author', 'entity', [
                'multiple' => true,
                'class' => 'AppBundle\Entity\User',
                'property' => 'id',
                'required' => false,
            ])
            ->add('coverImage', 'url')
            ->add('title', 'text')
            ->add('introduction', 'text')
            ->add('body', 'textarea')
        ;
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