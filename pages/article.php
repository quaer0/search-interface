<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<title>Материал</title>
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript">
		</script>
</head>

<body>

 <?php
  
	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
	$id = $_GET['id'];
	$result = pg_query($dbcon, "SELECT title,artc_text FROM article_main WHERE id=$id");
    while ($fixrow = pg_fetch_row($result)) {
		echo '<h3>' . $fixrow[0] . '</h3> <br />';
		echo $fixrow[1];
	}
  
  ?>

</body>
</html>