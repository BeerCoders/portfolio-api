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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Lorenz\MainBundle\Form\Type\ProjectType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo', 'url')
            ->add('flayer', 'url')
            ->add('description', 'text')
            ->add('technologies', 'entity', [
                'class' => 'AppBundle\Entity\Tech',
                'property' => 'id',
                'multiple' => true,
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Project',
            'validation_group' => ['update']
        ]);
    }

    public function getName()
    {
        return 'project';
    }

}
