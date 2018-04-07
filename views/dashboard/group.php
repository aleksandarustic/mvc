<div class="container-fluid">
    <div class="row content">
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm-2 hidden-xs black-borded white-col">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center"><?php echo $this->group['name'] ?></h3> 
                </div>
            </div>
            <div class="row smallmargin">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <p class="">UK/EU fee: <?php echo $this->group['uk_fees'] ?></p>
                </div>
                <div class="col-sm-1"></div>

            </div>
            <div class="row">
                <div class="col-sm-1"></div>

                <div class="col-sm-10">
                    <p class="">International fee: <?php echo $this->group['international_fees'] ?></p>
                </div>
                <div class="col-sm-1"></div>

            </div>
            <div class="row">
                <div class="col-sm-1"></div>

                <div class="col-sm-10">
                    <p class="">Duration: <?php echo $this->group['duration'] ?></p>
                </div>
                <div class="col-sm-1"></div>

            </div>





        </div>
        <div class="col-sm"></div>

        <div class="col-sm-2 hidden-xs black-borded white-col scrollable2">
            <h3 class="text-center">Members</h3>
            <ul class="list-unstyled smallmargin">
                <?php
                foreach ($this->top_users as $usr) {
                    echo '<li class="smallmargin"> ' . $usr['score'] . ' - ' . $usr['firstname'] . ' ' . $usr['lastname'] . '</li>';
                }
                ?>
            </ul>
        </div>
        <br>
        <div class="col-sm"></div>

        <div class="col-sm-6">

            <div id="post_list" class="row black-borded scrollable white-col" style="height: 75%;border-top:none;border-right: none;border-left:none">
<?php echo $this->posts ?>
            </div>



        </div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>

    </div>


