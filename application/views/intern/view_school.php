<div class="container p-2">
    <?php
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">School Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Added on</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $value) { ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?php echo $value['sName']; ?></td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>