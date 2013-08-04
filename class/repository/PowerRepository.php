<?php


class PowerRepository
{
	public function __construct(MySql $mysql)
	{
		$this->mysql = $mysql;
	}
		public function persist(Power $power, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_power` (
			`id` ,
			`sheet_id` ,
			`power_id`			
		)
		VALUES (
			NULL,
			'{$sheet->getId()}',
			'{$power->getId()}'
		);
		";

		$this->mysql->query($query);
	}
}

?>
