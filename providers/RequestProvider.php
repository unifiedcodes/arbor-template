<?php

namespace App\providers;

use Arbor\contracts\container\ServiceProvider;
use Arbor\container\ServiceContainer;
use Arbor\contracts\Container\ContainerInterface;
use Arbor\facades\Config;
use Arbor\http\context\RequestStack;
use Arbor\http\RequestFactory;

/**
 * Class RequestProvider
 *
 * Registers core HTTP request context services.
 * Specifically, it binds the RequestStack as a singleton to maintain a shared
 * stack across main and sub-requests.
 *
 * @package Arbor\providers
 */
class RequestProvider extends ServiceProvider
{
    /**
     * Register request-related services.
     *
     * @param ServiceContainer $container
     * @return void
     */
    public function register(ContainerInterface $container): void
    {
        $rootURI = Config::get('root.uri');

        // singleton binding requestfactory
        $container->singleton(RequestFactory::class, fn() => new RequestFactory($rootURI));

        // Singleton binding ensures consistent request stack
        $container->singleton(RequestStack::class, fn() => new RequestStack());
    }

    /**
     * Services provided.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            RequestFactory::class,
            RequestStack::class
        ];
    }

    /**
     * Service aliases for shorthand resolving.
     *
     * @return array<string, string>
     */
    public function aliases(): array
    {
        return [
            'requestFactory' => RequestFactory::class,
            'requestStack' => RequestStack::class,
        ];
    }
}
