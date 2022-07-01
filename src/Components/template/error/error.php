<?php namespace Devtee\Tlyt\Components; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $e->msg ?></title>
</head>
<body>
    <div class="container" style="text-align: center;">
    <?php if ($e->code == 500): ?>
        <img src="/assets/error/500.jpg" width="440px">
    <?php elseif ($e->code == 404): ?>
        <img src="/assets/error/404.jpg" width="100%" style="height: 30vh">
    <?php else: ?>
        <h3><?php echo $e->info ?></h3>
        <h1><?php echo $e->code ?>&nbsp;</h1>
    <?php endif; ?>
    <h3><?php echo $e->msg ?></h3>
    </div>
    <style>
    body {
      padding: 1rem;
      color: #1c1c1a;
    }

    h1 {
        font-size: 6rem;
    }
    </style>
</body>
</html>