<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Mateusz Bosek <bosek.mateusz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Filter;

use Vardius\Bundle\ListBundle\Filter\Provider\FilterProvider;

/**
 * Class FileFilterProvider
 * @package AppBundle\Filter
 * @author Mateusz Bosek <bosek.mateusz@gmail.com>
 */
class FileFilterProvider extends FilterProvider
{
    /**
     * @inheritDoc
     */
    public function build()
    {
        $this
            ->addFilter('name', 'text')
            ->addFilter('path', 'text');
    }

}