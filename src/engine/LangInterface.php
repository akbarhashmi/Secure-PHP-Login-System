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
 
namespace Akbarhashmi\Engine;
 
/**
 * Lang.
 */
class Lang implements LangInterface
{
    
    /**
     * @var array|[] $config The config array to be used.
     */
    private $config = [];
    
    /**
     * @var object|Session $session The session handler class.
     */
    private $session;
    
    /**
     * @var object|Cookie $cookie The cookie handler.
     */
    private $cookie;
    
    /**
     * Get the configuration for the engine and inject the session
     * handler class in this class.
     *
     * @param array          $config  The config array to use.
     * @param object|Session $handler The session handler.
     * @param object|Cookie  $cookie  The cookie handler.
     *
     * @return void.
     *
     * @codeCoverageIgnore
     */
    function __construct(array $config, Session $handler, Cookie $cookie)
    {
        // Set the configuration array.
        $this->config = $config;
        // Bind the session handler to a private variable.
        $this->session = $handler;
        // Bind the cookie handler to a private variable.
        $this->cookie = $cookie;
    }
  
    /**
     * Get all the translations of a language.
     *
     * @param bool $jsonEncode Should we return in json format.
     *
     * @return mixed Return a json format array or a php array
     *               of the translation.
     */
    public function all(bool $jsonEncode);
    
    /**
     * Get a translation value by key.
     *
     * @param string $key         The array key index.
     * @param array  $bindings|[] The list of binding values to replace.
     * 
     * @return string Return the key value if the key exists and return
     *                a blank string if it does not.
     */
    public function get(string $key, array $bindings = []): string;

    /**
     * Set the language to use during execution.
     *
     * @param string $lang The language to set.
     *
     * @return bool Returns TRUE if the language was changed properly and
     *              return FALSE if it was not changed properly.
     */
    public function setLanguage($language): bool;

    /**
     * Get current language based on cookie and session data.
     *
     * @return string Returns the current language and if there is no
     *                language data it will return the default english
     *                language.
     */
    public function getLanguage(): string;
    
    /**
     * Convert the number of years to cookie format.
     *
     * @param int $yrs The number of years.
     *
     * @return int The converted number of years.
     */
    public function convertExpireDate(int $yrs);
    
}

