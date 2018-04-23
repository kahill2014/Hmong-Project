    <!-- delete navbar-inverse to get rid of black nav color. Use CSS to change color manually -->
    <nav class="navbar">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">LOGO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../login/index.php"><span class="glyphicon glyphicon-home"></span>&nbspDashboard </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbspProfile </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-picture"></span>&nbspGallery </a></li>
					<li><a href="#"><span class="glyphicon glyphicon-inbox"></span>&nbspMessages </a></li>
					<li><a href="../uploads/index.php"><span class="fas fa-camera-retro"></span>&nbspUpload Photo</a></li> <!-- This will change when it gets added as a view -->
					<li><a href="../login/index.php?mode=logout"><span class="glyphicon glyphicon-log-out"></span>&nbspLogout </a></li>
                </ul>
                <form class="nav navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
