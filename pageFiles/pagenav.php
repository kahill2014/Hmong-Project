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
            <a class="navbar-brand" href="index.php">LOGO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbspDashboard </a></li>
                    <li><a href="index.php?mode=profile"><span class="glyphicon glyphicon-user"></span>&nbspProfile </a></li>
                    <li><a href="index.php?mode=gallery"><span class="glyphicon glyphicon-picture"></span>&nbspGallery </a></li>
					<li><a href="index.php?mode=inbox"><span class="glyphicon glyphicon-inbox"></span>&nbspMessages </a></li>
					<li><a href="index.php?mode=viewUploadPhoto"><span class="fas fa-camera-retro"></span>&nbspUpload Photo</a></li>
					<li><a href="index.php?mode=logout"><span class="glyphicon glyphicon-log-out"></span>&nbspLogout </a></li>
                </ul>
                <form class="nav navbar-form navbar-right" action="index.php?mode=searchResults" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-group">
                            <select class="form-control" name="searchFilter">
                                <option value="country" selected>Country</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="searchString" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
