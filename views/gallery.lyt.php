<!DOCTYPE html>
<html lang="en">
<head>
	<?php includeView('main/header'); ?>
</head>
<body>

	<!-- loader -->
	<!--<div class="load">
		<div class="ring green icofont-spin"></div>
		<div class="ring blue icofont-spin"></div>
	</div>-->


<div class="container-fluid">
	<div class="row">
		<div class="gallery">
			<?php
			$gallery = 'assets/img/gallery';
			$dir = opendir($gallery);
			$i = 0;
			while (false !== $img = readdir($dir)) {
				if ($img != '.' && $img != '..') {
					echo <<<__here
					<div class="img-w">
						<img src="assets/img/gallery/$img" alt="DiamondVille Collections">
					</div>
			__here;
				$i++;
				}
			}
			closedir($dir);

			?>
		</div>

		<div class="gallery-show">
			<div class="gallery-holder">
				<img src="" class="image">
				<caption class="caption">
					<h4 class="text-center">DiamondVille Collections</h4>
				</caption>
			</div>
		</div>
	</div>
</div>
<* includeView('main/footer') *>
</body>
</html>
