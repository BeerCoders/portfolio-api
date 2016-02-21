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
 * Class JobListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class JobListViewProvider extends ListViewProvider
{
    /**
     * @inheritDoc
     */
    public function buildListView()
    {
        $listView = $this->listViewFactory->get();

        $listView
            ->addColumn('id', 'property')
            ->addColumn('company', 'property')
            ->addColumn('position', 'property')
            ->addColumn('description', 'property')
            ->addColumn('dateFrom', 'property')
            ->addColumn('dateTo', 'property')
            ->addColumn('currentJob', 'property')
            ->addColumn('user', 'property')
            ->addColumn('created', 'property')
            ->addColumn('updated', 'property')
            ->addFilter('job_filter', 'provider.jobs_filter');

        return $listView;
    }

}
