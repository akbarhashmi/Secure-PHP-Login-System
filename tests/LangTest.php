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
 
namespace Akbarhashmi\Engine;
 
use Pimple\Container as PimpleContainer;
use PHPUnit\Framework\TestCase;

/**
 * LangTest.
 */
final class LangTest extends TestCase
{
    public function testLang()
    {
        $container = new PimpleContainer();
        $container['config'] = [
            'name' => 'akbarhashmiSession',
            'auto_start' => true,
            'use_cookies' => true,
            'use_only_cookies' => true,
            'use_strict_mode' => true,
            'expire_seconds' => 1800
        ];
        $container['session'] = $container->factory(function ($c)
        {
            return new Session\Session($c['config']);
        });
        $container['cookie'] = $container->factory(function ($c)
        {
            return new Cookie($c['config']);
        });
        $container['lang'] = $container->factory(function ($c)
        {
            return new Session\Session(
                $c['config'],
                $c['session'],
                $c['cookie']
            );
        });
        $this->assertEquals($container['lang']->convertExpireDate(2), \time() + (60 * 60 * 24 * (365 * 2)));
        $this->assertEquals($container['lang']->all(true), \json_encode(include(SYSTEM_ROOT . '/langs/en.php')));
        $this->assertEquals($container['lang']->all(false), include(SYSTEM_ROOT . '/langs/en.php'));
    }
}
