<?php

/**
 * Description of HindranceRepository
 *
 * @author 
 */
class EdgeRepository
{
	/* @var $mysql MySql */

	private $mysql;

	public function __construct(MySql $mysql)
	{
		$this->mysql = $mysql;
	}

	public function persistRelation(Edge $edge, Sheet $sheet)
	{
		$query = "
		INSERT INTO `sheet_edge` (
			`id` ,
			`sheet_id` ,
			`edge_id`			
		)
		VALUES (
			NULL,
			'{$sheet->getId()}',
			'{$edge->getId()}'
		);
		";

		$this->mysql->query($query);
	}

}

?>
