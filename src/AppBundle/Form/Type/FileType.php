<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Mateusz Bosek <bosek.mateusz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FileType
 * @package AppBundle\Form\Type
 * @author Mateusz Bosek <bosek.mateusz@gmail.com>
 */
class FileType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', ['required'=> false])
            ->add('file','file')
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\File',
            'validation_group' => ['update'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'file';
    }

}
