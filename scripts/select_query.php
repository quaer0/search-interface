<?php
	
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
	}
	
	$param = $_GET['resp'];
	$con = mysql_connect('127.0.0.1:9306') or die ("Couldn't connect to Sphinx engine.");
	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
	
	$sQuery = "SELECT count(*) FROM test1 where MATCH('%$param%')";
	$rResultTotal = mysql_query($sQuery) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotalFilt = $aResultTotal[0];
	
	$sQuery = "SELECT count(*) FROM test1";
	$rResultTotal = mysql_query($sQuery) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iTotalFilt,
		"aaData" => array()
	);
	
	$sQuery = "	SELECT id FROM test1 where MATCH('%$param%') $sLimit";
	$rResult = mysql_query($sQuery) or die(mysql_error());
	
	
	while($row = mysql_fetch_array($rResult)) {
			$buf = array();
			$result[] = $row['id'];
			$id = $row['id'];
		    $result = pg_query($dbcon, "SELECT article_main.title, article_main.pub_date, articles_sources.description FROM article_main JOIN articles_sources ON article_main.source_uid=articles_sources.id WHERE article_main.id=$id");
 		    while ($fixrow = pg_fetch_row($result)) {
				$trim_name = $fixrow[0];
				$trim_name = mb_substr($trim_name,0,250);
				if (strlen($fixrow[0]) > 250) {
					$trim_name=$trim_name.'...';
				}
				$buf[] = "<td><a href=\"pages/article.php?id=$id\" style=\"text-decoration:none;\" >$trim_name</a><br />Здесь должно быть описание выбранной статьи<br /><font color=\"green\">$fixrow[1]&thinsp;$fixrow[2]</font></td>";
			}
			$output['aaData'][] = $buf;
	} 	
	
	echo json_encode( $output );

?>