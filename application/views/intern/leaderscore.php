<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: grey;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #b30000;
    }
</style>
<div class="container">
    <?php
    $record = $score['scores'];
    $counts = 1;

    ?>
    <ul class="list-group">
        <?php
        foreach ($record as $info) {
            $per = $info['score'];
        ?>

            <li class="list-group-item list-group-item-action <?php if ($info['user_id'] === $this->session->userdata("intern")['user_id']) {
                                                                    echo 'active" id="myscore';
                                                                } ?>" style=" background-color: #fff; color:#000;">
                <div class="p-2">
                    <?php echo "<b>#</b>" . $counts++ . "   " . $info['user_id']; ?>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info progress-bar-striped" style="width:<?php echo $per; ?>%"></div>
                </div>
                <div class="text-right">
                    <?php echo $info['score']; ?>
                </div>
            </li>

        <?php }

        ?>
    </ul>
</div>
<script>
    const myscore = document.getElementById('myscore');

    myscore.scrollIntoView(true);
    myscore.scrollIntoView({
        block: 'center'
    });
</script>