<?php
    
    $availability = [];

    while(have_rows('ticket'))
    {
        the_row(); 

        $availability[get_sub_field('ticket_name')]['name']      = get_sub_field('ticket_name');
        $availability[get_sub_field('ticket_name')]['price']     = get_sub_field('ticket_price');
        $availability[get_sub_field('ticket_name')]['available'] = get_sub_field('tickets_available');
    } 