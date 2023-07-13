<?php
	

    require_once 'Mollie/vendor/autoload.php';
    require_once 'Mollie/examples/functions.php';
    global $post;
	

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey('live_hgAT2x4Ak6Me98NqS9fWEEk9tHnhJr');
    // $mollie->setApiKey('test_JcWqk3QUCxUCdHnRrpFcn9cQmCAwhd');

    $payment = $mollie->payments->get($_POST['id']);

    if($payment->isPaid())
    {
        $wpdb->update('rwe_event_purchases', array('completed' => 1), array('payment' => $payment->id));

        if(!$campaign = Carerix_Api_Rest_Entity_CRCampaign::find(get_field('campaign_id')))
        {
            exit;
        }

        $candidates = $wpdb->get_results("SELECT * FROM rwe_event_purchases WHERE completed = 1 AND payment = '".$payment->id."'");

        $email          = [];
        $email['event'] = '';
        $email['price'] = 0;
        $email['text']  = '';

        foreach($candidates as $candidate)
        {
            $user = new Carerix_Api_Rest_Entity_CREmployee();
            $user->setFirstName($candidate->voornaam);
            $user->setLastName($candidate->achternaam);
            $user->setEmailAddress($candidate->email);
            $user->setPhoneNumber($candidate->telefoonnummer);

            if($candidate->opleidingsniveau)
            {
                $node = Carerix_Api_Rest_Entity_CRDataNode::find($candidate->opleidingsniveau);

                $education = new Carerix_Api_Rest_Entity_CREmployeeEducation();
                $education->setToLevel1Education1($node);

                $user->setEducations($education);
            }

            if($candidate->werkvelden)
            {
                $node = Carerix_Api_Rest_Entity_CRDataNode::find($candidate->werkvelden);

                $user->setToFunction1Level1Node($node);
            }

            $user->setEducationInformation($candidate->opleiding);
           
            /* CV Upload */

            if($candidate->cv)
            {
                $cv = file_get_contents(__DIR__ . '/../../../../..' . $candidate->cv, true);
                $cv = base64_encode($cv);

                $attachment = new Carerix_Api_Rest_Entity_CRAttachment(array(
                    'content'  => $cv,
                    'owner'    => false,
                    'filePath' => pathinfo($candidate->cv)['filename'] . '.' . pathinfo($candidate->cv)['extension'],
                    'label'    => 'Candidate CV',
                ));

                $attachment->save();
                $user->setAttachments($attachment);
            }

            /* CV Upload */

            $saved = $user->save();

            $user = Carerix_Api_Rest_Entity_CREmployee::find($saved->getId());

            $toDoUser = new Carerix_Api_Rest_Entity_CRToDoUser();
            $toDoUser->setIsActive(1);
            $toDoUser->setToUser($user->getToUser());

            $realUser = Carerix_Api_Rest_Entity_CRUser::find($user->getToUser()->getId());
            $realUser->setJobTitle($candidate->bedrijf . ' | ' . $candidate->functie);

            $realUser->save();

            $campaign->setToDoUsers($toDoUser);
            $campaign->save();

            $text = '[' . $candidate->voornaam . ' ' . $candidate->achternaam . ' - Email: ' . $candidate->email . ' - Price/Type: ' . $candidate->type . ' - €' . $candidate->price . ' - Opleidingsniveau: ' . $candidate->opleidingsniveau . ' - Opleiding: ' . $candidate->opleiding . ' - Werkvelden: ' . $candidate->werkvelden . ' - Bedrijf: '. $candidate->bedrijf . ' - Functie: '. $candidate->functie . ' - CV: https://globalpeople.nl/' . $candidate->cv . ']';

            $email['event'] = $candidate->event;
            $email['price'] = $email['price'] + $candidate->price;
            $email['text'] .= $text;

            $to      = $candidate->email;
            $subject = 'Global People - '. $email['event'];
            $body    = get_field('auto_reply_email',  $post->ID );
            $headers = array('Content-Type: text/html; charset=UTF-8');
             
            wp_mail( $to, $subject, $body, $headers ); 
        }

        $to      = 'info@globalpeople.nl';
        $subject = '#' . $payment->id . ' - ' . $email['event'] . ' - €' . $email['price'];
        $body    = $email['text'];
        $headers = array('Content-Type: text/html; charset=UTF-8');
         
        wp_mail( $to, $subject, $body, $headers );
    }

