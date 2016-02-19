<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action;

use Vardius\Bundle\CrudBundle\Actions\Provider\ActionsProvider as BaseProvider;

/**
 * Class IconActionProvider
 * @package AppBundle\Action
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class IconActionProvider extends BaseProvider
{
    /**
     * Provides actions for controller
     */
    public function getActions()
    {
        $this
            ->addAction('list', [
                'rest_route' => true,
                'response_type' => 'json',
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ])
            ->addAction('show', [
                'rest_route' => true,
                'response_type' => 'json',
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ]);

        return $this->actions;
    }

}
