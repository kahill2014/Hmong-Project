<!-- Login View -->
<div class="container">
    <!-- REQUIRES ACTION -->
    <form class="form-horizontal" action='index.php?mode=checkLogin' method='post'>
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name='email' required>
            </div>
        </div>
        <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name='password' required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
                <div>
                    </br><a class="btn btn-primary" href="index.php?mode=viewRegistration" role="button">Sign up</a>
                </div>
                </br><a href="forgotpassword.html" id="forgot-password">Forgot Password?<a>
            </div>
        </div>
    </form>
</div>
