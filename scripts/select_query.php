<?php
	
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
	}
	
	$param = $_GET['resp'];
	$con = mysql_connect('127.0.0.1:9306') or die ("Couldn't connect to Sphinx engine.");
	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
	$cl = new SphinxClient ();
	$cl->setServer("localhost",9312);
	
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
	
	$sQuery = "	SELECT id FROM test1 where MATCH('%$param%') ORDER BY time_idx DESC $sLimit";
	$rResult = mysql_query($sQuery) or die(mysql_error());
	
	
	while($row = mysql_fetch_array($rResult)) {
			$buf = array();
			$result[] = $row['id'];
			$id = $row['id'];
		    $result = pg_query($dbcon, "SELECT article_main.title, article_main.pub_date, articles_sources.description, article_main.artc_text FROM article_main JOIN articles_sources ON article_main.source_uid=articles_sources.id WHERE article_main.id=$id");
 		    while ($fixrow = pg_fetch_row($result)) {
				$trim_name = $fixrow[0];
				$trim_name = mb_substr($trim_name,0,250);
				if (strlen($fixrow[0]) > 250) {
					$trim_name=$trim_name.'...';
				}
				
				$docs = array
				(
					$fixrow[3]
				);
				$words = $param;
				$index = "test1";
				$opts = array
				(
					"before_match"		=> "<b>",
					"after_match"		=> "</b>",
					"chunk_separator"	=> " ... ",
					"limit"				=> 80,
					"around"			=> 3,
					"query_mode"			=>1
				);

			  	$descr ="";
				$res = $cl->BuildExcerpts ( $docs, $index, $words, $opts );
				if ( !$res ) {
					die ( "ERROR: " . $cl->GetLastError() . ".\n" );
				} else {
					$n=0;
					foreach ( $res as $entry ) {
						$descr=$descr.$entry;
						$n++;
					}
				}				
				
				$buf[] = "<td><a href=\"pages/article.php?id=$id&pattern=$param\" style=\"text-decoration:none;\" >$trim_name</a><br />$descr<br /><font color=\"green\">$fixrow[1]<tab4></tab4>$fixrow[2]</font></td>";
			}
			$output['aaData'][] = $buf;
	} 	
	
	echo json_encode( $output );

?>