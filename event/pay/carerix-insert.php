<?php

use Carerix\Api\Rest\Entity\CRCampaign;
use Carerix\Api\Rest\Entity\CRDataNode;
use Carerix\Api\Rest\Entity\CRAttachment;
use Carerix\Api\Rest\Entity\CREmployee;
use Carerix\Api\Rest\Entity\CRUser;
use Carerix\Api\Rest\Entity\CRToDoUser;
use Carerix\Api\Rest\Entity\CREmployeeEducation;

global $post;
global $wpdb;

if($price <= 0) {
     echo "<script>console.log('Debug Objects:  ssssssss ' );</script>";

    $wpdb->update($wpdb->base_prefix.'event_purchases', array('completed' => 1), array('payment' => $pid));

    if (!$campaign = CRCampaign::find(get_field('campaign_id'))) {
        exit;
    }

    $candidates = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."event_purchases WHERE completed = 1 AND payment = '" . $pid . "'");
    //$candidates = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."event_purchases WHERE payment = '" . $pid . "'");

    $email = [];
    $email['event'] = '';
    $email['price'] = 0;
    $email['text'] = '';

    foreach ($candidates as $candidate) {
        // print_r($candidate);
        // exit;
        $user = new CREmployee();
        $user->setFirstName($candidate->voornaam);
        $user->setLastName($candidate->achternaam);
        $user->setEmailAddress($candidate->email);
        $user->setPhoneNumber($candidate->telefoonnummer);
        if (isset($_POST['gdpr'])) {
            $consent_stage_node = new CRDataNode();
            $consent_stage_node->setAttributes(array('key' => 'tags', 'value' => 'ConsentGivenTag'));
            $user->setToConsentStageNode($consent_stage_node);
            $user->setPrivacyApprovalDate(date('Y-m-d 12:00:00', time()));
        }

        if ($candidate->opleidingsniveau) {
            $node = CRDataNode::find($candidate->opleidingsniveau);
            $education = new CREmployeeEducation();
            $education->setToLevel1Education1($node);
            $user->setEducations($education);
        }

        if ($candidate->werkvelden) {
            $node = CRDataNode::find($candidate->werkvelden);
            $user->setToFunction1Level1Node($node);
        }

        $user->setEducationInformation($candidate->opleiding);

        /* CV Upload */
        if ($candidate->cv) {
            $cv = file_get_contents(__DIR__ . '/../../../../..' . $candidate->cv, true);
            $cv = base64_encode($cv);

            $attachment = new CRAttachment(array(
                'content' => $cv,
                'owner' => false,
                'filePath' => pathinfo($candidate->cv)['filename'] . '.' . pathinfo($candidate->cv)['extension'],
                'label' => 'Candidate CV',
            ));

            $attachment->save();
            $user->setAttachments($attachment);
        }

        /* CV Upload */
        $saved = $user->save();
        $user = CREmployee::find($saved->getId());

        $toDoUser = new CRToDoUser();
        $toDoUser->setIsActive(1);
        $toDoUser->setToUser($user->getToUser());

        $realUser = CRUser::find($user->getToUser()->getId());
        $realUser->setJobTitle($candidate->studentenvereniging . ' | ' . $candidate->gevonden . ' | ' . $candidate->functie);
        // $realUser->setJobTitle($candidate->bedrijf . ' | ' . $candidate->functie);
        $realUser->save();

        $campaign->setToDoUsers($toDoUser);
        $campaign->save();

        $text = '[' . $candidate->voornaam . ' ' . $candidate->achternaam . ' - Email: ' . $candidate->email . ' - Price/Type: ' . $candidate->type . ' - €' . $candidate->price . ' - Opleidingsniveau: ' . $candidate->opleidingsniveau . ' - Opleiding: ' . $candidate->opleiding . ' - Werkvelden: ' . $candidate->werkvelden . ' - Studentenvereniging: ' . $candidate->studentenvereniging . ' - Gevonden: ' . $candidate->gevonden . ' - Functie: ' . $candidate->functie . ' - CV: https://globalpeople.nl/' . $candidate->cv . ']';

        $email['event'] = $candidate->event;
        $email['price'] = $email['price'] + $candidate->price;
        $email['text'] .= $text;

        $to = $candidate->email;
        $subject = 'Global People - ' . $email['event'];
        $body = get_field('auto_reply_email', $post->ID);
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($to, $subject, $body, $headers);
    }
    $to = 'info@globalpeople.nl';
    $subject = '#' . $pid . ' - ' . $email['event'] . ' - €' . $email['price'];
    $body = $email['text'];
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);
}