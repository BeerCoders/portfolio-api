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
 * Class SkillListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class SkillListViewProvider extends ListViewProvider
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
            ->addColumn('user', 'property')
            ->addColumn('created', 'property')
            ->addColumn('updated', 'property')
            ->addFilter('skill_filter', 'provider.skills_filter');

        return $listView;
    }

}
