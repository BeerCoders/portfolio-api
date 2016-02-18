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

use AppBundle\Entity\Tag;
use JMS\Serializer\Serializer;
use Vardius\Bundle\ListBundle\ListView\Factory\ListViewFactory;
use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class ProjectListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ProjectListViewProvider extends ListViewProvider
{
    /**
     * @inheritDoc
     */
    public function buildListView()
    {
        $listView = $this->listViewFactory->get();

        $listView
            ->addColumn('id', 'property')
            ->addColumn('logo', 'property')
            ->addColumn('description', 'property')
            ->addColumn('created', 'property')
            ->addColumn('updated', 'property');

        return $listView;
    }

}
