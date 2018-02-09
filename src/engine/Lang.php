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
    public function all(bool $jsonEncode)
    {
        // Get the language.
        $lang = $this->getLanguage();
        // Get the language translation array.
        $trans = $this->getTrans($lang);
        // Are we returning in json format.
        if ($jsonEncode)
        {
            // Return in json format.
            return \json_encode($trans);
        }
        // Return in a php array.
        return $trans;
    }
    
    /**
     * Get a translation value by key.
     *
     * @param string $key         The array key index.
     * @param array  $bindings|[] The list of binding values to replace.
     * 
     * @return string Return the key value if the key exists and return
     *                a blank string if it does not.
     */
    public function get(string $key, array $bindings = []): string
    {
        // Get the language file location.
        $language = $this->getLanguage();
        // Get the language translation array.
        $trans = $this->getTrans($language);
        // The key does not exist so return an empty string.
        if (!isset($trans[$key]))
        {
            // Return nothing because it does not exist.
            return '';
        }
        // The key exists so return the key value.
        $value = $trans[$key];
        // Replace any value bindings.
        if (!empty($bindings))
        {
            // Run a foreach to ensure all of them get replaced.
            foreach ($bindings as $key => $tempValue)
            {
                // Replace the value.    
                $value = \str_replace('{' . $key . '}', $tempValue, $value);
            }
        }
        // Return the value.
        return $value;
    }

    /**
     * Set the language to use during execution.
     *
     * @param string $lang The language to set.
     *
     * @return bool Returns TRUE if the language was changed properly and
     *              return FALSE if it was not changed properly.
     *
     * @codeCoverageIgnore
     */
    public function setLanguage($language): bool
    {
        // Check to see if the language is valid.
        if (!self::validLanguage($language)) {
            return \false;
        }
        // Convert the config lang time length to cookie expire format.
        // The convertor will assume that the numbers are referring to years.
        $getExpire = $this->convertExpireDate($this->config['engine']['default_language_time_length']);
        // Set the browser to remember this language for 1 year.
        // No encryption is needed since it is not sensitive data.
        $this->cookie->set(
            [
                'use_encrypt' => \false
            ],
            'lang',
            $language,
            $getExpire
        );
        // Add the data to the our session handler.
        $this->session->set('lang', $lang);
        // Language was switched sucessfully so return true.
        return \true;
    }

    /**
     * Get current language based on cookie and session data.
     *
     * @return string Returns the current language and if there is no
     *                language data it will return the default english
     *                language.
     *
     * @codeCoverageIgnore
     */
    public function getLanguage(): string
    {
        // Check the cookie for the language data.
        if ($this->cookie->get('lang', [
            'use_decrypt' => \false
        ]) && $this->validLanguage($this->cookie->get('lang', [
            'use_decrypt' => \false
        ])))
        {
            // Return the cookie data.
            return $this->cookie->get('lang', [
                'use_decrypt' => \false
            ]);
        }
        // Check session data and if it exists return that data else return the default language.
        return $this->session->get('lang', $this->config['engine']['default_language']);
    }
  
  
    /**
     * Get the language translation file.
     *
     * @param string $lang The language we are using.
     *
     * @throws RuntimeException If the language file requested does not exist.
     *
     * @return array Return an array of translations for the language.
     */
    private function getTrans(string $lang): array
    {
        // Get the string file location.
        $file = $this->getFile($lang);
        // Check to see if the language is valid.
        if ($this->validLanguage($lang))
        {
            // Return the translation array.
            $lang = include $file;
            return $lang;
        }
        // Throw an error if the function fails.
        throw new Exception\RuntimeException('The requested language translation file does not exist.');
    }

    /**
     * Get the language file location.
     *
     * @param string $lang The language to get.
     *
     * @return string Return the string location of the language file.
     *
     * @codeCoverageIgnore
     */
    private function getFile(string $lang): string
    {
        // Return the string file location.
        return \SYSTEM_ROOT  . "/langs/{$lang}.php";
    }

    /**
     * Check to see if the language file is valid.
     *
     * @param string $lang The language to test.
     *
     * @return bool Return TRUE if the language file is valid and
     *              return FALSE if it is invalid.
     *
     * @codeCoverageIgnore
     */
    private function validLanguage($lang): bool
    {
        // Returns true if the location exists and false if it does not.
        return \file_exists(self::getFile($lang));
    }
    
    /**
     * Convert the number of years to cookie format.
     *
     * @param int $yrs The number of years.
     *
     * @return int The converted number of years.
     */
    private function convertExpireDate(int $yrs)
    {
        // Return the data.
        return \time() + (60 * 60 * 24 * (365 * $yrs));
    }
    
}

