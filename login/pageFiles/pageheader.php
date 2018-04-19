<html>
<head>
	<title>Hmong Project</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../login/pageFiles/pageheader.css">
	<!-- jQuery CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- jQuery local fallback -->
	<script>window.jQuery || document.write('<script src="/bootstrap/js/jquery.js"><\/script>')</script>
	<!-- Bootstrap JS CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Bootstrap JS local fallback -->
	<script>if(typeof($.fn.modal) === 'undefined') {document.write('<script src="/bootstrap/js/bootstrap.min.js"><\/script>')}</script>
	<!-- Bootstrap CSS local fallback -->
	<div id="bootstrapCssTest" class="hidden"></div>
	<script>
	$(function() {
	  if ($('#bootstrapCssTest').is(':visible')) {
		$("head").prepend('<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">');
	  }
	});
	</script>
</head>
<body>
    <!-- Page Header -->
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
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Gallery</a></li>	
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
