<!--Profile Photo Area-->
            <div class="col-lg-12 col-sm-12">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="views/profile-photo.jpg">
            <!-- http://lorempixel.com/850/280/people/9/ -->
            </div>
            <div class="useravatar">
                <img alt="" src="views/profile-pic.svg">
            </div>
            <div class="card-info"> <span class="card-title"><?php echo $user_name; ?></span>

            </div>
        </div>
            <!--Tab Buttons-->
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                    <div class="hidden-xs">My Photos</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <div class="hidden-xs">Favorites</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="about" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">About</div>
                </button>
            </div>
     	    <div class="btn-group" role="group">
                <button type="button" id="follow" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                    <div class="hidden-xs">Following/Followers</div>
                </button>
            </div>
	</div>
      <!--Tab Content Cycle-->
        <div class="well">
      <div class="tab-content">
<div class="tab-pane fade in active" id="tab1">
