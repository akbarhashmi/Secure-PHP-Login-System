<?php
declare(strict_types=1);
/**
 * This file is a part of secure-php-login-system.
 *
 * @author Akbar Hashmi (Owner/Developer)            <me@akbarhashmi.com>.
 * @author Nicholas English (Collaborator/Developer) <nenglish0820@outlook.com>.
 *
 * @link    <https://github.com/akbarhashmi/Secure-PHP-Login-System> Github repository.
 * @license <https://github.com/akbarhashmi/Secure-PHP-Login-System/blob/master/LICENSE> MIT license.
 */
 
namespace Akbarhashmi\Engine\Session;

/**
 * SessionInterface.
 */
interface SessionInterface
{
    
    /**
     * Pass the config array to the manager.
     *
     * @param array $config The config array.
     *
     * @return void.
     */
    function __construct(array $config);
 
    /**
     * Set a session variable.
     *
     * @param string $name  The session variable name.
     * @param string $value The session variable value.
     *
     * @throws RuntimeException If no session is running.
     *
     * @return void.
     */
    public function set(string $name, string $value);
    
    /**
     * Get a session variable.
     *
     * @param string $name               The session variable name.
     * @param mixed  $defaultReturnValue The default return value.
     *
     * @throws RuntimeException If no session is running.
     *
     * @return mixed Return the session variable value and if
     *               it does not exist return the default return value
     *               passed.
     */
    public function get(string $name, $defaultReturnValue = \null);
    
    /**
     * Delete a session variable.
     *
     * @param string $name  The session variable name.
     *
     * @throws RuntimeException If no session is running.
     *
     * @return void.
     */
    public function delete(string $name);
    
}
