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
 * Class FileActionProvider
 * @package AppBundle\Action
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class FileActionProvider extends BaseProvider
{
    /**
     * Provides actions for controller
     */
    public function getActions()
    {
        $this
            ->addAction('list', [
                'rest_route' => true,
                'defaults' => [
                    '_format' => 'json'
                ],
                'requirements' => [
                    '_format' => 'json'
                ],
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ])
            ->addAction('add', [
                'rest_route' => true,
                'defaults' => [
                    '_format' => 'json'
                ],
                'requirements' => [
                    '_format' => 'json'
                ],
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ])
            ->addAction('edit', [
                'rest_route' => true,
                'defaults' => [
                    '_format' => 'json'
                ],
                'requirements' => [
                    '_format' => 'json'
                ],
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ])
            ->addAction('delete', [
                'rest_route' => true,
                'defaults' => [
                    '_format' => 'json'
                ],
                'requirements' => [
                    '_format' => 'json'
                ],
                'checkAccess' => [
                    'attributes' => ['ROLE_USER']
                ],
            ])
            ->addAction('show', [
                'rest_route' => true,
                'defaults' => [
                    '_format' => 'json'
                ],
                'requirements' => [
                    '_format' => 'json'
                ],
            ]);

        return $this->actions;
    }

}
