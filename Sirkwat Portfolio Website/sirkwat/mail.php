<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents('php://input'), true);

// Check if data is received correctly
if (isset($data['name'], $data['email'], $data['phone'], $data['message'], $data['company'])) {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $message = $data['message'];
    $company = $data['company'];
    $to = 'bonifacekwatengamaning@gmail.com';
    $body = "Name: $name\nCompany: $company\nEmail: $email\nPhone: $phone\nMessage: $message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo json_encode(array('message' => 'Email sent successfully.'));
    } else {
        http_response_code(500);
        echo json_encode(array('message' => 'There was an error sending the email.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Invalid input.'));
}
?>