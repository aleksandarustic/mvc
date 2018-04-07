<div class="container content">

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-3"> Log in </h1>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col"></div>
    <div class=" col-sm-8 white-col black-borded">

        <form class="form-horizontal" method="post" action="<?php echo BASEURL ?>auth/authLogin">
            <div class="form-group mt-4">
                <label class="control-label col-sm-3" for="email">Email address:</label>
                <div class="col-sm">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a  class="btn btn-default" type="button" href="<?php echo BASEURL ?>auth/register">Don't have account. Sign up</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Log in</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col"></div>


</div>
