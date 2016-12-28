<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X_UA-Compatible' content="IE=edge">
		<title>Материал</title>
		<link rel="stylesheet" href="../css/style.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript">
		</script>
</head>

<body>
	<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
		<div style="padding-top : 25px;">
		</div>
			<?php
				$dbcon = pg_connect("host=127.0.0.1 port=5432 dbname=npo_inner_texts user=postgres") or die ("Couldn't connect to PgSQL Database.");
				$id = $_GET['id'];
				$result = pg_query($dbcon, "SELECT art_body FROM articles_html WHERE art_id=$id");
				while ($fixrow = pg_fetch_row($result)) {
					$cl = new SphinxClient ();
					$cl->setServer("localhost",9312);
					
					$docs = array
				(
					$fixrow[0]
				);
				$words = $_GET['pattern'];
				$index = "test1";
				$opts = array
				(
					"before_match"		=> "",
					"after_match"		=> "",
					"chunk_separator"	=> "#",
					"limit"				=> 80,
					"around"			=> 0,
					"query_mode"		=>1
				);
				$page_text=$fixrow[0];
				$res = $cl->BuildExcerpts ( $docs, $index, $words, $opts );
				if ( !$res ) {
					die ( "ERROR: " . $cl->GetLastError() . ".\n" );
				} else {
					foreach ( explode("#",$res[0]) as $entry ) {
						if (strlen($entry)) {
							$page_text=str_replace($entry, "<mark>".$entry."</mark>", $page_text);
						}
					}
				}
				echo $page_text;
				}
			?>
		</div>
		<div class="col-sm-3">
			<div style="padding-top : 25px;">
			</div>
			<form id="form-pattern" method="GET" action="article.php">
				<div class="form-group">
					<label for="inputPattern">Паттерн</label>
					<input type="text" class="form-control" id="inputPattern" value="<?php echo $_GET['pattern']?>" name="pattern">
					<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
				</div>
				<div style="text-align: right;">
					<button class="btn btn-default" type="submit" >Выбрать</button>
				</div>
			</form>
			<div style="padding-top : 15px;">
			</div>
			<div class="down-arrow" onclick="location.href='../index.php';"><b>К Индексу</b></div>
		</div>
	</div>
	</div>
</body>
</html>