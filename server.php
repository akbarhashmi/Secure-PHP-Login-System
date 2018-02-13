<?php
declare(strict_types=1);
/**
 * This file is a part of secure-php-login-system.
 *
 * @author Akbar Hashmi (Owner/Developer)           <me@akbarhashmi.com>.
 * @author Nicholas English (Collaborator/Developer) <nenglish0820@outlook.com>.
 *
 * @link    <https://github.com/akbarhashmi/Secure-PHP-Login-System> Github repository.
 * @license <https://github.com/akbarhashmi/Secure-PHP-Login-System/blob/master/LICENSE> MIT license.
 */

// Define the system root.
define('SYSTEM_ROOT', __DIR__);

// Check composer.
if (!file_exists(SYSTEM_ROOT . '/vendor/autoload.php')) {
    trigger_error('You need to run composer install or else the system will not run.', E_USER_ERROR);
}

// Just in case require composer.
// Use require once so composer does not get loaded twice.
require_once SYSTEM_ROOT . '/vendor/autoload.php';

// Load the Engine\App configuration.
require_once SYSTEM_ROOT . '/load.php';

// Start pimple.
$container = new Pimple\Container();

// Inject the configuration.
$container['config'] = $config;

// Create a database connection.
$container['db'] = function ($c)
{
    if ($c['config']['db']['driver'] == 'mysql')
    {
        // Start a MySQL connection.
        return new Akbarhashmi\Engine\Database\MySQLConnect(
            $c['config']['db']['hostname'],
            $c['config']['db']['port'],
            $c['config']['db']['database'],
            $c['config']['db']['username'],
            $c['config']['db']['password'],
            $c['config']['db']['debug']
        );
    } elseif ($c['config']['db']['driver'] == 'pgsql')
    {
        // Start a PgSQL connection.
        return new Akbarhashmi\Engine\Database\PostgreSQLConnect(
            $c['config']['db']['hostname'],
            $c['config']['db']['port'],
            $c['config']['db']['database'],
            $c['config']['db']['username'],
            $c['config']['db']['password'],
            $c['config']['db']['debug']
        );
    } else
    {
        // Kill the script if an invalid driver is passed.
        die('Database driver is not supported.');
    }
};

// Inject the cookie handler.
$container['cookie'] = $container->factory(function ($c)
{
    return new Akbarhashmi\Engine\Cookie($c['config']);
});

// Inject the session handler.
$container['session'] = $container->factory(function ($c)
{
    return new Akbarhashmi\Engine\Session\Session($c['config']);
});

// Inject the language switcher.
$container['lang'] = $container->factory(function ($c)
{
    return new Akbarhashmi\Engine\Session\Session(
        $c['config'],
        $c['session'],
        $c['cookie']
    );
});

// Check to see if the secure session should be auto started.
if ((bool) $container['config']['session']['auto_start'] === true)
{
    // Start a secure session.
    engine('session')->start();   
}

// Our container management.
Akbarhashmi\Engine\Container::setContainer($container);
function engine($service = null)
{
    // Check the service data type
    if (!is_null($service) && !is_string($service))
    {
        // Return null.
        return null;
    }
    // Get the container instance.
    $container = Akbarhashmi\Engine\Container::getInstance();
    // Check to see if a service is passed.
    if (is_null($service))
    {
        // Return the engine pimple container.
        return $container;
    }
    // Return the service.
    return $container[(string) $service];
}
