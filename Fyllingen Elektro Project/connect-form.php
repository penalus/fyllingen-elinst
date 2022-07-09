<?php
if (isset($_POST['Email'])) {
    $email_to = "lotte.olsen.skole@gmail.com";
    $email_subject = "Ny melding fra Skjema";

    function problem($error)
    {
        echo "Beklager, det er en/flere feil ved innseding av skjema.";
        echo "Feilene vil vises nednfor.<br><br>";
        echo $error . "<br><br>";
        echo "Vennligst gå tilbake for å rette disse feilene og prøv igjen.<br><br>";
        die();
    }

    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Beklager, det er en feil med skjemaet.');
    }

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp, $email)) {
        $error_message .= 'Ugyldig epost adresse.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp, $name)) {
        $error_message .= 'Ugyldig navn.<br>';
    }

    if(strlen($message) < 2) {
        $error_message .= 'Ugyldig melding.<br>';
    }

    if(strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Skjema detaljer nedenfor.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email " . clean_string($email) . "\n";
    $email_message .= "Message " . clean_string($message) . "\n";


    // email headers
    $headers = 'Fra: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" . 
    'X-Mailer: PHP/' . phpversion();
    @email($email_to, $email_subject, $email_message, $headers);
    ?>

    <!-- Success message below -->

    Takk for din melding! Vi svarer fortløpende på alle henvendelser. 

    <?php
 }
 ?>
