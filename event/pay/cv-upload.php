<?php
    
    $allowed = ['application/pdf' => '.pdf', 'application/msword' => '.doc', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx'];

    // echo "<script>console.log('Debug Objects: " . json_encode($_FILES['cv']) . "' );</script>";
    // echo "<script>console.log('Debug Objects: " . json_encode($_FILES['cv']['name']) . "' );</script>";
    // echo "<script>console.log('Debug Objects: " . json_encode($_FILES['cv']['name'][0]) . "' );</script>";

    $upload = $_FILES['cv']['name'][0] ?? false;

    // if(in_array('CV', $required))
    if($upload)
    {
        foreach($_FILES as $data)
        {
            foreach($data as $key => $infos)
            {
                foreach($infos as $index => $value)
                {
                    if(!isset($tickets[$index]))
                    {
                        die('Invalid data.');
                    }

                    $tickets[$index]['cv'][$key] = $value;
                }
            }
        }

        foreach($tickets as $key => $ticket)
        {
            if(
                !isset($ticket['cv']['type'])     ||
                !isset($ticket['cv']['name'])     ||
                !isset($ticket['cv']['tmp_name']) ||
                !isset($ticket['cv']['error'])    ||
                !isset($ticket['cv']['size']) 
            )
            {
                die('There was problem uploading files. Please contact support.');
            }

            if($ticket['cv']['error'])
            {
                die('There was problem uploading files. Please contact support.');
            }

            $ticket['cv']['type'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $ticket['cv']['tmp_name']);

            if(!array_key_exists($ticket['cv']['type'], $allowed))
            {
                print_r($ticket['cv']['type']);
                die('Only PDF, DOC & DOCX file types supported.');
            }

            $name = preg_replace("/[^A-Za-z0-9?! ]/", '', $ticket['voornaam'] . ' ' . $ticket['achternaam']);
            $name = str_replace(' ', '-', $name);

            $ticket['cv']['size'] = $ticket['cv']['size'] / 1024;
            $ticket['cv']['link'] = '/wp-content/uploads' . wp_upload_dir()['subdir'] . '/' . $name . '-' .  uniqid() . $allowed[$ticket['cv']['type']];

            if($ticket['cv']['size'] > 10240)
            {
                die('Maximum allowed size is 10mb.');
            }

            if(!move_uploaded_file($ticket['cv']['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . $ticket['cv']['link'])) 
            {
                die('There was problem uploading files. Please contact support.');
            }

            $tickets[$key]['cv']['link'] = $ticket['cv']['link'];
        }
    }