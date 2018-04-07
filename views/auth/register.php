<div class="container content">

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-2"> Sign up</h1>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col"></div>
    <div class="col-sm-8 white-col black-borded">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo BASEURL ?>auth/authRegister">
            <div class="form-group mt-5">
                <label class="control-label col-sm-2" for="firstname">First name</label>
                <div class="col-sm">
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter first name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastname">Last name</label>
                <div class="col-sm">
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email</label>
                <div class="col-sm">
                    <input type="text" name="email" class="form-control" id="usr" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="password">Password</label>
                <div class="col-sm">
                    <input type="password" name="password" class="form-control" id="pass" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="password_retype">Retype password</label>
                <div class="col-sm">
                    <input type="password" name="password_retype" class="form-control" id="pass">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="group">Select Group:</label>
                <div class="col-sm-4">
                <select class="form-control" id="group" name="group">
                    <option value="0">-----------------------</option>
                    <?php
                    foreach ($this->groups as $group){
                        echo '<option value="'.$group['id'].'">'.$group['name'].'</option>';
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" type="button" href="<?php echo BASEURL ?>auth/login">Already have account. Log in</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <label>Select your avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Register</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col"></div>

</div>
<div class="row mt-5">
    
</div>
