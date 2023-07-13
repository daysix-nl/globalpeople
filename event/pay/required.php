<?php

    $required = get_field('attendie_info_needed'); array_push($required, 'type');

    foreach($required as $key)
    {
        if(!isset($_POST[strtolower($key)]) && !isset($_FILES[strtolower($key)]))
        {
            die('Missing ' . $key . '!');
        }
    }