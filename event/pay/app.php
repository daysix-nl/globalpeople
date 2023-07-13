<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
 * Check if required keys are met
 */

include 'required.php';

/*
 * Build tickets availability
 */

include 'tickets-availability.php';

/*
 * Build tickets array
 */

include 'tickets-array.php';

/*
 * Process tickets data
 */

include 'tickets-data.php';

/*
 * Check if there is enough tickets available
 */

include 'tickets-check.php';

/*
 * CV Upload if exist
 */

include 'cv-upload.php';

/*
 * Create price
 */

include 'price.php';

/*
 * Create description
 */

include 'description.php';

/*
 * Create payment
 */

include 'payment.php';

/*
 * Create records in database
 */

include 'records.php';

/*
 * Add to carerix
 */

include 'carerix-insert.php';

/*
 * Redirect for payment
 */


if ($price > 0) {
  header('Location: ' . $payment->getCheckoutUrl(), true, 303);
} else {
  header('Location: ' . get_site_url() . '/event/' . $post->post_name . '?success=1');
}
