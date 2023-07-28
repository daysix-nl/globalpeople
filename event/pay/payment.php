<?php
    
    if($price > 0)
    {
        global $post;


        require_once __DIR__ . '/../../vendor/autoload.php';
        require_once __DIR__ . '/../../vendor/mollie/mollie-api-php/examples/functions.php';
        // require_once 'mollie-api-php/vendor/autoload.php';
        // require_once 'mollie-api-php/examples/functions.php';

        $mollie = new \Mollie\Api\MollieApiClient();
        // $mollie->setApiKey('live_hgAT2x4Ak6Me98NqS9fWEEk9tHnhJr');
        $mollie->setApiKey('test_JcWqk3QUCxUCdHnRrpFcn9cQmCAwhd');

        $payment = $mollie->payments->create(
        [
            'amount' => 
            [
                'currency' => 'EUR',
                'value' => '' . number_format($price, 2)
            ],
            'description' => $description,
            'redirectUrl' => get_site_url() . '/event/' . $post->post_name . '?success=1',
            'webhookUrl'  => get_site_url() . '/event/' . $post->post_name . '?webhook=1',
        ]);

        $payment = $payment->update();
    }