</div>
            </div>
        </div>
        </div>
        <div class="tab-pane fade in" id="tab3">
          <div class="user-info">
            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>  User Location
          </div>
          <div class="user-info">
            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>  User Profession
          </div>
          <div class="user-info">
              <span class="glyphicon glyphicon-education" aria-hidden="true"></span>  Goals with Site:
          </div>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean at facilisis lorem, in dignissim mauris. Nulla consequat enim eu rhoncus porttitor. Sed eget nunc arcu. Ut pharetra interdum congue. Donec cursus lectus ipsum, id volutpat mi vehicula vitae. In hac habitasse platea dictumst. Praesent eget sem eros. Cras suscipit libero eu aliquam imperdiet. Nullam felis lectus, mollis in lorem a, euismod aliquet ante. Fusce ultrices, mauris euismod facilisis aliquam, ante metus interdum lacus, sed mollis dolor velit sagittis leo. Praesent quis sagittis sem. Nulla efficitur id massa a luctus. Mauris justo est, tincidunt eget condimentum eget, dapibus sed dui. Duis justo leo, pulvinar vitae lectus in, rutrum ullamcorper odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          </p>
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
