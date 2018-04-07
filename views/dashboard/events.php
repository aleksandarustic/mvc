<div class="container-fluid">
    <input type="hidden" id='baseurl' value="<?php echo BASEURL ?>">

    <div class="row content">
        <div class="col-lg-4 col-sm-5 col-12 black-bordered">
            <form class="form-horizontal" method="post" action="<?php echo BASEURL ?>dashboard/addEvent">

                <div class="row">
                    <input type="hidden" name="userid" id="userid" value="<?php echo $this->profile['id'] ?>">


                    <div class="col-sm-7 offset-sm-1">
                        <textarea class="form-control" placeholder="Make a post in event section" name="text" rows="7" id="text" style="border: none"></textarea>
                    </div>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-12">
                            <select class="form-control" id="type" name="type">
                                <option  selected value="general">General </option>
                                <option value="jobs">Jobs</option>
                                <option value="accomodation">Accomodation</option>
                                <option value="societies">Societies </option>
                                <option value="shopping">Shopping </option>
                                <option value="holidays">Holidays</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mt-5"></div>
                        <div class="row mt-5">
                          <div class="col-12">

                            <button type="submit" class="btn btn-block badge-dark btn-default">Post</button>
                        </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="col-lg-7 col-sm-6 col-12 text-left">
            <?php
            $general = '';
            $jobs = '';
            $accomodation = '';
            $societies = '';
            $shopping = '';
            $holidays = '';
            foreach ($this->events as $event) {
                if ($event['type'] == 'general') {
                    $general .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                } elseif ($event['type'] == 'jobs') {
                    $jobs .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                } elseif ($event['type'] == 'accomodation') {
                    $accomodation .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                } elseif ($event['type'] == 'societies') {
                    $societies .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                } elseif ($event['type'] == 'shopping') {
                    $shopping .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                } elseif ($event['type'] == 'holidays') {
                    $holidays .= '<div class="row smallmargin"><div class="col-sm"></div><div class="col-lg-10 col-sm-8  white-col black-borded ">' . $event['text'] . '</div><div class="col-sm"></div></div>';
                }
            }
            ?>
            <div class="row">
                <fieldset class="col-sm-12">
                    <legend>General:</legend>
                    <?php echo $general; ?>
                </fieldset>
            </div>
            <div class="row smallmargin">
                <fieldset class="col-sm-12">
                    <legend>Jobs:</legend>
                    <?php echo $jobs; ?>
                </fieldset>
            </div>
            <div class="row smallmargin">
                <fieldset class="col-sm-12">
                    <legend>Accomodation:</legend>
                    <?php echo $accomodation; ?>
                </fieldset>
            </div>
            <div class="row smallmargin">
                <fieldset class="col-sm-12">
                    <legend>Societies:</legend>
                    <?php echo $societies; ?>
                </fieldset>
            </div>
            <div class="row smallmargin">
                <fieldset class="col-sm-12">
                    <legend>Shopping:</legend>
                    <?php echo $shopping; ?>
                </fieldset>
            </div>
            <div class="row smallmargin">
                <fieldset class="col-sm-12">
                    <legend>Holidays:</legend>
                    <?php echo $holidays; ?>
                </fieldset>
            </div>


        </div>
        <div class="col-sm"></div>

    </div>
    <div class="row content">

    </div>






