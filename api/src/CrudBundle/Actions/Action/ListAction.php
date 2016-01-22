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
use Vardius\Bundle\CrudBundle\Actions\Action;

/**
 * ListAction
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ListAction extends Action\ListAction
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('parameters', [
            ['name' => 'page', 'dataType' => 'integer', "required" => false, 'description' => 'page value'],
            ['name' => 'limit', 'dataType' => 'integer', "required" => false, 'description' => 'limit value'],
            ['name' => 'column', 'dataType' => 'string', "required" => false, 'description' => 'sorts data by column name'],
            ['name' => 'sort', 'dataType' => 'string', "required" => false, 'description' => 'sort method (ASC|DESC)'],
        ]);
    }

}
