<?php # Script 5.4 - index.php

/* 
 *	This is the main page.
 *	This page doesn't do much.
 */

// Require the configuration file before any PHP code:
require_once ('./includes/config.inc.php');

// Include the header file:
include_once ('./includes/header.html');

// Page-specific content goes here:
echo '<h1>[WoW] World of Widgets</h1>
<p>This is an online widget shopping site at your disposal. There are many widgets sold on this platform </p>
<p>On the side bar are some categories you can browse and check out, as you purchase online without human intervention </p>
<h1>[WoW] World of Widgets</h1>
<p>The platform has been developed to meet most of your needs. Please make the most use of this and recommend these to your friends</p>
<p>Please feel free to contact us in case of any incovenience. and if you need some help</p>';

// Include the footer file to complete the template:
include_once ('./includes/footer.php');

?>
