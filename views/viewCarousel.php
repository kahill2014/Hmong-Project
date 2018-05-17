<!--Carousel-->
<?php
$dataCaro = getAllPhotos();
$caroSize = 10; //set carousel length
?>
<div id="banner">
    <div id="carousel-example-generic" class="carousel slide col-sm-12 col-lg-6 col-lg-offset-3" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
	<!-- Always have one dot in carousel, use php for loop below to set n dots -->
        <li data-target="#carousel-example-generic" data-slide-to="0"   class="active"></li>
	<?php
	for ($i=1; $i<$caroSize; $i++) {
		echo '<li data-target="#carousel-example-generic" data-slide-to="$i"></li>';
	}
	?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
	<?php
	$row = $dataCaro[0];
	echo '<div class="item active">';
	echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
		'" style="height: 100%;width: 100%;"/>';
	echo '</div>';
	for ($i=1; $i<$caroSize; $i++) {
		$row = $dataCaro[$i];
		echo '<div class="item">';
		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
			'" style="height: 100%;width: 100%;"/>';
		echo '</div>';
	}
	?>
      </div>

      <!-- Controls -->
      <a class="carousel-control left" href="#carousel-example-generic" data-slide="prev">
       <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
     </a>

     <a class="carousel-control right" href="#carousel-example-generic" data-slide="next">
       <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
     </a>
    </div>
</div>

<script>
$('.carousel').carousel({
    interval: 9000 //changes the speed
    pause: "hover" //pauses when mouse hovers on pic
})
</script>
