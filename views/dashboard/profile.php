<div class="container-fluid content">
    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo BASEURL ?>dashboard/updateProfile">
        <input type="hidden" name="id" id="id" value="<?php echo Session::get('id') ?>">
        <input type="hidden" name="oldavatar" id="oldavatar" value="<?php echo $this->profile['avatar'] ?>">
        <div class="row content">


            <div class="col-lg-2 col-md-3 offset-1 smallmargin text-center">
                <div class="row">
                    <div class="col-sm-10 offset-1">
                        <img src="<?php echo BASEURL . $this->profile['avatar'] ?>" class="img-fluid" alt="Cinque Terre">
                    </div>
                </div>
               <div class="row smallmargin">
                <div class="col-sm-10 offset-sm-1">
                    <input type="file" class="form-control-file" name="avatar" id="avatar" accept="image/*">
                </div>
              </div>
                <div class="row smallmargin">
                    <div class="col-sm-12">
                        <h3><?php echo Session::get('firstname') . ' ' . Session::get('lastname'); ?></h3>
                        <h4>Score: <b> <?php echo $this->profile['score'] ?> </b></h4>
                    </div>
                </div>


            </div>

            <div class="col-lg-6 col-md-4">
                <h3>Description</h3>
                <textarea class="form-control black-borded" name="description" rows="10" id="description"><?php echo $this->profile['description']; ?></textarea>
            </div>

            <div class="col-lg-2 col-md-3">
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <label class="control-label col-sm-3" for="group">Group:</label>
                        <select class="form-control selectpicker" id="group" name="group">
                            <option value="0">-----------------------</option>
                            <?php
                            foreach ($this->groups as $group) {
                                if ($group['id'] == $this->profile['groupid']) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option value="' . $group['id'] . '" ' . $selected . '>' . $group['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <label class="control-label col-sm-3" for="campus">Campus:</label>

                        <select class="form-control selectpicker" id="campus" name="campus">
                            <option value="0">-----------------------</option>
                            <?php
                            foreach ($this->campus as $campus) {
                                if ($campus['id'] == $this->profile['campusid']) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option value="' . $campus['id'] . '" ' . $selected . '>' . $campus['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <label class="control-label col-sm-3" for="year">Year:</label>

                        <select class="form-control" id="year" name="year">
                            <option value="0">-----------------------</option>
                            <?php
                            for ($i = 1; $i < 7; $i++) {
                                if ($i == $this->profile['year']) {
                                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                } else {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="row content">

            <div class="col-lg-2 offset-md-1 col-md-3 col-sm-6">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">

                        <a href="<?php echo BASEURL ?>dashboard/deleteAccount/<?php echo Session::get('id') ?>" type="submit" class="btn btn-block btn-danger btn-responsive">Delete Account</a>
                        <a href="<?php echo BASEURL ?>dashboard/logout" type="submit" class="btn btn-block btn-danger btn-responsive">Log out</a>
                    </div>
                    <div class="col-sm-1"></div>

                </div>

            </div>


            <div class="col-lg-3  offset-lg-6 col-md-4 offset-md-4 col-sm-6">

                <div class="form-group">
                    <div class="col-md-2 col-sm-1"></div>
                    <div class="col-md-8 col-sm-10">
                        <a href="<?php echo BASEURL ?>dashboard/profile" type="submit" class="btn btn-block btn-danger btn-responsive">Discard</a>

                        <button type="submit" class="btn btn-block btn-lg btn-success btn-responsive"> Save changes</button>

                    </div>
                    <div class="col-md-2 col-sm-1"></div>

                </div>

            </div>


        </div>

    </form>