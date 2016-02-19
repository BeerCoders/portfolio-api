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
 * Class SocialMediaListViewProvider
 * @package AppBundle\ListView
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class SocialMediaListViewProvider extends ListViewProvider
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
            ->addColumn('icon', 'property')
            ->addColumn('url', 'property')
            ->addColumn('user', 'property')
            ->addColumn('created', 'property')
            ->addColumn('updated', 'property')
            ->addFilter('social_media_filter', 'provider.social_medias_filter');

        return $listView;
    }

}
