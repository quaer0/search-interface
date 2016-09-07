<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
    if ($_GET['q'] !== '') {
	$con = mysql_connect('127.0.0.1:9306') or die ("Couldn't connect to Sphinx engine.");
	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<title>Поиск материалов</title>
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript">
		</script>
	</head>
	<body>
		<form action="index.php" method="GET" id="searchForm" />
			<input type="text" name="q" id="searchBar" placeholder="" value="" maxlength="50" autocomplete="off" />
			<input type="submit" id="searchBtn" value="Найти" />
		</form>
	<?php
	    $resp = $_GET['q']; 
	    if (!isset($resp)) {
		echo '';
	    } else {
		$query = mysql_query("SELECT id FROM test1 where MATCH('%$resp%') LIMIT 0,50");
		$num_rows = mysql_num_rows($query);
		$art_num=0;
		while($row = mysql_fetch_array($query)){
		    $art_num = $art_num + 1;
		    $id = $row['id'];
		    $result = pg_query($dbcon, "SELECT title FROM article_main WHERE id=$id");
		    while ($fixrow = pg_fetch_row($result)) {
			echo '<h3><a href="' . $art_num . '.php">' . $art_num . '.' . substr($fixrow[0], 0, 250) . '</h3><br />';
		    }
		}
	    }
	?>
	</body>
</html>
<?php
    } else {
	header('Location: index.php');
    }
?>