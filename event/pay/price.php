<?php
    
    $price = 0;

    foreach($tickets as $ticket)
    {
        $price += floatval($ticket['ticket']['price']);
    }