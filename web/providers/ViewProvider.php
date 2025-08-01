<?php

namespace web\providers;


use Arbor\view\Builder;
use Arbor\facades\Config;
use Arbor\view\ViewFactory;
use Arbor\fragment\Fragment;
use Arbor\facades\Container;
use Arbor\container\ServiceContainer;
use Arbor\contracts\container\ServiceProvider;
use Arbor\contracts\Container\ContainerInterface;

/**
 * Class ServiceProvider
 *
 * This service provider is responsible for registering and configuring a View service
 * within the application. It handles the creation of service instances, configuration setup,
 * and any other initialization tasks required for the service to function properly.
 *
 * Note: Service providers can be deferred or non-deferred depending on when the service
 * needs to be available in the application lifecycle.
 *
 * @package Arbor\providers
 * 
 */
class ViewProvider extends ServiceProvider
{
    /**
     * Register the service as a singleton in the container.
     *
     * This method creates a new service instance with the required dependencies
     * and registers it in the dependency injection container.
     *
     * @param ServiceContainer $container The dependency injection container instance.
     *
     * @return void
     */
    public function register(ContainerInterface $container): void
    {
        $container->singleton(ViewFactory::class, function (): ViewFactory {

            $view_dir = Config::get('app.views_dir');
            $fragment = Container::resolve(Fragment::class);

            return new ViewFactory($view_dir, $fragment);
        });
    }

    /**
     * Boot the service by performing any post-registration configuration.
     * 
     * This method is called after all services are registered.
     * It handles any initialization that depends on other services being available,
     * such as loading configurations, establishing connections, or setting up resources.
     *
     * @param ServiceContainer $container The dependency injection container instance.
     * 
     * @return void
     */
    public function boot(ContainerInterface $container): void
    {
        $viewFactory = $container->make(ViewFactory::class);

        $viewFactory->setConfig(
            [
                'assets_url' => Config::get('app.assets_url'),
                'statics_url' => Config::get('app.statics_url'),
            ]
        );

        $this->defaultPreset($viewFactory);
        $this->dashboardPreset($viewFactory);
    }


    protected function defaultPreset($viewFactory)
    {
        $viewFactory->default(function (Builder $builder, array $config) {

            $builder->addLink('preconnect', 'https://fonts.googleapis.com');

            $builder->addLink('preconnect', 'https://fonts.gstatic.com', ['crossorigin' => '']);

            $builder->addLink('stylesheet', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


            $builder->addLink('stylesheet', $config['statics_url'] . 'css/grid.css');

            $builder->addLink('stylesheet', $config['assets_url'] . 'css/utility.css');
        });
    }


    protected function dashboardPreset($viewFactory)
    {
        $viewFactory->extends(
            'default',
            'dashboard',
            function (Builder $builder, array $config) {
                $builder->addLink('stylesheet', $config['assets_url'] . 'css/dashboard.css');
                $builder->addLink('stylesheet', $config['assets_url'] . 'css/icons.css');
            }
        );
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
        return [];
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
        return [];
    }
}
