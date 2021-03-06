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
            ->addColumn('email', 'property')
            ->addColumn('name', 'property')
            ->addColumn('surname', 'property')
            ->addColumn('title', 'property')
            ->addColumn('location', 'property')
            ->addFilter('user_filter', 'provider.users_filter');

        return $listView;
    }

}