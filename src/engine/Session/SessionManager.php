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
 * SessionManager.
 *
 * @codeCoverageIgnore
 */
class SessionManager implements SessionManagerInterface
{
    
    /**
     * @var array $config The config array.
     */
    private $config;
    
    /**
     * Set the config array.
     *
     * @param array $config The config array.
     *
     * @return void.
     */
    function __construct(array $config)
    {
        $this->config = $config;
    }
    
    /**
     * Start a secure php session.
     *
     * @return bool Return TRUE if a session is now running.
     */
    public function start(): bool
    {
        // Check to see if a session is already running.
        if ($this->sessionExists())
        {
            // Return true.
            return \true;
        }
        // Set the session name.
        \session_name((string) $this->config['session']['name']);
        // Set security guards.
        // This makes it harder for attackers. 
        \ini_set('session.use_cookies', (string) $this->config['session']['use_cookies']); // Recommended.
        \ini_set('session.use_only_cookies', (string) $this->config['session']['use_only_cookies']); // Recommended.
        \ini_set('session.use_strict_mode', (string) $this->config['session']['use_strict_mode']); // Recommended.
        // Set the cookie params for the session.
        \session_set_cookie_params(
            0, // Should always be 0 to prevent bugs/issues.
            $this->config['cookie']['path'],
            $this->config['cookie']['domain'],
            $this->config['cookie']['secure'],
            $this->config['cookie']['http_only']
        );
        // Actually start the session.
        \session_start();
        // Check to see if the session is expired.
        if ($this->isExpired())
        {
            // Destory the session.
            $this->destroySession();
        }
        // Return true.
        return \true;
    }
    
    /**
     * Regenerate a new session id.
     *
     * @param bool $deleteOldSession Should we delete the old session.
     *
     * @return bool Return TRUE if the session id was regenerated and
     *              FALSE if it ws not.
     */
    public static function regenerate($deleteOldSession = true)
    {
        return \session_regenerate_id($deleteOldSession);
    }
    
    /**
     * Is the session running expired.
     *
     * @return bool Return TRUE if the session is expired and
     *              FALSE if is not expired.
     */
    public function isExpired(): bool
    {
        // Check to see if the session is expired.
        if (isset($_SESSION['LAST_ACTIVITY']) && (\time - $_SESSION['LAST_ACTIVITY']) > $this->config['session']['expire_seconds'])
        {
            // Return true.
            return \true;
        }
        // Return false.
        return \false;
    }
    
    /**
     * Check to see if a session is running.
     *
     * @return bool Return TRUE if a session is running and
     *              return FALSE if it is not running.
     */
    public function sessionExists(): bool
    {
        // Return the current session state.
        return \session_status() === \PHP_SESSION_ACTIVE ? \true : \false;
    }
    
    /**
     * Destroy a session currently running.
     *
     * @return void.
     */
    public function destroySession()
    {
        // Delete all the session variables.
        $_SESSION = [];
        // Get the session cookie params set.
        $params = \session_get_cookie_params();
        // Set the cookie to expire.
        \setcookie(
            \session_name(),
            '',
            \time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
        // Destroy the session.
        \session_destroy();
    }
    
}
