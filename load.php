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

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

// List the configuration files.
$configFiles = [
    'cookie.conf.yml',
    'lang.conf.yml'
    'login.conf.yml',
    'oauth.conf.yml',
    'other.conf.yml',
    'register.conf.yml',
    'security.conf.yml',
    'session.conf.yml',
    'db.conf.yml'
];

// Temp variable.
$config = [];

// Load the configuration.
foreach ($configFiles as $configFile)
{
    try
    {
        $contents = Yaml::parseFile(SYSTEM_ROOT . "/config/{$configFile}");
        // Get the config array key.
        $file_data = explode('.', $configFile);
        reset($file_data);
        // Inject the config in the config array.
        $config[$file_data[0]] = $contents;
    } catch (ParseException $e)
    {
        // Stop execution and print an error.
        printf('Unable to parse the YAML string: %s', $e->getMessage());
    }
}
