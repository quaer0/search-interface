<?php

	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".$_GET['iDisplayLength']." OFFSET ".$_GET['iDisplayStart'];
	}

	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");

	$result = pg_query($dbcon, "SELECT block_name, load_date FROM rkt_load_block_stat order by id desc $sLimit");

	$sQuery = "SELECT count(*) FROM rkt_load_block_stat";
	$rResultTotal = pg_query($sQuery) or die ("Couldn't connect to PgSQL Database.");
	$aResultTotal = pg_fetch_row($rResultTotal);
	$iTotalFilt = $aResultTotal[0];

	$sQuery = "SELECT count(*) FROM rkt_load_block_stat";
	$rResultTotal = pg_query($sQuery) or die ("Couldn't connect to PgSQL Database.");
	$aResultTotal = pg_fetch_row($rResultTotal);
	$iTotal = $aResultTotal[0];

	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iTotalFilt,
		"aaData" => array()
	);


 	while ($fixrow = pg_fetch_row($result)) {
		$output['aaData'][] = array($fixrow[0],$fixrow[1]);
	}


	echo json_encode( $output );

?>
