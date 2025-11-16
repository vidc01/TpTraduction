<?php


require_once __DIR__ . "/dictionnaire.php";


function obtenirDictionnaire() {
    global $dico;
    return $dico;
}

function normaliserMot($mot) {
    $mot = trim($mot); 
    $mot = implode(' ', preg_split('/\s+/', $mot)); 

    return mb_strtolower($mot, "UTF-8");
}
function obtenirMotsConnus($sens) {
    $dictionnaire = obtenirDictionnaire();

    if ($sens === "versAnglais") {
        return array_keys($dictionnaire); 
    }

    if ($sens === "versFrancais") {
        return array_values($dictionnaire); 
    }

    return [];
}

function traduireMot($mot, $sens) {
    $mot = normaliserMot($mot);
    $dictionnaire = obtenirDictionnaire();

    if ($sens === "versAnglais") {

        return $dictionnaire[$mot] ?? null;
    }

    if ($sens === "versFrancais") {

        foreach ($dictionnaire as $fr => $en) {
            if ($mot === normaliserMot($en)) {
                return $fr;
            }
        }
        return null;
    }

    return null;
}
?> 
