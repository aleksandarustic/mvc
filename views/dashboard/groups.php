<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-6 text-left scrollable white-col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>All courses</th>
                        <th>Members</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->groups as $group) {
                        echo '<tr>'
                            . '<td><a href="'.BASEURL.'dashboard/group/'.$group['id'].'">'. $group['name'] .'</a></td>'
                            . '<td>' . $group['members'] . '</td>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-3">

        </div>
    </div>