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

use AppBundle\Entity\Tag;
use JMS\Serializer\Serializer;
use Vardius\Bundle\ListBundle\ListView\Factory\ListViewFactory;
use Vardius\Bundle\ListBundle\ListView\Provider\ListViewProvider;

/**
 * Class IconListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class IconListViewProvider extends ListViewProvider
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
            ->addColumn('class', 'property')
            ->addFilter('icon_filter', 'provider.icons_filter');

        return $listView;
    }

}
