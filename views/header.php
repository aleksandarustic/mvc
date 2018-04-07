
<html>
    <head>
        <title><?php echo $this->title ?></title>
        <link href="<?php echo BASEURL ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>

            body {
                padding-top: 54px;
                background-color: lightblue;
            }
            @media (min-width: 992px) {
                body {
                    padding-top: 56px;
                }
            }
            .content{
                margin-top: 55px;
            }
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {}

            /* Set gray background color and 100% height */
            .sidenav {
                background-color: #f1f1f1;
                border: 2px solid black;
            }

            /* On small screens, set height to 'auto' for the grid */
            @media screen and (max-width: 767px) {
                .row.content {height: auto;}
            }
            .black-borded{
                border: 2px solid black;
            }
            .scrollable{
                overflow-y: scroll;
                border: 2px solid black;
                max-height: 67%;
            }
            .scrollable2{
                overflow-y: scroll;
            }
            .white-col{
                background-color: white;
            }
            .nopadding {
                padding: 0 !important;
                margin: 0 !important;
            }
            .smallmargin{
                margin-top: 20px;
            }
            .avatar{
                max-width:200px;
                max-height:200px;
            }
            fieldset
            {
                margin: 0;
                xmin-width: 0;
                padding: 10px;
                position: relative;
                border-radius:4px;
                background-color:#f5f5f5;
                padding-left:10px!important;
                border:3px solid black;
            }

            legend
            {
                font-size:14px;
                font-weight:bold;
                margin-bottom: 0px;
                width: 35%;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 5px 5px 5px 10px;
                background-color: #ffffff;
            }
            .btn-responsive {
                 white-space: normal !important;
            word-wrap: break-word;
}

        </style>
        <script src="<?php echo BASEURL ?>public/vendor/jquery/jquery.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo BASEURL ?>">UOW Collarobative Plarform</a>
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
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/events">Events</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/groups">Groups</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/profile">Profile</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/help">Help</a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL ?>dashboard/logout">Logout</a>
                        </li>
                        
                        <?php }?>

                    </ul>
                </div>
            </div>
        </nav>


