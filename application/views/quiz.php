<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="modal-open">
    <?php if ($_SESSION['Quiz'] != 0) {
	foreach ($all_data as $val) {?>
            <div class="p-3">
                <h1 class="p-2">
                    <center>Quiz</center>
                </h1>
                <hr>
                <div class="container">
                    <div class="alert alert-primary" role="alert">
                        Questions left: <?php echo $_SESSION['Quiz']; ?>
                    </div>
                    <form action="#" id="quizform" method="POST" class="form-horizontal">

                        <p class="p-2"> Question 1 : <?php echo $val->Question; ?> </p>
                        <div class="form-check">
                            <input class="form-check-input" id="1" type="radio" name="radios" value="1">
                            <label class="form-check-label" for="radios1">
                                A
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="2" type="radio" name="radios" value="2">
                            <label class="form-check-label" for="radios2">
                                B
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="3" type="radio" name="radios" value="3">
                            <label class="form-check-label" for="radios3">
                                C
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="4" type="radio" name="radios" value="4">
                            <label class="form-check-label" for="radios4">
                                D
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btSubmit" onclick="clickEvent(this)" class="m-2 btn btn-primary">Save and Next</button>
                        </div>
                        <div id="myDIV" class="alert alert-danger" role="alert" style="display: none">
                            Answer: Option <?php echo $val->Answer; ?>
                        </div>
                        <div id="myDiv" style="display: none" class="alert alert-success" role="alert">
                            Correct Answer!!
                        </div>
                    </form>

                </div>
            </div>
        <?php }
} else {
	?>
        <div class="conatiner p-4 text-center mt-5">
            <h1>Congratulations! Now, you will receive an email !!</h1>
        </div>
    <?php session_unset();
	session_destroy();}?>
    <!-- Scripts -->
    <script>
        function clickEvent(form) {
            if (document.getElementById('1').checked) {
                var x = 1;
            } else if (document.getElementById('2').checked) {
                var x = 2;
            } else if (document.getElementById('3').checked) {
                var x = 3;
            } else if (document.getElementById('4').checked) {
                var x = 4;
            } else {
                alert("Select one option!!");
            }
            if (x == <?php echo $val->Answer ?>) {
                form.style.background = "#38c346";
                console.log("Yes");
                document.getElementById("myDiv").style.display = "block";
            } else {
                form.style.background = "#a93a3a";
                var x = document.getElementById("myDIV");
                x.style.display = "block";
            }

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>