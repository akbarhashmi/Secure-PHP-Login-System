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
 * SessionManagerInterface.
 */
interface SessionManagerInterface
{
    
    /**
     * Set the config array.
     *
     * @param array $config The config array.
     *
     * @return void.
     */
    function __construct(array $config);
    
    /**
     * Start a secure php session.
     *
     * @return bool Return TRUE if a session is now running.
     */
    public function start(): bool;
    
    /**
     * Regenerate a new session id.
     *
     * @param bool $deleteOldSession Should we delete the old session.
     *
     * @return bool Return TRUE if the session id was regenerated and
     *              FALSE if it ws not.
     */
    public static function regenerate(bool $deleteOldSession = \true): bool;
    
    /**
     * Is the session running expired.
     *
     * @return bool Return TRUE if the session is expired and
     *              FALSE if is not expired.
     */
    public function isExpired(): bool;
    
    /**
     * Check to see if a session is running.
     *
     * @return bool Return TRUE if a session is running and
     *              return FALSE if it is not running.
     */
    public function sessionExists(): bool;
    
    /**
     * Destroy a session currently running.
     *
     * @return bool Return TRUE if the session is destroyed
     */
    public function destroySession(): bool;
    
}
