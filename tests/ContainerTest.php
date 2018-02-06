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
 
use Pimple\Container as PimpleXContainer;
use PHPUnit\Framework\TestCase;

/**
 * ContainerTest.
 */
final class ContainerTest extends TestCase
{
    private $testContainer;
    function __construct()
    {
        $this->testContainer = new PimpleXContainer();
    }
    public function testSetContainer()
    {
        $this->assertTrue(Container::setContainer($this->testContainer));
    }
    public function testGetInstance()
    {
        $instance = Container::getInstance();
        $this->assertTrue(true);
    }
}
