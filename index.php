<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    if ($_GET['q'] !== '') {
	/*$con = mysql_connect('127.0.0.1:9306') or die ("Couldn't connect to Sphinx engine.");
	$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");*/
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<title>Поиск материалов</title>
		<link rel="stylesheet" href="css/style.css" />
		<style>
			tab4 { padding-left: 8em; }
		</style>
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
		<form action="index.php" method="GET" id="searchForm" />
			<input type="text" name="q" id="searchBar" placeholder="" value="<?php echo $_GET['q'] ?>" maxlength="50" autocomplete="off" />
			<input type="submit" id="searchBtn" value="Найти" />
		</form>
		<div style="padding-top : 25px;">
		</div>
	<?php
	    $resp = $_GET['q']; 
	    if (!isset($resp)) {
		echo '';
	    } else {
		echo '<table class="table" id="searchTable">';
		echo '<thead style="display: none;">';
		echo '<tr>';
		echo '<td>Описание</td>';
		echo '</tr>';
		echo '</thead>';
		echo '<tfoot style="display: none;">';
		echo '<tr>';
		echo '<td>Описание</td>';
		echo '</tr>';
		echo '</tfoot>';
		echo '<tbody>';
		
	/*	$query = mysql_query("SELECT id FROM test1 where MATCH('%$resp%') LIMIT 0,50");
		$num_rows = mysql_num_rows($query);
		$art_num=0;
		while($row = mysql_fetch_array($query)){
		    $art_num = $art_num + 1;
		    $id = $row['id'];
		    $result = pg_query($dbcon, "SELECT title FROM article_main WHERE id=$id");
		    while ($fixrow = pg_fetch_row($result)) {
				echo '<tr>';
				echo '<td><a href="' . $id . '.php" style="text-decoration:none;" >' . $art_num . '.' . substr($fixrow[0], 0, 250) . '</td>';
				echo '</tr>';
			}
		} */	
		echo '</tbody>';
		echo '</table>';
		echo '<p><br /></p>';
	//	echo '</div>';
	    }
	?>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.dataTables.min.js"></script>
	<script src="bootstrap/js/dataTables.bootstrap.min.js"></script>
	<script>
		/*$('.has-clear input[type="text"]').on('input propertychange', function() {
		var $this = $(this);
		var visible = Boolean($this.val());
		$this.siblings('.form-control-clear').toggleClass('hidden', !visible);
		}).trigger('propertychange');

		$('.form-control-clear').click(function() {
			$(this).siblings('input[type="text"]').val('')
			.trigger('propertychange').focus();
	});*/
	</script>
	<script>
	$('#searchTable').DataTable( {
		searching: false,
		ordering: false,
		"bLengthChange": false,
		processing: false,
		"bAutoWidth": false,
		pageLength: 25,
		"bProcessing": true,
		"bServerSide": true,
// Надо вставить сюда вменяемую передачу параметров.
		"sAjaxSource": "scripts/select_query.php?resp=<?php echo $_GET['q']; ?>",  
		pagingType: 'simple_numbers',
		language: {
				paginate: {
					first:    'В начало',
					previous: 'Предыдущий',
					next:     'Дальше',
					last:     'Последний'
				},
				"info": "Страница _PAGE_ из _PAGES_"
		}	
    } );
	</script>
	</div>
	<div class="col-sm-2">
		<?php 
		    $page = 'page1'; 
			include 'components/menu.php'; 
		?>	
	</div>
	</div>
	</div>
	</body>
</html>
<?php
    } else {
	header('Location: index.php');
    }
?>