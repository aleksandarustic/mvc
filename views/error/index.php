<div class="container content">

<div class="row">
    <div class="col-lg-12 text-center">
        <div class="row align-items-start">
            <div class="col-6 offset-3">
                <ul class="list-group">
                <?php
                foreach ($this->messages as $msg){
                    echo '<li class="list-group-item list-group-item-danger">'.$msg.'</li>';
                }
                ?>
                </ul>
            </div>
        </div>
        <?php
        if($this->layout == 'login'){
            $url = BASEURL .'auth/login';
            $text = 'Try again';
        }
        else if($this->layout == 'register'){
            $url = BASEURL .'auth/register';
            $text = 'Try again';
        }
        else{
            $url = BASEURL;
            $text = 'Back to home page';
        }
        ?>
        <div class="row mt-3">
            <div class="col-4 offset-4">
                <a href="<?PHP echo $url ?>" type="button" class="btn-info btn"> <?php echo  $text?></a>
            </div>
        </div>

    </div>
</div>


