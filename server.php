<?php
declare(strict_types=1);
/**
 * This file is a part of secure-php-login-system.
 *
 * @author Akbar Hashmi (Owner/Developer)           <me@akbarhashmi.com>.
 * @author Nicholas English (Contributor/Developer) <nenglish0820@outlook.com>.
 *
 * @link    <https://github.com/akbarhashmi/Secure-PHP-Login-System> Github repository.
 * @license <https://github.com/akbarhashmi/Secure-PHP-Login-System/blob/master/LICENSE> MIT license.
 */
define('SYSTEM_ROOT', __DIR__);

// Check composer.
if (!file_exists(SYSTEM_ROOT . '/vendor/autoload.php')) {
    trigger_error('You need to run composer install or else the system will not run.', E_USER_ERROR);
}

// Just in case require composer.
require_once SYSTEM_ROOT . '/vendor/autoload.php';

// Load the Engine\App configuration.
require_once SYSTEM_ROOT . '/load.php';

// Start pimple.
$container = new Pimple\Container();

// Inject the configuration.
$container['config'] = $config;

// Create a database connection.
// Right now only mysql/pgsql/oracle databases are supported.
$container['db'] = function ($c)
{
    if ($c['config']['db']['driver'] == 'mysql')
    {
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
        return new Akbarhashmi\Engine\Database\PostgreSQLConnect(
            $c['config']['db']['hostname'],
            $c['config']['db']['port'],
            $c['config']['db']['database'],
            $c['config']['db']['username'],
            $c['config']['db']['password'],
            $c['config']['db']['debug']
        );
    } elseif ($c['config']['db']['driver'] == 'oracle')
    {
        return new Akbarhashmi\Engine\Database\OracleConnect(
            $c['config']['db']['hostname'],
            $c['config']['db']['port'],
            $c['config']['db']['database'],
            $c['config']['db']['username'],
            $c['config']['db']['password'],
            $c['config']['db']['instant_client'],
            $c['config']['db']['debug']
        );
    } else
    {
        die('Database driver is not supported.');
    }
};

// Inject the cookie handler.
$container['cookie'] = $container->factory(function ($c)
{
    return new Akbarhashmi\Engine\Cookie($c['config']);
});

// Our container management.
Akbarhashmi\Engine\Container::setContainer($container);
function engine($service = null)
{
    $container = Akbarhashmi\Engine\Container::getInstance();
    if (is_null($service))
    {
        return $container;
    }
    return $container[(string) $service];
}
