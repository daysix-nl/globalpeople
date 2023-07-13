<?php

global $wpdb;

    if($price > 0)
    {
        $pid = $payment->id;
    }
    else
    {
        $pid = 'free_' . microtime(true);
    }
    
    foreach($tickets as $ticket)
    {
        $update = [];
        $update['event_id'] = get_the_id();
        $update['event']    = get_the_title();
        $update['payment']  = $pid;
        $update['price']    = $ticket['ticket']['price'];
        $update['cv']       = $ticket['cv']['link'] ?? '';

        foreach($required as $key)
        {
            $update[strtolower($key)] = $ticket[strtolower($key)];
        }

        $update['cv'] = $ticket['cv']['link'] ?? '';

        if(!$wpdb->insert($wpdb->base_prefix.'event_purchases', $update))
        {
            die('There was error processing payment.');
        }
    }