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
 * Class ArticleListViewProvider
 * @package AppBundle\ListView
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class ArticleListViewProvider extends ListViewProvider
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
            ->addColumn('author', 'property', [
                'sort' => true,
            ])
            ->addColumn('tags', 'property', [
                'sort' => true,
            ])
            ->addColumn('category', 'property', [
                'sort' => true,
            ])
            ->addColumn('coverImage', 'property', [
                'sort' => true,
            ])
            ->addColumn('title', 'property', [
                'sort' => true,
            ])
            ->addColumn('introduction', 'property', [
                'sort' => true,
            ])
            ->addColumn('body', 'property', [
                'sort' => true,
            ])
            ->addColumn('created', 'property', [
                'sort' => true,
            ])
            ->addColumn('updated', 'property', [
                'sort' => true,
            ])
            ->addFilter('article_filter', 'provider.article_filter');

        return $listView;
    }

}