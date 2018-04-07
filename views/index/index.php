<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5"> Please login or register</h1>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col">
        <form class="form-horizontal" method="post" action="<?php echo BASEURL ?>index/register">
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstname">FirstName:</label>
                <div class="col-sm-10">
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter First name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">LastName:</label>
                <div class="col-sm-10">
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter Last name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="usr" placeholder="Enter username">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-10"> 
                    <input type="password" name="password" class="form-control" id="pass" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Register</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col">

        <form class="form-horizontal" method="post" action="<?php echo BASEURL ?>index/login">
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-10"> 
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Log in</button>
                </div>
            </div>
        </form>
    </div>

</div>
