<?php 
$c = new Crud('post');
$p = $c->fetch()->exec(1);
if (!$p || $c->error()) error('Cannot find the resources you are looking for on this server!', 'Not Found!', 404);
callfile('inc/header', ucfirst($p->title));
?>

	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-sm-8 post">
				<header>
					<h1><?= $p->title ?></h1>
					<img src="<?= $p->thumb ?> " class="img-fluid">
					<div class="post-details my-4">
						<i class="icofont-ui-calendar"></i> <?= Utils::date($p->date_added) ?>&nbsp;&nbsp;&nbsp;
						<i class="icofont-eye"></i> <?= $p->views ?>&nbsp;&nbsp;&nbsp;
					</div>
				</header>
				<section class="post-content">
					<?= nl2br($p->content) ?>
				</section>
			</div>
			<div class="col-lg-5 col-sm-4">
				
			</div>
		</div>
	</div>

<?php 
// this include the app js files
require_once "inc/footer.php";