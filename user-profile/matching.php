<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Matching</title>
    <!-- BOOTSTRAP STYLE SHEET -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONT AWESOME ICONS STYLE SHEET -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- CUSTOM STYLES -->
     <link href="assets/css/matchingstyles.css" rel="stylesheet" />
</head>
<body >
    <nav id="navvv" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="https://users.cs.duke.edu/~dwy3/studymatch/">Duke Study Match</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="https://users.cs.duke.edu/~dwy3/studymatch/#services">Options</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="https://users.cs.duke.edu/~dwy3/studymatch/#portfolio">Groups</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="https://users.cs.duke.edu/~dwy3/studymatch/#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="https://users.cs.duke.edu/~dwy3/studymatch/#contact">Contact</a>
                    </li>
                    <li>
                        <a href="https://users.cs.duke.edu/~dwy3/studymatch/user-profile/index.php">Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- NAVBAR CODE END -->
    <div class="container">
        <div class="row">
                <div class="col-md-12 text-center">
                    <h2></h2>



                    <br />
                    <br />

                </div>
            </div>
         <!-- USER PROFILE ROW STARTS-->
            <div class="row">
                <div class="col-md-3 col-sm-3">

                    <div class="user-wrapper">
                        <img  src=""class="img-responsive" id="head"/>
                    <div class="description">
                       <h4 id="pName"><span id="tester"></span></h4>
                        <h5> <strong><span id="year"></span>, Duke University </strong></h5>
                        <h5> <strong>About: <span id="biography"></span> </strong></h5>
                        <p>
                          <?php //echo $_SESSION["major"] ?>
                        </p>
                        <hr />
                    	<a class="yesnobutton" id="no" href="#" style="float: left; color: red;"> <i class="fa fa-user-times fa-lg"></i></a>
                        <a class="yesnobutton" id="yes" href="#" style="float: right;"> <i class="fa fa-check-circle-o fa-lg"></i></a>

                    </div>
                     </div>
                </div>

            </div>
           <!-- USER PROFILE ROW END-->
           <br>
           <br>
           <br>
           <a href="matches.php"> Matches</a>
    </div>
    <!-- CONATINER END -->
    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="match.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
