        <?php //session_start(); include('../models/model.php'); ?>
	<div class="tab-pane fade in" id="tab4">
	<div class="row">
            <div class="user-info col-md-6 text-center">
                <h2>Following</h2>
            </div>
            <div class="user-info col-md-6 text-center">
                <h2>Followers</h2>
            </div>
	</div>
	<div class="row">
	    <div class="user-info col-md-6 text-center">
	        <?php
			foreach($newFollowingData as $following){
				echo "<p>Name: " . $following['username'] . "</p>";
			}
		?>
	    </div>
	    <div class="user-info col-md-6 text-center">
		<?php
                        foreach($newFollowerData as $follower){
                                echo "<p>Name: " . $follower['username'] . "</p>";
                        }
                ?>    
	    </div>
	</div>

<!-- End page div stuff -->
        </div>
        </div>
        </div>

        </div>
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
        </script>
        <script>
            function myFunction(x) {
            x.classList.toggle("change");
            }
        </script>
        <!--Profile JS-->
        <script>
            $(document).ready(function() {
                $(".btn-pref .btn").click(function () {
                    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                    // $(".tab").addClass("active"); // instead of this do the below
                    $(this).removeClass("btn-default").addClass("btn-primary");
		});
	    });
	</script>
