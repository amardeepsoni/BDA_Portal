<?php
if (!$this->session->userdata("intern")['user_id']) {
    redirect('/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container p-4" style="height: 80vh;">
        <?php
        $this->load->model('Dashboard_Model', 'dm');
        $query_out = $this->dm->check_upload_status($this->session->userdata("intern")['user_id']);
        if ($query_out['0']->upload_status) { ?>

            <h3>Uploaded Files:</h3>
            <div class="card" style="width: 18rem;">
                <img src="https://zapier.cachefly.net/storage/photos/b4a925f6c39483a70247b87031d0f67c.png" height="200px" width="100px" class="card-img-top" alt="https://zapier.cachefly.net/storage/photos/b4a925f6c39483a70247b87031d0f67c.png">
                <div class="card-body">
                    <h5 class="card-title">Uploaded Files</h5>
                    <a href="<?php echo $query_out['0']->profile_link; ?>" class="btn btn-success">Check File Once!!</a>
                </div>
            </div>

        <?php } else if ($data['0']->quiz_status) { ?>

            <h3>Upload your documents, <?php echo $this->session->userdata("intern")['name']; ?></h3>
            <h5>Instruction:-</h5>
            <ul>
                <li>
                    Ulpoad your Governemnt Id and Offer letter in a single pdf.
                </li>
            </ul>
            <form action="dashboard/upload_id" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input class="btn btn-outline-primary" type="file" name="file" id="fileToUpload">
                <input class="btn btn-info" type="submit" value="Upload Image" name="submit">
            </form>

        <?php } else { ?>

            <h3 class="p-3">To start Quiz click below,</h3>
            <a href="dashboard/quiz"><button type="button" class="btn btn-primary">Start Quiz</button></a>

        <?php } ?>
    </div>
</body>

</html>