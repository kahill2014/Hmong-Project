<!-- Registration View -->
<?php
    if (!isset($_SESSION['id'])) {
?>
<div class="container">
    <form class="form-horizontal" action='../index.php?mode=register' method='post'>
        <div class="form-group">
            <label for="RegisterFirstName">First Name</label>
            <input type="text" class="form-control" id="RegisterFirstName" placeholder="First Name" name='firstName' required>
        </div>
        <div class="form-group">
            <label for="RegisterLastName">Last Name</label>
            <input type="text" class="form-control" id="RegisterLastName" placeholder="Last Name" name='lastName' required>
        </div>
        <div class="form-group">
            <label for="RegisterUsername">Username</label>
            <input type="text" class="form-control" id="RegisterUsername" placeholder="Username" name='username' required>
        </div>
        <div class="form-group">
            <label for="RegisterEmail">Email address</label>
            <input type="email" class="form-control" id="RegisterEmail" aria-describedby="emailHelp" placeholder="Enter email" name='email' required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="RegisterPassword">Password</label>
            <input type="password" class="form-control" id="RegisterPassword" placeholder="Password" name='password' required>
        </div>
        <div class="form-group">
            <label for="RegisterPassword2">Re-enter Password</label>
            <input type="password" class="form-control" id="RegisterPassword2" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
</div>
<?php
    } else {
?>
    <!-- If user is valid display dashboard -->
    <p>Valid User after registration, should display dashboard</p>
<?php
    }
?>
