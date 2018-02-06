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
 
namespace Akbarhashmi\Engine;
 
use Pimple\Container as PimpleContainer;

/**
 * Container.
 */
class Container
{
    
    /**
     * @var object $instance The pimple container instance.
     */
    private static $instance = \null;
    
    /**
     * Set the container
     *
     * @param object|PimpleContainer The pimple container.
     *
     * @return void.
     */
    public static function setContainer(PimpleContainer $pimpleContaner): bool
    {
        // Set the container instance.
        self::$instance = $pimpleContaner;
     
        return \true;
    }
    
    /**
     * Get the container instance.
     *
     * @throws InvalidArgumentException If the container is not an instance of the
     *                                  pimple container. 
     *
     * @return object|PimpleContainer Return the container instance.
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof PimpleContainer))
        {
            throw new Exception\InvalidArgumentException('The container is not an instance of the pimple container.');
        }
        // Get the container.
        return self::$instance;
    }
    
    /**
     * Clear the container cache.
     *
     * @return void.
     * 
     * @codeCoverageIgnore
     */
    public static function clear()
    {
        self::$instance = \null;
    }
    
}
