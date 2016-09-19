<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<title>Материал</title>
		<link rel="stylesheet" href="../css/style.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript">
		</script>
</head>

<body>
	<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
		<div style="padding-top : 25px;">
		</div>
		<p>Статистика загрузки материалов:</p>
		<table id="statTable" class="table table-striped table-bordered">
		<thead>
		<tr>
		<td>Количество статей</td>
		<td>Дата загрузки</td>
		</tr>
		</thead>
		<tbody>
		<?php
			$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
			$result = pg_query($dbcon, "SELECT COUNT(*), load_date FROM load_article_stat group by load_date order by load_date desc;");
		    while ($fixrow = pg_fetch_row($result)) {
				echo '<tr>';
				echo '<td>'.$fixrow[0].'</td>';
				echo '<td>'.$fixrow[1].'</td>';
				echo '</tr>';
			}
		?>
		</tbody>
		</table>
		</div>
		<div class="col-sm-2">
		<?php 
		    $page = 'page3'; 
			include '../components/menu.php'; 
		?>	
		</div>
	</div>
</body>
</html>