<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php
    // echo $data['0']->quiz_status;
    if ($data['0']->quiz_status) { ?>
        <div class="container p-4" style="height: 100vh;">
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
        </div>
    <?php } else { ?>
        <div class="container p-4" style="height: 100vh;">
            <h3>To start Quiz click below...</h3>
            <a href="dashboard/quiz"><button type="button" class="btn btn-primary">Start Quiz</button></a>
        </div>
    <?php } ?>
</body>
</html>