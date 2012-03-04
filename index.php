<?php 
?>
<?php include('header.php'); ?>
<!------------------------------------------------->
<div data-role="page" >
	<div data-role="header" data-position="" data-theme="">
		<!--clear/back button()-->
		<a href="#" id="clear" class="ui-btn-left" data-icon="<?= $clearIcon ?>" data-iconpos="left" style=""><?= $clearText ?></a>
		<!--TIME-->
		<h1><?= date('H:i D'); ?></h1>
		<!--check button or refresh button(with same function)-->
		<a href="#" id="check" data-icon="<?= $rightIcon ?>" data-transition="fade" data-theme="a" data-iconpos="right" class="ui-btn-right"><?= $rightBtn ?></a>
		<!------------------------------------------------->
		<!-- navbar -->
		<div data-role="navbar" style="">
			<ul id="navbar">
			<li style="<?= $navWidth ?>"><a href="#" station="<?= $fromStation ?>" <?= $navbar ?>data-icon="<?= $iconFrom ?>" id="fromStation"> <?= $from ?> </a></li>
			<!--reverse button(reverseNav)-->
			<?= $reverseNav ?>
			<li style="<?= $navWidth ?>"><a href="#" station="<?= $toStation ?>" data-icon="<?= $iconTo ?>"  id="toStation"><?= $to ?></a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!--/header-->
	<!------------------------------------------------->
	<!------------------------------------------------->
	<!--content-->
	<div data-role="content" id="content">	
		<!--schedule result-->
		<?php
			if($_GET['from']&&$_GET['to']){
				fetch($_GET['from'],$_GET['to']);
				fetchRev($_GET['from'],$_GET['to']);
			}
		?>
		<!------------------------------------------------->
		<!--Station List-->
		<fieldset id="stationFieldset" style="<?= $styleStation ?>">
			<ul style="border-top:0px solid black" data-role="listview" id="stationList" data-inset="false" data-dividertheme="d"  data-filter-placeholder="SEARCH STATIONS!!!" data-filter="true"data-split-icon='plus' >
			<?php
				station();
			?>
			<ul>
		</fieldset>

	</div><!-- /content -->
</div><!-- /page -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22701998-4']);
  _gaq.push(['_trackPageview']);

    (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                      })();

  </script>

</body>
</html>
