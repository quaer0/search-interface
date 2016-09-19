<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<title>Поиск материалов</title>
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript">
		</script>
	</head>
	<body>
	 <script type="text/javascript">
    function indexing() {
        var ta = document.getElementById('output');
        var source = new EventSource('../scripts/indexer_query.php');
        source.addEventListener('message', function(e) {
            if (e.data !== '') {
               ta.value += e.data + '\n';
            }
        }, false);
        source.addEventListener('error', function(e) {
            source.close();
        }, false);
    }
    </script>

<div class="container-fluid">
	
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
		<div style="padding-top : 25px;">
		</div>
		<div class="form-group">
			<label for="idxBtn">Во время индексации вкладка должна быть открыта. Процесс отображается в окне вывода внизу.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<button type="button" class="btn btn-default" id="idxBtn" onclick="indexing();" >Начать индексацию</button>
		</div>
		<textarea class="form-control" id="output" style="min-width: 100%; min-height: 500px; resize: vertical;"></textarea>
		</div>
	<div class="col-sm-2">
		<?php 
		    $page = 'page2'; 
			include '../components/menu.php'; 
		?>	
	</div>
	</div>
	</div>
	</body>
</html>



