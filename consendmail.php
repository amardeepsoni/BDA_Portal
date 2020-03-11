<?php ob_start(); ?>
<?php
session_start();
@extract($_POST);
$name = $_POST['name'] ;
$email = $_POST['email'] ;
$contact = $_POST['contact'] ;
$message = $_POST['message'] ;

 if( $_SESSION['security_code'] == $_POST['captchacode'] && !empty($_SESSION['security_code'] ) )
	{
$message1="Website Feedback  : <br /><br />
<table width='500' border='1' cellpadding='10' cellspacing='10' style='border:1px #ccc solid; border-collapse:collapse; color:#000'>
  <tr>
    <td width='250'>Name</td>
    <td  width='250'>".$name." </td>
  </tr> 
    <tr>
    <td width='250'>Email</td>
    <td  width='250'>".$email." </td>
  </tr> 
    <tr>
    <td width='250'>Contact Number</td>
    <td  width='250'>".$contact." </td>
  </tr> 
    <tr>
    <td width='250'>Message</td>
    <td  width='250'>".$message." </td>
  </tr>    
</table>
";

$headers = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: <info@presswellcomponents.com>' . "\r\n";

if(mail("tapes@edtech.in", "Presswell Components Pvt. Ltd. Feedback Form...", $message1, $headers )) {	

	?>

<script>alert("Message Sent Successfully");

    window.location.href="http://www.presswellcomponents.com/";

    </script>

<?php 	

	}

	else {

		?>

<script>alert("Not Send");

history.go(-1);

</script>

<?php 	

		}

unset($_SESSION['security_code']);

      }

      else{


?>

<script>alert("Invalid Image Code.");

   history.go(-1);

    </script>

<?php 


}


?>

<?php


ob_end_flush();


?>