<?php
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$website = htmlspecialchars($_POST['website']);
$message = htmlspecialchars($_POST['message']);
$recaptcha = $_POST['g-recaptcha-response'];
$res = reCaptcha($recaptcha);
if($res['success']) {
    // Send email

    if (!empty($_REQUEST['honnypot']) && (bool)$_REQUEST['honnypot'] == TRUE) {
        echo "sent";
    } else if (!empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $receiver = "bapt120@hotmail.fr";
            $subject = "From: $name <$email>";
            $body = "Name: $name\n
        Email: $email\n
        Phone: $phone\n
        Website: $website\n\n
        Message:\n$message\n\n\n
        $name";

            $sender = "From: $email";


            if (mail($receiver, $subject, $body, $sender)) {
                echo "sent";
            } else {
                echo "failed";
            }
        } else {
            echo "invalid_mail";
        }
    } else {
        echo "field_required";
    }
}else echo $recaptcha;

function reCaptcha($recaptcha){
    $secret = "private_key";
    $ip = $_SERVER['baubertin.com'];

    $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);

    return json_decode($data, true);
}
?>