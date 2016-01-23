<?php
/**
 * This file is part of the vardius/crud-bundle package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CrudBundle\Actions\Action;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * EditAction
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class EditAction extends \Vardius\Bundle\CrudBundle\Actions\Action\EditAction
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('parameters', [
            ['name' => 'id', 'dataType' => 'integer', "required" => true, 'description' => 'element id'],
        ]);
    }
}
