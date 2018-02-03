<?php
declare(strict_types=1);
/**
 * This file is a part of SuperBCMS.
 *
 * @author Nicholas English (Owner/Developer) <nenglish0820@outlook.com>.
 *
 * @link    <https://github.com/Nenglish7/SuperBCMS> Github repository.
 * @license <https://github.com/Nenglish7/SuperBCMS/blob/master/LICENSE> MIT license.
 */
 
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

define('SYSTEM_ROOT', __DIR__);
if (!file_exists(SYSTEM_ROOT . '/vendor/autoload.php'))
{
    trigger_error('You need to run composer install or else the system will not run.', E_USER_ERROR);
}
require_once SYSTEM_ROOT . '/vendor/autoload.php';
try
{
    $config = Yaml::parseFile(SYSTEM_ROOT . '/config.yaml');
    define('CONFIG', $config);
} catch (ParseException $e)
{
    printf('Unable to parse the YAML config file: %s', $e->getMessage());
    exit;
}
