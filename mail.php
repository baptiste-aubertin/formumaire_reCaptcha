<?php
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$website = htmlspecialchars($_POST['website']);
$message = htmlspecialchars($_POST['message']);

if (!empty($_REQUEST['honnypot']) && (bool) $_REQUEST['honnypot'] == TRUE) {
    echo "sent";
} else if(!empty($email) && !empty($message)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        $receiver = "bapt120@hotmail.fr";
        $subject = "From: $name <$email>";
        $body = "Name: $name\n
        Email: $email\n
        Phone: $phone\n
        Website: $website\n\n
        Message:\n$message\n\n\n
        $name";

        $sender = "From: $email";


        if(mail($receiver, $subject, $body, $sender)){
            echo "sent";
        }else{
            echo "failed";
        }
    }else{
        echo "invalid_mail";
    }
}else{
    echo "field_required";
}
?>