<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.1.0/octicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="main-page">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Public Key Search</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>
              <form class="navbar-form">
                <div class="btn-group" role="group">
                  <button type="button" data-toggle="modal" data-target="#getUsername" class="btn btn-default">
                    <!-- need to define the login modal -->
                    <span class="fa fa-github-alt"></span> Connect to GitHub
                  </button>
                </div>
              </form>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <!-- render the name of user -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, {{ $name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!-- change the password for the user -->
                <li><a href="#">Settings</a></li>
                <li role="separator" class="divider"></li>
                <!-- Clear the session object and log-out user -->
                <li><a href="/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section>
      <div class="modal fade" id="getUsername">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-body">
              <form class="form-group" method="get" action="/connect_to_github">
                <div class="row col-md-offset-1">
                  <label for="username_input" class="label label-default">GitHub Username</label>
                </div>
                <div class="row col-md-offset-1">
                  <div class="col-md-10 input-group">
                    <input type="text" class="form-control" name="username" id="username">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-warning">Submit</button>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="row search-form">
        <div class="col-lg-8 col-md-offset-3">
          <form action="/get_keys" method="get">
            <div class="input-group">
              <input type="text" class="form-control" name="github_username">
              <span class="input-group-btn" >
                <!-- search github users public key -->
                <button type="submit" class="btn btn-default">Search</button>
              </span>
            </div>
          </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row public-key-display">
      <div class="col-md-offset-3 col-lg-8">
        <label for="key_text_area" class="label label-default">User Public Key</label>
        <!-- render key in the text area -->
        <textarea id="key_text_area" rows="8" cols="90" readonly="true">{{ $sshKey or 'Please enter GitHub User name to retrieve SSH Public Key'}}</textarea>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
