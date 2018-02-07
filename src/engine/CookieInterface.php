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

use ParagonIE\Halite\Cookie as ParagonieCookie;
use ParagonIE\Halite\Symmetric\EncryptionKey;
use ParagonIE\Halite\HiddenStrin;

/**
 * CookieInterface.
 *
 * @codeCoverageIgnore
 */
interface CookieInterface
{
    
    /**
     * Set the cookie encryption key.
     *
     * @param array $config The config array to use.
     *
     * @return void.
     */
    function __construct(array $config);
    
    /**
     * Set a new cookie.
     *
     * @param array  $options The list of options to run.
     * @param string $name    The name of the cookie.
     * @param mixed  $value   The cookie value.
     * @param int    $expire  The cookie expiration time.
     *
     * @return void.
     */
    public function set(array $options, string $name, string $value, $expire);
    
    /**
     * Fetch a cookie by name.
     *
     * @param array  $options The list of options to run.
     * @param string $name    The name of the cookie.
     *
     * @return mixed The cookie value or if it does not exist
     *               Return a blank string.
     */
    public function fetch(array $options, string $name): string;
    
    /**
     * Delete a cookie by name.
     *
     * @param string $name The name of the cookie.
     *
     * @return void.
     */
    public function delete(string $name);
    
}
