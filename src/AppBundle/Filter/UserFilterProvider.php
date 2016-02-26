<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Filter;

use Vardius\Bundle\ListBundle\Filter\Provider\FilterProvider;

/**
 * Class UserFilterProvider
 * @package AppBundle\Filter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserFilterProvider extends FilterProvider
{
    /**
     * @inheritDoc
     */
    public function build()
    {
        $this
            ->addFilter('email', 'text')
            ->addFilter('username', 'text')
            ->addFilter('name', 'text')
            ->addFilter('surname', 'text')
            ->addFilter('roles', 'text')
            ->addFilter('enabled', 'text')
        ;
    }

}