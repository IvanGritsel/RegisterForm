<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$body = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
];

$body = json_encode($body);

$sock = socket_create(AF_INET, SOCK_STREAM, 0);

$result = socket_connect($sock, '127.0.0.1', 9090);

$message = "POST /register HTTP1.1\r\n\r\n$body";
socket_write($sock, $message, strlen($message));
$response = socket_read($sock, 4096);
socket_close($sock);

$responseLines = preg_split("/\r\n/", $response);
$responseBody = json_decode(end($responseLines), true);

if ($responseBody) {
    $code = preg_split('/\s/', $responseLines[0])[1];
    $responseBody['code'] = $code;
    $responseBody['PageTitle'] = 'Welcome';
    $responseBody['first_name'] = $_POST['first_name'];
    $responseBody['last_name'] = $_POST['last_name'];

    $loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../template');
    $twig = new Twig\Environment($loader);

    if ($code == 200 || $code == 204 || $code == 400) {
        echo $twig->render('main_page.twig', $responseBody);
    } else {
        echo $twig->render('error.twig', $responseBody);
    }
}
