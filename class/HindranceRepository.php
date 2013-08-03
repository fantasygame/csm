<?php

/**
 * Description of HindranceRepository
 *
 * @author 
 *
 *
 *
 *
 */
class HindranceRepository
{
	/* @var $mysql MySql */
	private $mysql;
	
		public function __construct(MySql $mysql)
	{
		$this->mysql = $mysql;
	}

	public function persist(Hindrance $hindrance, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_hindrance` (
			`id` ,
			`sheet_id` ,
			`hindrance_id`			
		)
		VALUES (
			NULL,
			'{$sheet->getId()}',
			'{$hindrance->getId()}'
			
		);
		";
		
		
			$this->mysql->query($query);
		
	}
	
}

?>
