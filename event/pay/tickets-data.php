<?php

    foreach($tickets as $index => $ticket)
    {
        $exist = false;

        while(have_rows('ticket'))
        {
            the_row(); 

            if($ticket['type'] === get_sub_field('ticket_name'))
            {
                $exist              = [];
                $exist['name']      = get_sub_field('ticket_name');
                $exist['price']     = get_sub_field('ticket_price');
                $exist['available'] = get_sub_field('tickets_available');

                $availability[get_sub_field('ticket_name')]['available']--;
            }
        } 

        if(!$exist)
        {
            die('Ticket does not exist!');
        }

        $tickets[$index]['ticket'] = $exist;
    }