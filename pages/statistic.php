<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<title>Материал</title>
		<link rel="stylesheet" href="../css/style.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
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
		<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#panel1">Перископ</a></li>
        <li><a data-toggle="tab" href="#panel2">РКТ</a></li>
				<li><a data-toggle="tab" href="#panel3">Без источника</a></li>
		</ul>

		<div class="tab-content">
			<div id="panel1" class="tab-pane fade in active">

		<p>Статистика загрузки материалов журнала Перископ2:</p>
		<table id="statTable" class="table table-striped table-bordered">
		<thead>
		<tr>
		<td>Количество статей</td>
		<td>Дата загрузки</td>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
			</div>
			<div id="panel2" class="tab-pane fade">
		<p>Статистика загрузки материалов журнала РКТ:</p>
		<table id="statTable2" class="table table-striped table-bordered">
		<thead>
		<tr>
		<td>Количество статей</td>
		<td>Дата загрузки</td>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
			</div>
			<div id="panel3" class="tab-pane fade">
		<p>Статистика загрузки материалов, загруженных вручную:</p>
		<table id="statTable3" class="table table-striped table-bordered">
		<thead>
		<tr>
		<td>Количество статей</td>
		<td>Дата загрузки</td>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	   </div>
		</div>
		<script src="/bootstrap/js/jquery.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script src="/bootstrap/js/jquery.dataTables.min.js"></script>
	<script src="/bootstrap/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/bootstrap/js/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap-select.min.js"></script>
	<script>
	$('#statTable').DataTable( {
		searching: false,
		ordering: false,
		"bLengthChange": false,
		processing: false,
		"bAutoWidth": false,
		pageLength: 50,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/scripts/stat_query.php",
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
	<script>
	$('#statTable3').DataTable( {
		searching: false,
		ordering: false,
		"bLengthChange": false,
		processing: false,
		"bAutoWidth": false,
		pageLength: 50,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/scripts/stat_query_ikot.php",
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
	<script>
	$('#statTable2').DataTable( {
		searching: false,
		ordering: false,
		"bLengthChange": false,
		processing: false,
		"bAutoWidth": false,
		pageLength: 50,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "/scripts/stat_query_rkt.php",
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
		    $page = 'page3';
			include '../components/menu.php';
		?>
		</div>
	</div>
</body>
</html>
