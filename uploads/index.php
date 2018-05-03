<?php
include ('../login/pageFiles/pageheader.php');
include ('../login/pageFiles/pagenav.php');
//include ('../cssOverride/pageheader.css');
?>    
<form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="uploadlocation">Location:</label>
        <?php
        // reads each line of text file that has list of countries
        $filename = 'countries.txt';
        $eachlines = file($filename, FILE_IGNORE_NEW_LINES);
	echo '<select class="form-control" name="country" id="uploadlocation">';
        // makes the first choice empty incase user does not want to select country for image
        echo '<option></option>';
        foreach($eachlines as $lines){
		echo "<option>{$lines}</option>";
        }
        echo '</select>';
        ?>
        </div>
        <div class="form-group">
        <label for="year">Year:</label>
         <!-- Javascript is used here between <select> tags and adds options for year. Automatically updates years with the script -->
         <select class="form-control"id = "year" name = "year"></select>
         </div>
	<div class="form-group">
         <label for="fileinput">Select Image</label>
        <input type="file" name="image" id="fileinput"/>
	</div>
        <input class="btn btn-primary" type="submit" name="submit" value="UPLOAD"/>
    </form>

<script>
    //starting year because anything before this date just would not make sense
    var start = 1900;
    // makes end the current year. updates as years progress
    var end = new Date().getFullYear();
    var options = "";
    for (var year = start; year <=end; year++){
        //adds years from 1900 to now in option tag
	options+= "<option>" + year + "</option>";
 
    }
    //writes the years in the Id "year" in the proper html element
    document.getElementById("year").innerHTML = options;

</script>
