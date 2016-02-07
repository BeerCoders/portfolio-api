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

namespace AppBundle\Filter;

use Vardius\Bundle\ListBundle\Filter\Provider\FilterProvider;

/**
 * Class CategoryFilterProvider
 * @package AppBundle\Filter
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 */
class CategoryFilterProvider extends FilterProvider
{
    /**
     * @inheritDoc
     */
    public function build()
    {
        $this
            ->addFilter('name', 'text');
    }

}