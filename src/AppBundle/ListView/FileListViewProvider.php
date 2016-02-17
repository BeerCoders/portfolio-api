<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Mateusz Bosek <bosek.mateusz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\ListView;

use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class FileListViewProvider
 * @package AppBundle\ListView
 * @author Mateusz Bosek <bosek.mateusz@gmail.com>
 */
class FileListViewProvider extends ListViewProvider
{
    /**
     * @inheritDoc
     */
    public function buildListView()
    {
        $listView = $this->listViewFactory->get();

        $listView
            ->addColumn('id', 'property')
            ->addColumn('name', 'property')
            ->addColumn('path', 'property')
            ->addColumn('created', 'property')
            ->addFilter('file_filter', 'provider.files_filter');

        return $listView;
    }

}
