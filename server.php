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

// Load the Engine\App configuration.
require_once SYSTEM_ROOT . '/load.php';

var_dump($configuration['cookie']['path']);

// Start pimple.
$container = new Pimple\Container();

// Inject the configuration.
$container['config'] = $configuration;

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
