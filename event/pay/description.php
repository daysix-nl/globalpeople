<?php

    $description = '';
    $types = [];

    foreach($tickets as $ticket)
    {
        if(!isset($types[$ticket['ticket']['name']]))
        {
            $types[$ticket['ticket']['name']] = ['total' => 0, 'price' => $ticket['ticket']['price']];
        }

        $types[$ticket['ticket']['name']]['total']++;
    }

    foreach($types as $name => $data)
    {
        $description .= $data['total'] . 'x ' . $name . ' (' . $data['price'] * $data['total'] . ' EUR), '; 
    }

    $description = rtrim($description, ', ');