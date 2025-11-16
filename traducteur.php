<?php
require_once "fonctions.php";

$erreurs = [];

if (isset($_POST["mot"])) {       
    $mot = $_POST["mot"];
} else {
    $mot = "";
}

if (isset($_POST["sens"])) {
    $sens = $_POST["sens"];
} else {
    $sens = "";
}

$resultat = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (trim($mot) === "") {
        $erreurs[] = "Veuillez entrer un mot.";
    }
    if ($sens !== "versAnglais" && $sens !== "versFrancais") {
        $erreurs[] = "Veuillez choisir un sens de traduction.";
    }
    if (empty($erreurs)) {
        $resultat = traduireMot($mot, $sens);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traducteur FR ⇄ EN</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        .erreur { color: red; }
        .ok { color: green; }
        table { border-collapse: collapse; margin-top: 20px; }
        th { background-color: #4CAF50; color: white; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

<h1>Traducteur Français ⇄ Anglais</h1>

<form action="" method="post">
    <label>Mot :</label><br>
    <input type="text" name="mot" value="<?php echo htmlspecialchars($mot); ?>"><br><br>

    <label>Traduire :</label><br>
    <select name="sens">
        <option value="versAnglais" <?php if ($sens !== "versFrancais") { echo "selected"; } ?>>Français → Anglais</option>
        <option value="versFrancais" <?php if ($sens === "versFrancais") { echo "selected"; } ?>>Anglais → Français</option>
    </select><br><br>

    <button type="submit">Traduire</button>
</form>

<hr>

<?php if (!empty($erreurs)) : ?>
    <div class="erreur">
        <ul>
            <?php foreach ($erreurs as $err) : ?>
                <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif ($_SERVER["REQUEST_METHOD"] === "POST") : ?>
    <?php if ($resultat !== null) : ?>
        <p class="ok">
            <strong>Mot :</strong> <?php echo htmlspecialchars(normaliserMot($mot)); ?><br>
            <strong>Traduction :</strong> <?php echo htmlspecialchars($resultat); ?>
        </p>
    <?php else : ?>
        <p class="erreur">Le mot "<?php echo htmlspecialchars($mot); ?>" est inconnu dans le dictionnaire.</p>

        <h2>Dictionnaire complet</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Français</th>
                    <th>Anglais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (obtenirDictionnaire() as $francais => $anglais) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($francais); ?></td>
                        <td><?php echo htmlspecialchars($anglais); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>