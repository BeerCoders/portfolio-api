<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CrudBundle\Routing;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class Route
 * @package CrudBundle\Routing
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class Route extends \Symfony\Component\Routing\Route
{
    /** @var ApiDoc */
    protected $doc;

    /**
     * @return ApiDoc
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * @param ApiDoc $doc
     * @return Route
     */
    public function setDoc($doc)
    {
        $this->doc = $doc;
        $this->doc->setRoute($this);

        return $this;
    }

}