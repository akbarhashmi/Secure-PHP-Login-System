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
 * ContainerTest.
 */
final class ContainerTest extends TestCase
{
    public function testSetContainer()
    {
        $this->assertTrue(Container::setContainer(new PimpleContainer));
    }
    public function testGetInstance()
    {
        $instance = Container::getInstance();
        $this->assertTrue(true);
    }
}
