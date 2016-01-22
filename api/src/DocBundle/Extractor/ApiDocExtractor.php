<?php

/*
 * This file is part of the NelmioApiDocBundle.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DocBundle\Extractor;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Route;
use Nelmio\ApiDocBundle\Extractor\ApiDocExtractor as BaseExtractor;

class ApiDocExtractor extends BaseExtractor
{
    /**
     * Returns an array of data where each data is an array with the following keys:
     *  - annotation
     *  - resource
     *
     * @param array $routes array of Route-objects for which the annotations should be extracted
     *
     * @return array
     */
    public function extractAnnotations(array $routes, $view = ApiDoc::DEFAULT_VIEW)
    {
        $array = array();
        $resources = array();
        $excludeSections = $this->container->getParameter('nelmio_api_doc.exclude_sections');

        foreach ($routes as $route) {
            if (!$route instanceof Route) {
                throw new \InvalidArgumentException(sprintf('All elements of $routes must be instances of Route. "%s" given', gettype($route)));
            }

            if ($method = $this->getReflectionMethod($route->getDefault('_controller'))) {
                if ($route instanceof \CrudBundle\Routing\Route) {
                    $array[] = array('annotation' => $this->extractData($route->getDoc(), $route, $method));
                } else {
                    $annotation = $this->reader->getMethodAnnotation($method, self::ANNOTATION_CLASS);
                    if (
                        $annotation && !in_array($annotation->getSection(), $excludeSections) &&
                        (in_array($view, $annotation->getViews()) || (0 === count($annotation->getViews()) && $view === ApiDoc::DEFAULT_VIEW))
                    ) {
                        if ($annotation->isResource()) {
                            if ($resource = $annotation->getResource()) {
                                $resources[] = $resource;
                            } else {
                                // remove format from routes used for resource grouping
                                $resources[] = str_replace('.{_format}', '', $route->getPath());
                            }
                        }

                        $array[] = array('annotation' => $this->extractData($annotation, $route, $method));
                    }
                }
            }
        }

        foreach ($this->annotationsProviders as $annotationProvider) {
            foreach ($annotationProvider->getAnnotations() as $annotation) {
                $route = $annotation->getRoute();
                $array[] = array('annotation' => $this->extractData($annotation, $route, $this->getReflectionMethod($route->getDefault('_controller'))));
            }
        }

        rsort($resources);
        foreach ($array as $index => $element) {
            $hasResource = false;
            $path = $element['annotation']->getRoute()->getPath();

            foreach ($resources as $resource) {
                if (0 === strpos($path, $resource) || $resource === $element['annotation']->getResource()) {
                    $array[$index]['resource'] = $resource;

                    $hasResource = true;
                    break;
                }
            }

            if (false === $hasResource) {
                $array[$index]['resource'] = 'others';
            }
        }

        $methodOrder = array('GET', 'POST', 'PUT', 'DELETE');
        usort($array, function ($a, $b) use ($methodOrder) {
            if ($a['resource'] === $b['resource']) {
                if ($a['annotation']->getRoute()->getPath() === $b['annotation']->getRoute()->getPath()) {
                    $methodA = array_search($a['annotation']->getRoute()->getMethods(), $methodOrder);
                    $methodB = array_search($b['annotation']->getRoute()->getMethods(), $methodOrder);

                    if ($methodA === $methodB) {
                        return strcmp(
                            implode('|', $a['annotation']->getRoute()->getMethods()),
                            implode('|', $b['annotation']->getRoute()->getMethods())
                        );
                    }

                    return $methodA > $methodB ? 1 : -1;
                }

                return strcmp(
                    $a['annotation']->getRoute()->getPath(),
                    $b['annotation']->getRoute()->getPath()
                );
            }

            return strcmp($a['resource'], $b['resource']);
        });

        return $array;
    }
}
