<h2>All Users</h2>
<div class="table-responsive">          
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Date Creation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->users as $user) {
                echo '<tr>'
                . '<td>' . $user['id'] . '</td>'
                . '<td>' . $user['firstname'] . '</td>'
                . '<td>' . $user['lastname'] . '</td>'
                . '<td>' . $user['datecreation'] . '</td>';
            }
            ?>
        </tbody>
    </table>
</div>