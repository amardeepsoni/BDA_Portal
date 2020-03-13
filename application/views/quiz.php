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
        $_SESSION['Quiz']--;
        foreach ($all_data as $val) { ?>
            <div class="p-3">
                <h1 class="p-2">
                    <center>Quiz</center>
                </h1>
                <hr>
                <div class="container">
                    <div class="alert alert-primary" role="alert">
                        Questions left: <?php echo $_SESSION['Quiz']; ?>
                    </div>
                    <form action="quiz" id="quizform" method="POST" class="form-horizontal">

                        <p class="p-2"> Question <?php
                                                    $qno = 5 - $_SESSION['Quiz'];
                                                    echo $qno . "  : " . $val->Question; ?> </p>
                        <div class="form-check p-2">
                            <input class="form-check-input" onclick="showhint()" id="1" type="radio" name="radios" value="1" required>
                            <label class="form-check-label" for="radios1">
                                <?php echo $val->Option1 ?>
                            </label>
                        </div>
                        <div class="form-check p-2">
                            <input class="form-check-input" onclick="showhint()" id="2" type="radio" name="radios" value="2">
                            <label class="form-check-label" for="radios2">
                                <?php echo $val->Option2 ?>
                            </label>
                        </div>
                        <div class="form-check p-2">
                            <input class="form-check-input" onclick="showhint()" id="3" type="radio" name="radios" value="3">
                            <label class="form-check-label" for="radios3">
                                <?php echo $val->Option3 ?>
                            </label>
                        </div>
                        <div class="form-check p-2">
                            <input class="form-check-input" onclick="showhint()" id="4" type="radio" name="radios" value="4">
                            <label class="form-check-label" for="radios4">
                                <?php echo $val->Option4 ?>
                            </label>
                        </div>

                        <div id="wrong_ans" style="display: none" class="alert alert-warning" role="alert">
                            Answer: Option <?php echo $val->Answer . "<br>" . $val->Explanation; ?>
                        </div>
                        <div id="right_ans" style="display: none" class="alert alert-success" role="alert">
                            Your Answer is correct!!
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btSubmit" class="m-2 btn btn-primary">Save and Next</button>
                        </div>
                    </form>

                </div>
            </div>
    <?php }
    }else{
        redirect('intern/dashboard');
    } ?>
    <!-- Scripts -->
    <script>
        function showhint() {
            document.getElementById("right_ans").style.display = "none";
            document.getElementById("wrong_ans").style.display = "none";
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

                document.getElementById("right_ans").style.display = "block";
            } else {

                var x = document.getElementById("wrong_ans");
                x.style.display = "block";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>