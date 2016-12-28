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
		<link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
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
		<div style="padding-top : 25px;">
			<label>Расширенные настройки поиска</label>
		</div>
		<div>
			<label class="switch">
				<input type="checkbox" onchange="sel_change()" <?php echo $_COOKIE["add_sett"] ?> > 
				<div class="slider round"></div>
			</label>
		</div>
		</div>
		<div class="col-sm-8">
		<div style="padding-top : 25px;">
		</div>
		<form action="index.php" method="GET" id="searchForm" />
			<input type="text" name="q" id="searchBar" placeholder="" value="<?php echo $_GET['q'] ?>" maxlength="50" autocomplete="off" />
			<input type="submit" id="searchBtn" value="Найти" />
		</form>
		<div style="text-align: center; padding-top : 10px; visibility: hidden;" id="sett_box">
			<div class="settings_block">
				<div class="container-fluid">
				<div class='row'>
					<div class='col-sm-6'>
						<label style="text-align: left; float: left;">Временной интервал:</label>
					</div>
					<div class='col-sm-3'>
						<label style="text-align: left; float: left;">Сортировать по:</label>
					</div>
					<div class='col-sm-3'>	
						    <div class="button-group">
								<button type="button" class="btn btn-block btn-default btn-sm dropdown-toggle btn-primary" data-toggle="dropdown">
									<span>Источники</span>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox" checked/>&nbsp;РКТ</a></li>
									<li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox" checked/>&nbsp;Перископ</a></li>
								</ul>
							</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-3'>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control" value="01.01.1970" />
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
						</div>
					</div>
					<div class='col-sm-3'>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker2'>
						<input type='text' class="form-control" value="<?php echo date('d.m.Y'); ?>" />
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
						</div>
					</div>
					<div class='col-sm-3'>
						<select class="selectpicker" data-width="100%">
							<option>Дате</option>
							<option>Релевантности</option>
						</select>
					</div>
					<div class='col-sm-3'>	
					</div>
				</div>
				</div>
			</div>
		</div>
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
    <script type="text/javascript" src="bootstrap/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap-combobox.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap-select.min.js"></script>
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
	<script type="text/javascript">
	$(function () {
		$('.selectpicker').selectpicker({
		style: 'btn-primary',
		size: 4
		});
	});	
	</script>
	<script type="text/javascript">
		function setCookie(cname,cvalue,exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			var expires = "expires=" + d.toGMTString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
	
		function sel_change() {
			if (document.getElementById('sett_box').style.visibility=='visible') {
				document.getElementById('sett_box').style.visibility='hidden';
				setCookie("add_sett", "checked", 30);
			} else { 
				document.getElementById('sett_box').style.visibility='visible';
				setCookie("add_sett", "", 30);
			}	
		}
	</script>
	<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker(
					{
						pickTime: false,
						language: 'ru'
					}
				);
				$('#datetimepicker2').datetimepicker(
					{
						pickTime: false,
						language: 'ru'
					}
				);
				$("#datetimepicker1").on("dp.change",function (e) {
					$("#datetimepicker2").data("DateTimePicker").setMinDate(e.date);
				});
				$("#datetimepicker2").on("dp.change",function (e) {
					$("#datetimepicker1").data("DateTimePicker").setMaxDate(e.date);
				});
            });
    </script>
	<script type="text/javascript">
		var options = [];
		$( '.dropdown-menu a' ).on( 'click', function( event ) {
			var $target = $( event.currentTarget ),
			val = $target.attr( 'data-value' ),
			$inp = $target.find( 'input' ),
			idx;
		if ( ( idx = options.indexOf( val ) ) > -1 ) {
			options.splice( idx, 1 );
			setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
		} else {
			options.push( val );
			setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
		}
		$( event.target ).blur();
		console.log( options );
		return false;
		});
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