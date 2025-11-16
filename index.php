<?php
$dico = [
    "chat" => "cat",
    "chien" => "dog",
    "maison" => "house",
    "voiture" => "car",
    "arbre" => "tree",
    "soleil" => "sun",
    "lune" => "moon",
    "mer" => "sea",
    "montagne" => "mountain",
    "ordinateur" => "computer",
    "telephone" => "phone",
    "table" => "table",
    "chaise" => "chair",
    "porte" => "door",
    "fenetre" => "window",
    "livre" => "book",
    "stylo" => "pen",
    "ville" => "city",
    "pays" => "country",
    "ecole" => "school",
    "ami" => "friend",
    "famille" => "family",
    "professeur" => "teacher",
    "eleve" => "student",
    "travail" => "work",
    "argent" => "money",
    "eau" => "water",
    "feu" => "fire",
    "terre" => "earth",
    "vent" => "wind",
    "rouge" => "red",
    "bleu" => "blue",
    "vert" => "green",
    "noir" => "black",
    "blanc" => "white",
    "beau" => "beautiful",
    "rapide" => "fast",
    "lent" => "slow",
    "fort" => "strong",
    "faible" => "weak",
    "grand" => "tall",
    "petit" => "small",
    "froid" => "cold",
    "chaud" => "hot",
    "manger" => "eat",
    "boire" => "drink",
    "marcher" => "walk",
    "parler" => "talk",
    "dormir" => "sleep"
];

function obtenirDictionnaire() {
    global $dico;
    return $dico;
}

function traduireMot($mot, $sens) {
    $mot = strtolower(trim($mot));
    $dico = obtenirDictionnaire();

    if ($sens === "versAnglais") {
        return $dico[$mot] ?? null;
    }

    if ($sens === "versFrancais") {
        foreach ($dico as $fr => $en) {
            if ($mot === strtolower($en)) {
                return $fr;
            }
        }
    }

    return null;
}

$sens = $_POST["sens"] ?? "versAnglais";
$mot = $_POST["mot"] ?? "";
$resultat = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultat = traduireMot($mot, $sens);
}

require "index.phtml";