<div style="padding-top : 0px;">
	<ul class="nav nav-pills nav-stacked">
		<li <?php echo ($page == 'page1') ? 'class="active"' : '';?>><a href="/index.php"><i class="fa fa-search fa-fw"></i>Поиск</a></li>
		<li <?php echo ($page == 'page2') ? 'class="active"' : '';?>><a href="/pages/indexing.php"><i class="fa fa-index fa-fw"></i>Индексация</a></li>
		<li <?php echo ($page == 'page3') ? 'class="active"' : '';?>><a href="/pages/statistic.php"><i class="fa fa-stat fa-fw"></i>Статистика</a></li>
		<li <?php echo ($page == 'page4') ? 'class="active"' : '';?>><a href="/pages/refill.php"><i class="fa fa-upload fa-fw"></i>Пополнение</a></li>
		<li <?php echo ($page == 'page5') ? 'class="active"' : '';?>><a href="/pages/about.php"><i class="fa fa-project fa-fw"></i>О Проекте</a></li>
	</ul>
</div>