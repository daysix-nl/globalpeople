<?php

    foreach($availability as $ticket)
    {
        if($ticket['available'] < 0)
        {
            die('There are no enough tickets at this time. Please check back later.');
        }
    }