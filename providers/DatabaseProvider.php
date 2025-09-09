<?php

namespace App\providers;

use Arbor\facades\Config;
use Arbor\contracts\container\ServiceProvider;
use Arbor\contracts\Container\ContainerInterface;
use Arbor\database\connection\ConnectionPool;
use Arbor\database\DatabaseResolver;
use Arbor\database\orm\Model;

/**
 * Class AliasProvider
 *
 * This service provider is responsible for defining aliases for commonly used
 * services within the application. These aliases provide convenient shortcuts
 * to access core services from the dependency injection container.
 *
 * Unlike other providers, this provider doesn't register any new services;
 * it only creates aliases for services registered by other providers.
 *
 * @package Arbor\providers
 * 
 */
class DatabaseProvider extends ServiceProvider
{
    protected bool $defferred = true;

    /**
     * Register method implementation (required by ServiceProvider contract).
     *
     * This provider doesn't register any services, so this method is empty.
     * All functionality is handled through the aliases() method instead.
     *
     * @param ServiceContainer $container The dependency injection container instance.
     *
     * @return void
     */
    public function register(ContainerInterface $container): void
    {
        $container->singleton(ConnectionPool::class, function () {

            return new ConnectionPool(
                Config::get('database.connections'),
                Config::get('database.maxRetries'),
                Config::get('database.retryDelay')
            );
        });

        /**
         *
         * @param ServiceContainer $container The dependency injection container instance.
         *
         */
        $container->singleton(DatabaseResolver::class, function (ContainerInterface $container) {

            $connectionPool = $container->resolve(ConnectionPool::class);
            $databaseResolver = new DatabaseResolver($connectionPool);

            $databaseResolver->byConfig(
                Config::get('database.connections')
            );

            // default database at global level.
            $databaseResolver->setDefault('main');

            return $databaseResolver;
        });
    }

    /**
     * Setup Model
     *
     * @param ServiceContainer $container The dependency injection container instance.
     *
     */
    public function boot(ContainerInterface $container): void
    {
        $databaseResolver = $container->resolve(DatabaseResolver::class);
        Model::setResolver($databaseResolver);
    }


    /**
     * Services provided.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            ConnectionPool::class,
            DatabaseResolver::class
        ];
    }

    /**
     * Define aliases for known core services.
     *
     * This method creates shorthand aliases that can be used to resolve
     * commonly used services from the container without using their
     * fully qualified class names.
     *
     * @return array<string, string> An associative array mapping alias names
     *                              to their corresponding service class names.
     */
    public function aliases(): array
    {
        return [
            'ConnectionPool' => ConnectionPool::class,
            'dbPool' => ConnectionPool::class,
            'dbResolver' => DatabaseResolver::class
        ];
    }
}
