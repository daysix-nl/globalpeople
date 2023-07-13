<?php
    
    $allowed = ['application/pdf' => '.pdf', 'application/msword' => '.doc', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx'];

    $upload = $_FILES['cv'] ?? false;

    if($upload)
    {
        if(
            !isset($upload['type'])     ||
            !isset($upload['name'])     ||
            !isset($upload['tmp_name']) ||
            !isset($upload['error'])    ||
            !isset($upload['size']) 
        )
        {
            die('There was problem uploading files. Please contact support.');
        }

        if($upload['error'])
        {
            die('There was problem uploading files. Please contact support.');
        }

        $upload['type'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $upload['tmp_name']);

        if(!array_key_exists($upload['type'], $allowed))
        {
            die('Only PDF, DOC & DOCX file types supported.');
        }

        $upload['size'] = $upload['size'] / 1024;
        $upload['id']   = wp_upload_dir()['subdir'] . '/' . uniqid() . $allowed[$upload['type']];;
        $upload['link'] = '/wp-content/uploads' . $upload['id'];

        if($upload['size'] > 10240)
        {
            die('Maximum allowed size is 10mb.');
        }

        if(!move_uploaded_file($upload['tmp_name'], dirname($_SERVER['SCRIPT_FILENAME']) . $upload['link'])) 
        {
            die('There was problem uploading files. Please contact support.');
        }
    }