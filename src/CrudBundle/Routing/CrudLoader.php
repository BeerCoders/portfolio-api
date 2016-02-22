<?php
/**
 * This file is part of the vardius/crud-bundle package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CrudBundle\Routing;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Routing\RouteCollection;
use Vardius\Bundle\CrudBundle\Actions\ActionInterface;
use Vardius\Bundle\CrudBundle\Controller\CrudController;
use Vardius\Bundle\CrudBundle\Routing\CrudPool;
use Vardius\Bundle\ListBundle\Filter\Filter;
use Vardius\Bundle\ListBundle\Filter\Types\FilterType;

/**
 * CrudLoader
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class CrudLoader extends \Vardius\Bundle\CrudBundle\Routing\CrudLoader implements LoaderInterface
{
    protected $container;

    /**
     * @inheritDoc
     */
    public function __construct(CrudPool $pool, ContainerInterface $container)
    {
        parent::__construct($pool);
        $this->container = $container;
    }

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     * @param string|null $type The resource type or null if unknown
     *
     * @return RouteCollection
     */
    public function load($resource, $type = null)
    {
        $routes = new RouteCollection();

        foreach ($this->pool->getControllers() as $controllerKey => $controller) {
            /** @var CrudController $controller */
            foreach ($controller->getActions() as $actionKey => $action) {
                /** @var ActionInterface $action */
                $options = $action->getOptions();

                $pattern = rtrim($controller->getRoutePrefix() . $options['pattern'], '/');

                $defaults = $options['defaults'];
                $defaults['_controller'] = $controllerKey . ':' . 'callAction';
                $defaults['_action'] = $actionKey;

                $doc = $this->getDoc($controller, $actionKey, $options);

                $route = new Route(
                    $pattern,
                    $defaults,
                    $options['requirements'],
                    $options['options'],
                    $options['host'],
                    $options['schemes'],
                    $options['methods'],
                    $options['condition']
                );
                $route->setDoc($doc);

                $routeSuffix = (empty($options['route_suffix']) ? $actionKey : $options['route_suffix']);
                $routes->add($controllerKey . '.' . $routeSuffix, $route);
            }
        }

        return $routes;
    }

    protected function getDoc(CrudController $controller, $actionKey, $options)
    {
        $section = ucfirst(ltrim($controller->getRoutePrefix(), '/'));
        $parameters = array_key_exists('parameters', $options) ? $options['parameters'] : [];
        $filters = $actionKey === 'list' ? $this->getFilters($section) : [];
        $form = $controller->getFormType();
        $input = $form ? get_class($form) : '';

        $config = [
            'resource' => true,
            'section' => $section,
            'description' => ucfirst($actionKey) . " action",
            'statusCodes' => [
                200 => "OK",
                201 => "Created",
                202 => "Accepted",
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',
                207 => 'Multi-Status',
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported',
            ],
            'filters' => $filters,
            'parameters' => $parameters
        ];

        $action = $controller->getAction($actionKey);
        $options = $action->getOptions();
        if (array_key_exists('checkAccess', $options) && array_key_exists('attributes', $options['checkAccess'])) {
            $config['authentication'] = true;
            $config['authenticationRoles'] = $options['checkAccess']['attributes'];
        }

        if ($actionKey === 'add' || $actionKey === 'edit') {
            $config['input'] = $input;
        }

        return new ApiDoc($config);
    }

    /**
     * @param $section
     * @return array
     */
    protected function getFilters($section)
    {
        $section = preg_replace('~[^\\pL\d]+~u', '_', $section);
        $section = trim($section, '-');

        if (!$this->container->has('provider.' . strtolower($section) . '_filter')) {
            return [];
        }

        if (!$this->container->has('form.type.' . strtolower($section) . '_filter')) {
            return [];
        }

        /** FilterProvider */
        $provider = $this->container->get('provider.' . strtolower($section) . '_filter');
        /** @var AbstractType $form */
        $form = $this->container->get('form.type.' . strtolower($section) . '_filter');

        $filters = $provider->getFilters();

        $docFilters = [];
        /**
         * @var string $key
         * @var Filter|callable $filter
         */
        foreach ($filters as $key => $filter) {
            $name = 'callable';
            if (!is_callable($filter) && $filter->getType() instanceof FilterType) {
                $name = $filter->getType()->getName();
            }
            $docFilters[] = ['name' => $form->getName() . '[' . $key . ']', 'type' => $name];
        }

        return $docFilters;
    }

}
