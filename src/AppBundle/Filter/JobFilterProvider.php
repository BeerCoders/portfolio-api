<?php
/**
 * This file is part of the portfolio-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Filter;

use Vardius\Bundle\ListBundle\Filter\Provider\FilterProvider;

/**
 * Class JobFilterProvider
 * @package AppBundle\Filter
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class JobFilterProvider extends FilterProvider
{
    /**
     * @inheritDoc
     */
    public function build()
    {
        $this
            ->addFilter('company', 'text')
            ->addFilter('position', 'text')
            ->addFilter('dateFrom', 'date', [
                'condition' => 'gte',
            ])
            ->addFilter('dateTo', 'date', [
                'condition' => 'gte',
            ])
            ->addFilter('currentJob', 'text');
    }

}