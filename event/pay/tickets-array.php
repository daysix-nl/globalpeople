<?php

    $tickets = [];

    foreach($required as $key)
    {
        if(isset($_POST[strtolower($key)]))
        {
            if(!is_array($_POST[strtolower($key)]))
            {
                die('Invalid data format! ' . $key);
            }

            foreach($_POST[strtolower($key)] as $index => $value)
            {
                if(!isset($tickets[$index]))
                {
                    $tickets[$index]       = [];
                    $tickets[$index]['cv'] = [];
                }

                $tickets[$index][strtolower($key)] = $value;
            }
        }
    }