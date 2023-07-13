<?php

    $required = ['voornaam', 'achternaam', 'geboortedatum', 'email', 'telefoonnummer', 'opleidingsniveau', 'cv', 'functieniveau', 'function0'];

    foreach($required as $key)
    {
        if(!isset($_POST[strtolower($key)]) && !isset($_FILES[strtolower($key)]))
        {
            die('Missing ' . $key . '!');
        }
    }