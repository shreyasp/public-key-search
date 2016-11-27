<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.1.0/octicons.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="login-page">
    <div class="container-fluid">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a role="tab" data-toggle="tab" href="#login">Login</a>
        </li>
        <li role="presentation">
          <a role="tab" data-toggle="tab" href="#signup">Register</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="login">
          <form class="login-form" method="post" action="/login">
            <div class="form-group">
              <label for="userid" class="control-label">Username or Email address</label>
              <input class="form-control text-box" type="email" name="userid" id="userid">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input class="form-control text-box" type="password" name="password" id="password">
            </div>
            <div class="form-group">
              <button class="login-button btn btn-default" type="submit">Login</button>
            </div>
          </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="signup">
          <form class="signup-form" method="post" action="/register" >
            <div class="form-group">
              <label for="userid" class="control-label">Full Name</label>
              <input class="form-control text-box" type="text" id="fullname" name="fullname">
            </div>
            <div class="form-group">
              <label for="userid" class="control-label">Username or Email address</label>
              <input class="form-control text-box" type="email" id="userid" name="userid">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input class="form-control text-box" type="password" id="password" name="password">
            </div>
            <div class="form-group">
              <label for="confirm_password" class="control-label">Confirm Password</label>
              <input class="form-control text-box" type="password" id="confirm_password" name="confirm_password">
            </div>
            <div class="form-group">
              <button class="signup-button btn btn-default" type="submit">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
