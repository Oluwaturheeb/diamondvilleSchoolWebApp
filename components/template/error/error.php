<?php
$t = (object) $title;
if (!config('state/development')) {
	if ($t->code == 500) $t->msg = 'We are definitely doing something to fix this, bear with us for a while';
}
?>
<html>

<head>
</head>

<body>
    <div class="container" style="text-align: center;">
		<?php if ($t->code == 500): ?>
			<img src="inc/error/500.svg" width="600px">
		<?php elseif ($t->code == 404): ?>
			<img src="inc/error/404.svg" width="600px">
		<?php else: ?>
			<h3><?php echo $t->info ?></h3>
			<h1><?php echo $t->code ?>&nbsp;</h1>
		<?php endif; ?>
		<p><?php echo $t->msg ?></p>
    </div>
    <style>
    body {
        margin: 0;
    }

    h1 {
        font-size: 6rem;
    }
    </style>
</body>

</html>