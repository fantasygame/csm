<?php

/**
 * Description of MySql
 *
 * @author kuba
 */
class Database extends PDO
{

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
