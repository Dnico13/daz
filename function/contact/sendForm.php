<?php

require_once '../../pdo.php';
// --- 3. Traitement du formulaire quand il est soumis ---
if (isset($_POST['submit'])) {
    // Récupérer et nettoyer les données du formulaire
    // htmlspecialchars() pour prévenir le XSS lors de l'affichage des données
    // trim() pour supprimer les espaces blancs au début et à la fin
    $nom = trim(htmlspecialchars($_POST['nom'] ?? ''));
    $prenom = trim(htmlspecialchars($_POST['prenom'] ?? ''));
    $numero = trim(htmlspecialchars($_POST['numero'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $objet = trim(htmlspecialchars($_POST['objet'] ?? ''));
    $text = trim(htmlspecialchars($_POST['message'] ?? ''));

    // --- 4. Validation des données côté serveur ---
    if (empty($nom) || empty($prenom) || empty($numero) || empty($email) || empty($objet) || empty($text)) {
        $errorMessage = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "L'adresse email n'est pas valide.";
    } elseif (!preg_match('/^[0-9]{10}$/', $numero)) {
        $errorMessage = "Le numéro de téléphone doit contenir 10 chiffres.";
    } else {

        try {


            // --- 6. Préparation et exécution de la requête d'insertion ---
            $sql = "INSERT INTO message (nom, prenom, numero, email, objet, message) VALUES (:nom, :prenom, :numero, :email, :objet, :text)";
            $stmt = $pdo->prepare($sql);

            // Liaison des valeurs aux paramètres de la requête préparée
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':objet', $objet);
            $stmt->bindParam(':text', $text);

            $stmt->execute(); // Exécution de la requête
            //----- envoi du mail --------dz@daz-expertiseimmobiliere.com
            $to = 'Dnico13@hotmail.com'; // Remplace par l'adresse réelle du responsable
            $subject = "📬 Nouveau message reçu via le site de daz-expertise immobiliere V2";
            $messageEmail = "
                            Nom : $nom
                            Prénom : $prenom
                            Numéro : $numero
                            Email : $email
                            Objet : $objet
                            Message :$text
                    ";

            $headers = "From: \"$prenom $nom\" <contact@ndev2023.fr>\r\n";

            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Envoi du mail
            mail($to, $subject, $messageEmail, $headers);

            // fin de l'envoi du mail
            $successMessage = "Votre message a été envoyé avec succès !";

            // Optionnel: Réinitialiser les champs du formulaire après succès
            //$_POST = array(); // Vide le tableau POST pour que les champs soient vides
            //$nom = $prenom = $numero = $email = $objet = $text = '';
            echo "<script>
                    alert('Votre message a bien été envoyé !');
                    window.location.href = '/contact';
                    </script>";
            exit;
        } catch (PDOException $e) {
            $errorMessage = "Erreur lors de l'envoi de votre message : " . $e->getMessage();
            // Pour le débogage, vous pouvez afficher l'erreur complète :
            // echo "Erreur PDO : " . $e->getMessage();
        }
    }
}
