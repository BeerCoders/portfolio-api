<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Szymon Kunowski <szymon.kunowski@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\ListView;

use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class ProjectSkillListViewProvider
 * @package AppBundle\ListView
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class ProjectSkillListViewProvider extends ListViewProvider
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
            ->addColumn('value', 'property')
            ->addColumn('created', 'property')
            ->addColumn('updated', 'property')
            ->addFilter('project_skill_filter', 'provider.project_skills_filter');

        return $listView;
    }

}
