<div class="container">
    <h1 class="text-center p-2 m-2" style="text-align: center;">
      <u>  History Table </u>
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">Task Topic</th>
                <th scope="col">Task Description</th>
                <th scope="col">Task allotted at</th>
                <th scope="col">Task done at</th>
                <th scope="col">Your Response</th>
                <th scope="col">Suggestions</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;
            foreach ($data as $value) {
            ?>
                <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $value['topic']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td><?php echo $value['add_time']; ?></td>
                    <td><?php echo $value['complete_time']; ?></td>
                    <td><?php echo "<i>".$value['response']."</i>"; ?></td>
                    <td><?php if ($value['suggestion']) echo ($value['suggestion']);
                        else echo "<i>No Suggestion<i>"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>