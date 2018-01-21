
<html>
    <head>
        <title><?php echo $this->title ?></title>
        <link href="<?php echo BASEURL ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                padding-top: 54px;
            }
            @media (min-width: 992px) {
                body {
                    padding-top: 56px;
                }
            }
            .content{
                margin-top: 30px;
            }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo BASEURL ?>">MVC project</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>">Home</a>
                        </li>
                    
                        <?php if(Session::exist()){ ?>
                         <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/listAllUsers">List all users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/logout">Logout</a>
                        </li>
                        
                        <?php }?>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container content">


