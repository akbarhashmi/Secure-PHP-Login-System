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
 
namespace Akbarhashmi\Engine\Database;

/**
 * MySQLConnectInterface
 */
interface MySQLConnectInterface
{

    /**
     * Try to connect to the mysql server.
     *
     * @param string $hostname The database hostname.
     * @param string $port     The database port.
     * @param string $database The database name.
     * @param string $username The database username.
     * @param string $password The database password.
     * @param bool   $debug    Should we run debug.
     *
     * @throws InvalidArgumentException If the port argument is an invalid
     *                                  data type.
     * 
     * @return void.
     */
    public function __construct(string $hostname = 'localhost', $port = 3306, string $database, string $username, string $password = '', bool $debug = \false);

    /**
     * Should we be running debug mode.
     *
     * @param bool $debug Is debugging enabled.
     *
     * @return void.
     */
    public function debug(bool $debug);

    /**
     * Run a select sql query.
     *
     * @param string $sql The sql select string.
     * @param array  $array The list of parameters to bind.
     * @param int    $fetchMode int The PDO fetch mode to use.
     *
     * @return array Return the array fetch results.
     */
    public function select(string $sql, array $array = [], $fetchMode = PDO::FETCH_ASSOC): array;

    /**
     * Run an insert query.
     *
     * @param string $table The name of the table
     * @param array  $data  An array of data to insert.
     *
     * @return bool Return TRUE if the statement ran properly.
     */
    public function insert(string $table, array $data): bool;

    /**
     * Update an array of data in the database.
     *
     * @param string $table          The name of the table.
     * @param array  $data           An array of data to update.
     * @param string $where          Where to bind the array parameters.
     * @param array  $whereBindArray Parameters to bind to where part of query.
     *
     * @return bool Return TRUE if the statement ran properly.
     */
    public function update(string $table, array $data, string $where, array $whereBindArray = []): bool;

    /**
     * Run a delete query.
     *
     * @param string $table The name of the table.
     * @param string $where Where should we start binding.
     * @param array  $bind  The bind array data.
     * @param int    $limit How many rows are allowed to be deleted.
     *
     * @return bool Return TRUE if the statement ran properly.
     */
    public function delete(string $table, string $where, array $bind = [], int $limit = \null): bool;
    
}
