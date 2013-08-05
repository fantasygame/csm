<?php

/**
 * Database tool
 *
 * @author PHP Summer Workshop
 */
class Database extends PDO
{

	/**
	 * 
	 * @param string $host host
	 * @param string $user username
	 * @param string $password password
	 * @param string $engine database engine (mysql default)
	 * @param string $database database name
	 */
	public function __construct($host, $user, $password, $engine = 'mysql', $database = null)
	{
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_PERSISTENT => false,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4'
		);
		$dsn = "$engine:host=$host";
		if(!is_null($database)) {
			$dsn .= ";dbname=$database";
		}
		parent::__construct($dsn, $user, $password, $options);
	}

}

?>
