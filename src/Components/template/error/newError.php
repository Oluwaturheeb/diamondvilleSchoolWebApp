<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $errstr ?></title>
</head>

<body>
  <div class="container">
    <div class="main">
      <?php if (config('state/development')): ?>
      <div class="ans">
        <img src="assets/error/bug.jpg">
        <b>It's a bug!</b>
      </div>
      <div class="main-error">
        <p><?php echo $errfile . ' on line '. $errline ?></p>
        <h2><?php echo $errstr ?></h2>
        <p><small>Let's go for a bounty!</small></p>
      </div>
      <?php else:
        if (config('error/page') === 'default'):?>
        <div class="ans">
          <img src="assets/img/error/bug.jpg">
          <b>Something broke!</b>
        </div>
        <div class="main-error">
          <h1>500</h1>
          <h2>This is coming from us, not <b>you</b>.</h2>
          <p>We'll fix this in no time!</p>
        </div>
        <?php else: includeView(config('error/page')); ?>
      
      <?php endif;endif ?>
    </div>
  </div>
  <style>
    body {
      padding: 1rem;
      background: #eee;
      color: #1c1c1a;
    }

    .container {
      padding: 1rem;
    }

    .main {
      background: #fff;
      padding: 2rem;
    }

    .ans {
      display: flex;
      justify-content: flex-start;
      flex-wrap: wrap;
      grid-gap: 1rem;
      align-items: center;
    }

    .ans img {
      width: 30px;
    }

    .ans b {
      font-size: 1.2rem;
      margin: 0;
    }

    .main-error {
      margin-left: 2.5rem;
    }

  </style>
</body>

</html>