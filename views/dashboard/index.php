<div class="container-fluid">
    <script src="<?php echo BASEURL ?>public/js/home/home.js"></script>
    <input type="hidden" id='baseurl' value="<?php echo BASEURL ?>">
    <input type="hidden" id='avatar' value="<?php echo $this->profile['avatar'] ?>">
    <div class="row content">
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm-2 hidden-xs black-borded white-col scrollable2">
            <h2 class="text-center">Top users</h2>
            <ul class="list-unstyled smallmargin">
                <?php foreach ($this->top_users as $usr) {
                    echo '<li class="smallmargin"> ' . $usr['score'] . ' - ' . $usr['firstname'] . ' ' . $usr['lastname'] . '</li>';
                } ?>
            </ul>
        </div>
        <br>
        <div class="col-sm"></div>

        <div class="col-sm-8">
            <form class="form" method="post" action="#">

                <div class="row black-borded white-col" style="">
                    <input type="hidden" name="userid" id="userid" value="<?php echo $this->profile['id'] ?>">
                    <input type="hidden" name="groupid" id="groupid" value="<?php echo $this->profile['groupid'] ?>">
                    <input type="hidden" name="firstname" id="firstname" value="<?php echo $this->profile['firstname'] ?>">
                    <input type="hidden" name="lastname" id="lastname" value="<?php echo $this->profile['lastname'] ?>">
                    <div class="col-sm-11 nopadding">

                    <textarea class="form-control" placeholder="Make a post...." name="text" rows="8"
                              id="text" style="border: none"></textarea>
                    </div>
                    <div class="col-sm-1 nopadding">
                        <div class="row content"></div>
                        <div class="row content" ></div>
                        <div class="row content" ></div>

                        <button type="submit" class="btn btn-block badge-dark btn-default">Post</button>
                    </div>

                </div>

            </form>
            <div id="post_list" class="row black-borded scrollable white-col" style="margin-top: 10px;height: 55%;border-top:none;border-right: none;border-left:none">
                <?php echo $this->posts ?>
            </div>



        </div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>

    </div>
     <div class="row content"></div>



