<?php


require_once DIR . "/dictionnaire.php";


function obtenirDictionnaire() {
    global $dico;
    return $dico;
}

function normaliserMot($mot) {
    $mot = trim($mot); 
    $mot = implode(' ', preg_split('/\s+/', $mot)); 

    return mb_strtolower($mot, "UTF-8");
}
