<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Mauvaise requête
    exit("Tous les champs sont obligatoires et l'email doit être valide.");
}

$name = strip_tags(htmlspecialchars(trim($_POST['name'])));
$email = strip_tags(htmlspecialchars(trim($_POST['email'])));
$m_subject = strip_tags(htmlspecialchars(trim($_POST['subject'])));
$message = strip_tags(htmlspecialchars(trim($_POST['message'])));

$to = "bristhisdegbeko@gmail.com"; // Adresse de réception
$subject = "$m_subject: $name";
$body = "Vous avez reçu un nouveau message depuis votre site\n\n".
        "Voici les détails:\n\n".
        "Nom: $name\n".
        "Email: $email\n".
        "Sujet: $m_subject\n".
        "Message:\n$message";

$headers = "From: contact@bristhisdegbeko.fr\r\n"; // From sécurisé
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoyer l'email et gérer la réponse
if(mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Message envoyé avec succès.";
} else {
    http_response_code(500);
    echo "Erreur lors de l'envoi du message.";
}
?>