<!-- Forgot Password View -->
<?php
    if (!isset($_SESSION['id'])) {
?>
<form class="form-horizontal">
    <div class="form-group">
        <label for="enter-email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="enter-email" placeholder="Email" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Send Email</button>
        </div>
    </div>
</form>
<?php
    } else {
?>
    <!-- If user is valid, probably redirect them to the profile page -->
    <p>Hmm, you're logged in. You shouldn't be able to see this</p>
<?php
    }
?>
