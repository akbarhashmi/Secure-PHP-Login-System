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

use Akbarhashmi\Engine\Exception\RuntimeException;

/**
 * Session.
 *
 * @codeCoverageIgnore
 */
class Session extends SessionManager implements SessionInterface
{
    
    /**
     * Pass the config array to the manager.
     *
     * @param array $config The config array.
     *
     * @return void.
     */
    function __construct(array $config)
    {
        parent::__construct($config);
    }
 
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
    public function set(string $name, string $value)
    {
        // Check to see if a session is running.
        if (!$this->sessionExists())
        {
            // No session is running.
            throw new RuntimeException('There is no session running.');
        }
        // Set the session variable.
        $_SESSION[$name] = $value;
    }
    
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
    public function get(string $name, $defaultReturnValue = \null)
    {
        // Check to see if a session is running.
        if (!$this->sessionExists())
        {
            // No session is running.
            throw new RuntimeException('There is no session running.');
        }
        // Check to see if it exists.
        if (isset($_SESSION[$name]))
        {
            //  Return the actual value.
            return $_SESSION[$name];
        }
        // Return the default value.
        return $defaultReturnValue;
    }
    
    /**
     * Delete a session variable.
     *
     * @param string $name  The session variable name.
     *
     * @throws RuntimeException If no session is running.
     *
     * @return void.
     */
    public function delete(string $name)
    {
        // Check to see if a session is running.
        if (!$this->sessionExists())
        {
            // No session is running.
            throw new RuntimeException('There is no session running.');
        }
        // Check to see if it exists.
        if (isset($_SESSION[$name]))
        {
            // Delete the session variable.
            unset($_SESSION[$name]);
        }
    }
    
}
