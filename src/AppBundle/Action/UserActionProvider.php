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
 * Class UserActionProvider
 * @package AppBundle\Action
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserActionProvider extends BaseProvider
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
            ])
            ->addAction('add', [
                'rest_route' => true,
                'response_type' => 'json',
            ])
            ->addAction('edit', [
                'rest_route' => true,
                'response_type' => 'json',
            ])
            ->addAction('delete', [
                'rest_route' => true,
                'response_type' => 'json',
            ])
            ->addAction('show', [
                'rest_route' => true,
                'response_type' => 'json',
            ]);

        return $this->actions;
    }
}