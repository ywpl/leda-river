<?php

//Script Foreach
$c = true;

// For POST method only!

// Save Basic Form parametrs
$project_name = "ЗАЯВКА ОНЛАЙН - Leda~River";
$admin_email = "leda-river@mail.ru";
$email_from = "message@leda-river.ru";

// Serialize form fields - that filled-in by User
foreach ( $_POST as $key => $value ) {
	if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" && $key != "email_from" ) {
		$message .= "
		" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
		<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
	</tr>
	";
	}
}

// Create message text for sending on email
$message = "<table style='width: 100%;'>$message</table>";

// Function to save User data in file
function send_user_data_in_txt_file ($message){

    //HERE SAVE TEXT INFO
	$f = fopen('call_fill.html', 'a+');
	fwrite($f, date('Y-m-d H:i:s'). "\n");
    fwrite($f, $message );
    fwrite($f, "\n" . "\n" . "\n" . "\n");

}

// Adjusting text encoding
function adopt($text) {
	return '=?UTF-8?B?'.base64_encode($text).'?=';
}

$form_subject = 'Сообщение с сайта!';

// Preparing header
$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$email_from.'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;
// Sending email to admin
mail($admin_email, $form_subject, $message, $headers);

// Saving user data in file
send_user_data_in_txt_file ($message);
?>


