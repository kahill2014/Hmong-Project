    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="uploadlocation">Location:</label>
        <?php
        $filename = 'countries.txt';
        $eachlines = file($filename, FILE_IGNORE_NEW_LINES);
	echo '<select name="country" id="uploadlocation">';
        echo '<option></option>';
        foreach($eachlines as $lines){
		echo "<option>{$lines}</option>";
        }
        echo '</select>';
        ?>
        <label for="year">Year:</label>
         <select id = "year" name = "year"></select>
         Select image to upload:
        <input type="file" name="image"/>
        <input type="submit" name="submit" value="UPLOAD"/>
    </form>

<script>
    var start = 1900;
    var end = new Date().getFullYear();
    var options = "";
    for (var year = start; year <=end; year++){
	options+= "<option>" + year + "</option>";
 
    }
    document.getElementById("year").innerHTML = options;

</script>
