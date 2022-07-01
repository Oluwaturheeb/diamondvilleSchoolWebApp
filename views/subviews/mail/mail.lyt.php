<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Hello world</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

  </head>
  <body>
    <div class="container">
      <img src="http://<* echo config('project/host') *>/assets/img/diamondville.png" alt="Diamondville" />
      <div class="content">
        <h5><* echo $body->subject *></h5>
        <p>
          <* echo nl2br($body->notty) *>
        </p>
      </div>
    </div>
    <footer>
      <strong>DiamondVille Comprehensive School</strong>
      <p>
        <address>No 1, Off Ifedayo Str., Igbobi Estate, Mowe, Ogun State.</address>
        <address>No 9 - 11, God's Grace Avenue Off Ogunrun Road, Mowe, Ogun State.</address>
        <strong>Phone:</strong> <a href="tel:+2348138367199">+234 813 8367 199</a>, <a href="tel:+2348036861177">+234 803 6861 177</a> <br>
        <strong>Email:</strong> <a href="mailto:support@diamondville.com.ng">support@diamondville.com.ng</a><br/>
      </p>
      <div class="copyright">
          &copy; Copyright <strong><span>DiamondVille Comprehensive School</span></strong>. <br>All Rights Reserved 2009 - <* echo date('Y') *>
      </div>
    </footer>
    <style>
      body {
        margin: 0;
        font-family: Serif;
        background: #eee;
      }

      img {
        width: 100%;
        height: 10rem;
      }

      .container {
        margin: 1rem;
        background: #fff;
        border-radius: 5px;
      }

      .content {
        padding: 0 1rem 1rem 1rem;
      }

      footer {
        font-size: 12px;
        text-align: center;
      }

      footer a {
        color: #555;
      }
    </style>
  </body>
</html>
