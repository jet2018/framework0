<?php

namespace Jet\Framework\Core;

use Exception;
use PDO;

class Connection
{
    private  $username;
    private  $db;
    private  $password;
    private  $port;
    private  $options;
    private  $driver;
    private  $server;
    private  $params;
    /**
     * @var array|mixed
     */
    private  $config = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (defined('DATABASE')){
            $this->config = $GLOBALS['DATABASE'];
        }else{
            throw new CoreDbError("No database configuration discovered, It should be saved with a constant name of DATABASE");
            return;
        }
        $this->username = $this->config['username'];
        $this->server = $this->config['server'];
        $this->db = $this->config['database'];
        $this->password = $this->config['password'];
        $this->port = $this->config['port'];
        $this->options = $this->config['options'];
        $this->driver = $this->config['driver'];

    }

    /**
     * @param array|mixed $config
     */
    public function setConfig(mixed $config): void
    {
        $this->config = $config;
    }

    /**
     * @return array|mixed
     */
    public function getConfig(): mixed
    {
        return $this->config;
    }

    /**
     * @return string
     */
    public function dsn(): string
    {
        return $this->driver . ':host=' . $this->server. ';dbname=' . $this->db . ';port=' . $this->port . ";charset=UTF8";
    }

    /**
     * @return PDO
     */
    public function connection(): PDO
    {
        $driver_options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );
        if (is_array($this->options)){
            $options = array_merge($this->options, $driver_options);
        }
        else{
            $options = $driver_options;
        }
        $conn = new PDO($this->dsn(), $this->username, $this->password, $options);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getDb(): string
    {
        return $this->db;
    }

    /**
     * @return array|mixed
     */
    public function getOptions(): mixed
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return integer
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $db
     */
    public function setDb(string $db): string
    {
        return $this->db = $db;
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver): string
    {
        return $this->driver = $driver;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): array
    {
       return $this->options = $options;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): array
    {
        return $this->params = $params;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): string
    {
       return $this->password = $password;
    }

    /**
     * @param integer $port
     */
    public function setPort(int $port): int
    {
       return $this->port = $port;
    }

    /**
     * @param string $server
     */
    public function setServer(string $server): string
    {
        return $this->server = $server;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): string
    {
       return $this->username = $username;
    }

    public function beginTransaction(): bool
    {
        return $this->connection()->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->connection()->inTransaction() && $this->connection()->commit();
    }

    /**
     * @throws CoreDbError
     */
    public function __destruct(){
        try {
            $this->connection();
        } catch (Exception  $e){
            throw new CoreDbError($message=$e->getMessage());
        }
    }
}

