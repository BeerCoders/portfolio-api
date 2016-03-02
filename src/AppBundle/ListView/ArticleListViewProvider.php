<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\ListView;

use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class ArticleListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
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
            ->addColumn('cover', 'property', [
                'sort' => true,
            ])
            ->addColumn('title', 'property', [
                'sort' => true,
            ])
            ->addColumn('intro', 'property', [
                'sort' => false,
            ])
            ->addColumn('created', 'property', [
                'sort' => true,
            ])
            ->addColumn('updated', 'property', [
                'sort' => true,
            ])
            ->addFilter('article_filter', 'provider.articles_filter');

        return $listView;
    }
}
