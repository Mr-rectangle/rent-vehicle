<div id="about<?=$cat['id'] ?>" class="about section-content">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title">
				<h2><?=$cat['name'] ?></h2>
			</div> <!-- /.section-title -->
		</div> <!-- /.col-md-12 -->
	</div> <!-- /.row -->
	
	<?php
	include 'cards.php';
	?>

	
</div> <!-- /#heavy -->

<div class="row">
		<div class="col-5 offset-5">
			<input type="hidden" value="1" id="current-page">
			<button class="btn btn-warning" id="show-more" onclick="getMore(this, <?=$cat['id'] ?>)">Показати більше</button>
		</div>
	</div>

	<br>
	<br>
	<br>
	
	