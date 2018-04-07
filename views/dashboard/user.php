<div class="container-fluid content">
    <div class="row content">
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>

        <div class="col-sm-2 smallmargin text-center">
            <img src="<?php echo BASEURL.$this->profile['avatar'] ?>" class="img-responsive avatar" alt="Cinque Terre">
            <h3><?php echo $this->profile['firstname'].' '.$this->profile['lastname']  ?></h3>
            <h4>Score: <b> <?php echo $this->profile['score'] ?> </b></h4>
        </div>
        <div class="col-sm"></div>

        <div class="col-sm-5 text-left">
            <h3>Description</h3>
            <textarea class="form-control black-borded" name="description" rows="10" id="description" disabled><?php echo  $this->profile['description']; ?></textarea>

        </div>
        <div class="col-sm"></div>

        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label col-sm-3" for="group">Group:</label>
                <div class="col-sm-8">
                    <select class="form-control" disabled id="group" name="group">
                        <option value="0">-----------------------</option>
                        <?php
                        foreach ($this->groups as $group){
                            if($group['id']  == $this->profile['groupid']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            echo '<option value="'.$group['id'].'" '.$selected.'>'.$group['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="campus">Campus:</label>
                <div class="col-sm-8">
                    <select class="form-control" disabled id="campus" name="campus">
                        <option value="0">-----------------------</option>
                        <?php
                        foreach ($this->campus as $campus){
                            if($campus['id']  == $this->profile['campusid']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            echo '<option value="'.$campus['id'].'" '.$selected.'>'.$campus['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="year">Year:</label>
                <div class="col-sm-8">
                    <select class="form-control" disabled id="year" name="year">
                        <option value="0">-----------------------</option>
                        <?php
                        for($i = 1;$i<7;$i++){
                            if($i == $this->profile['year']){
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }
                            else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                          }

                        }

                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm"></div>

    </div>


