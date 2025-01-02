<?php

$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

function generate_and_send_pdf($html, $dev_email, $client_email, $current_file_name)
{
    try {
        // Step 1: Generate the PDF using Dompdf
        $dompdf = new Dompdf();
        // allow remote 
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->set_option('isHtml5ParserEnabled', true);


        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML to PDF
        $dompdf->render();

        // Output the PDF to a string
        $pdfOutput = $dompdf->output();

        // Save the PDF to a file (optional, if you want to keep a copy)
        // $pdfFilePath = 'sample.pdf';
        // file_put_contents($pdfFilePath, $pdfOutput);
        
        // Send one email to the client with the signed contract attached
        sendEmail($dev_email, $client_email, 'Contract Notification', 'The signed contract is attached. Thank you for working with us.', $pdfOutput);
        sendEmail($dev_email, $dev_email, 'Contract Notification', 'The signed contract is attached. Thank you for working with us.', $pdfOutput);

    } catch (Exception $e) {
        // echo "An error occurred: {$mail->ErrorInfo}";
        echo "An error occurred: {$e->getMessage()}";
    }
}

function sendEmail($from_email, $to_email, $subject, $body, $attachment) {
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'krafiki143@gmail.com'; // Your Gmail address
    $mail->Password = 'epdhedelibfhvcno';   // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom($from_email, $from_email);
    $mail->addAddress($to_email, $to_email);
    if ($attachment) {
        $mail->addStringAttachment($attachment, 'contract.pdf');
    }

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    // $mail->AltBody = 'Hello World'; // For non-HTML mail clients

    // Send the email
    $mail->send();
}

// Function to generate a copy of contract.php into contract-clientname-uniqueid.php 

function generate_contract($client_name, $client_email)
{
    if (!file_exists('contracts')) {
        mkdir('contracts');
    }
    // if file already exists return boolean false
    if (file_exists("contracts/contract-$client_name-" . email_to_id($client_email) . ".php")) {
        return false;
    }
    $contract = file_get_contents('sample-contract.php');
    // change require '../variables.php';  into require '../variables.php';
    $contract = str_replace('[Client Name]', $client_name, $contract);
    $contract = str_replace('[Client Name2]', '[Client Name]', $contract);
    $contract = str_replace('[Client Email]', $client_email, $contract);
    $name_with_dashes = str_replace(' ', '-', $client_name);
    file_put_contents("contracts/contract-$name_with_dashes-" . email_to_id($client_email) . ".php", $contract);
    return "contracts/contract-$name_with_dashes-" . email_to_id($client_email) . ".php";
}

// Function to convert email address into a unique id 

function email_to_id($email)
{
    return md5($email);
}

// Function to generate html file for the contract

function generate_html($html, $path)
{
    file_put_contents($path, $html);
}
