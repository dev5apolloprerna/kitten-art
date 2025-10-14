<?php 



$html = 'Dear '.$User['UserName'].',<br> Your Onetime OTP for login is below </br>'; 
$html .="<h4>OTP: ".$User['OTP'].'</h4>';

echo $html;

?>