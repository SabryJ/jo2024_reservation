<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../includes/db_connexion.php';

function genererCleAuth() {
    return bin2hex(random_bytes(16));
}

$page_css = '../assets/css/inscription_style.css';
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $motdepasse = $_POST['motdepasse'];

    // Vérification mot de passe
    $motdepasseOk = preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $motdepasse);
    if (!$motdepasseOk) {
        $error = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
    } else {
        $motdepasse_hache = password_hash($motdepasse, PASSWORD_BCRYPT);
        $cle_authentification = genererCleAuth();
        $token = bin2hex(random_bytes(32));

        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur = ?");
        $stmt->execute([$username]);
        $utilisateurExist = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateurExist) {
            $error = "Le nom d'utilisateur est déjà pris.";
        } else {
            // Vérification si l'email est déjà utilisé
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
$stmt->execute([$email]);
$emailExist = $stmt->fetch(PDO::FETCH_ASSOC);

if ($emailExist) {
    $error = "Cet email est déjà utilisé pour un autre compte.";
} else {
    $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, nom_utilisateur, mot_de_passe, cle_authentification) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$nom, $prenom, $email, $username, $motdepasse_hache, $cle_authentification]);


            // Stocker le nom d'utilisateur en session
            $_SESSION['username'] = $username;

            // Message de succès à afficher sur la page panier
            $_SESSION['message_success'] = "Inscription réussie ! Bienvenue sur notre plateforme.";

            // Redirection vers la page panier
            header("Location: confirmation_paiement.php");
            exit();
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - JO 2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $page_css; ?>">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="form-container bg-white p-4 rounded shadow-lg w-100" style="max-width: 500px;">
            <h2 class="text-center text-primary mb-4">Créer un compte</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required onkeyup="checkPassword()">
                </div>

                <div id="passwordCriteria">
                    <p>Critères du mot de passe :</p>
                    <ul class="list-unstyled">
                        <li id="minLength" class="invalid">Au moins 8 caractères</li>
                        <li id="uppercase" class="invalid">Une majuscule</li>
                        <li id="lowercase" class="invalid">Une minuscule</li>
                        <li id="number" class="invalid">Un chiffre</li>
                        <li id="specialChar" class="invalid">Un caractère spécial</li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('motdepasse');
        const minLength = document.getElementById('minLength');
        const uppercase = document.getElementById('uppercase');
        const lowercase = document.getElementById('lowercase');
        const number = document.getElementById('number');
        const specialChar = document.getElementById('specialChar');

        function checkPassword() {
            const password = passwordInput.value;

            minLength.classList.toggle('valid', password.length >= 8);
            minLength.classList.toggle('invalid', password.length < 8);

            uppercase.classList.toggle('valid', /[A-Z]/.test(password));
            uppercase.classList.toggle('invalid', !/[A-Z]/.test(password));

            lowercase.classList.toggle('valid', /[a-z]/.test(password));
            lowercase.classList.toggle('invalid', !/[a-z]/.test(password));

            number.classList.toggle('valid', /\d/.test(password));
            number.classList.toggle('invalid', !/\d/.test(password));

            specialChar.classList.toggle('valid', /[\W_]/.test(password));
            specialChar.classList.toggle('invalid', !/[\W_]/.test(password));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
