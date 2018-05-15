<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   
      <div class="modal-body" style="margin-left: -14em; margin-top: -1em;">
        <img src="" id="imagepreview" style="width: 980px; height: 660px;" >
      </div>
    
  </div>
</div>

<script>
$("img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>
<!-- Page Footer -->
        <footer class="footer navbar-fixed-bottom text-center">
            <div class="container"
                <p>© 2018 Hmong Project</p>
            </div>
        </footer>
    </body>
</html>
