<div class="container p-2">
    <?php $school = $data['info'];
    $count = 1; ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">School Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Registered Students</th>
                <th scope="col">Added on</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($school as $value) {
            ?>
                <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $value->sName; ?></td>
                    <td><?php echo $value->sAddress; ?></td>
                    <td><?php echo $value->sContact; ?></td>
                    <td><?php echo $value->sPerson; ?></td>
                    <td><?php echo $value->no_of_students; ?></td>
                    <td><?php echo $value->add_time; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>