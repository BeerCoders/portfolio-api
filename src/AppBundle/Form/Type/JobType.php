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

use AppBundle\Form\EventListener\CurrentJobSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Lorenz\MainBundle\Form\Type\JobType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', 'text')
            ->add('position', 'text')
            ->add('description', 'text')
            ->add('dateFrom', 'date', [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('dateTo', 'date', [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('currentJob', 'checkbox', [
                'required' => false,
            ])
            ->addEventSubscriber(new CurrentJobSubscriber());
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Job',
            'validation_group' => ['update']
        ]);
    }

    public function getName()
    {
        return 'job';
    }

}
