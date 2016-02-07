<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 * (c) Szymon Kunowski <szymon.kunowski@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\ListView;

use Vardius\Bundle\ListBundle\ListView\ListView;
use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;


/**
 * Class CategoryListViewProvider
 * @package AppBundle\ListView
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class CategoryListViewProvider extends ListViewProvider
{
    /**
     * @inheritDoc
     */
    public function buildListView()
    {
        $listView = $this->listViewFactory->get();

        $listView
            ->addColumn('id', 'property', [
                'sort' => true,
            ])
            ->addColumn('name', 'property', [
                'sort' => true,
            ])
            ->addColumn('position', 'property', [
                'sort' => true,
            ])
            ->addColumn('articles', 'property', [
                'sort' => true,
            ])
            ->addColumn('created', 'property', [
                'sort' => true,
            ])
            ->addColumn('updated', 'property', [
                'sort' => true,
            ])
            ->addFilter('category_filter', 'provider.category_filter');

        return $listView;
    }

}