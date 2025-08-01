<?php

namespace web\providers;

use Arbor\contracts\container\ServiceProvider;
use Arbor\container\ServiceContainer;
use Arbor\contracts\Container\ContainerInterface;
use Arbor\router\Router;
use Arbor\facades\Route;
use Arbor\facades\Config;
use Arbor\facades\Container;
use Arbor\http\context\RequestStack;

/**
 * Class RouterProvider
 *
 * This service provider is responsible for registering and configuring the Router
 * service within the application. It handles the creation of the Router instance,
 * loading route definitions from configuration files, and setting up error pages.
 *
 * Note: This provider CANNOT be deferred since routes need to be registered 
 * during the boot process.
 *
 * @package Arbor\providers
 * 
 */
class RouterProvider extends ServiceProvider
{
    /**
     * Register the Router service as a singleton in the container.
     *
     * This method creates a new Router instance with the required dependencies
     * and registers it in the dependency injection container as a singleton.
     *
     * @param ServiceContainer $container The dependency injection container instance.
     *
     * @return void
     */
    public function register(ContainerInterface $container): void
    {
        $container->singleton(Router::class, function (): Router {

            $baseURI = Config::get('app.base_uri');

            $requestStack = Container::get(RequestStack::class);

            return new Router($requestStack);
        });
    }

    /**
     * Boot the Router service by loading route definitions.
     * 
     * This method is called after all services are registered.
     * It loads the application routes and error pages from their respective
     * configuration files.
     *
     * @param ServiceContainer $container The dependency injection container instance.
     * 
     * @return void
     */
    public function boot(ContainerInterface $container): void
    {
        /** @var Router $router */
        $router = $container->make(Router::class);

        // set router instance in facade.
        Route::setInstance($router);

        $routesDir = (string) Config::get('app.routes_dir');

        // Load the main application routes
        $router->groupOptions([
            'namespace' => 'web'
        ]);

        $router->groupByFile($routesDir . '/web.php');


        // Load error page definitions
        $router->errorPagesByFile($routesDir . '/errorPages.php');
    }

    /**
     * Get the list of services provided by this provider.
     *
     * This method returns an array of service identifiers that
     * this provider is responsible for registering.
     *
     * @return string[] An array of provided service class names.
     */
    public function provides(): array
    {
        return [Router::class];
    }

    /**
     * Get the aliases for the services provided by this provider.
     *
     * This method defines shorthand aliases that can be used to
     * resolve the registered services from the container.
     *
     * @return array<string, string> An associative array of aliases mapped to their service classes.
     */
    public function aliases(): array
    {
        return [
            'router' => Router::class,
        ];
    }
}
