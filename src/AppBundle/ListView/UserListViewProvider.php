<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\ListView;

use AppBundle\Entity\User;
use JMS\Serializer\Serializer;
use Vardius\Bundle\ListBundle\ListView\Factory\ListViewFactory;
use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class UserListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserListViewProvider extends ListViewProvider
{
    /**
     * @inheritDoc
     */
    public function buildListView()
    {
        $listView = $this->listViewFactory->get();

        $listView
            ->addColumn('id', 'property')
            ->addColumn('username', 'property')
            ->addColumn('email', 'property')
            ->addColumn('name', 'property')
            ->addColumn('surname', 'property')
            ->addColumn('avatar', 'property')
            ->addColumn('enabled', 'property')
            ->addColumn('roles', 'property')
            ->addColumn('created', 'property')
            ->addFilter('user_filter', 'provider.users_filter');

        return $listView;
    }

}