<?php

$pp_hostname = "www.paypal.com"; // Change to www.sandbox.paypal.com to test against sandbox


// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';
 
$tx_token = $_GET['tx'];
$auth_token = "ZHGsZVOOCPq7rYqAfeSCT6_AXJS3rXghftl_QCmZlkEXebqAC58AnkJIzd4";
$req .= "&tx=$tx_token&at=$auth_token";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
//if your server does not bundled with default verisign certificates.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
$res = curl_exec($ch);
curl_close($ch);

//var_dump($auth_token);

if(!$res){
    //HTTP ERROR
} else {
     // parse the data
    $lines = explode("\n", $res);
    $keyarray = array();
    if (strcmp ($lines[0], "SUCCESS") == 0) {
        for ($i=1; $i<count($lines);$i++){
          list($key,$val) = explode("=", $lines[$i]);
          $keyarray[urldecode($key)] = urldecode($val);
      }
      // check the payment_status is Completed
      // check that txn_id has not been previously processed
      // check that receiver_email is your Primary PayPal email
      // check that payment_amount/payment_currency are correct
      // process payment
      $firstname = $keyarray['first_name'];
      $lastname = $keyarray['last_name'];
      $amount = $keyarray['mc_gross'];
       
      //var_dump($keyarray);

      echo ("<h3>Thank you for your purchase!</h3>");
       
      echo ("<h4>Payment Details</h4>\n");
      echo ("<p>Name: $firstname $lastname<br/>\n");
      echo ("Amount: £$amount</p><ul>\n");
      for ($i = 1; $i <= $keyarray['num_cart_items']; $i++) {
        echo '<li>'. $keyarray['item_name' . $i];
        echo ' x ' . $keyarray['quantity' . $i];
        echo ' @ £' . $keyarray['mc_gross_' . $i] . '</li>';
      }
      echo '</ul>';
    }
    else if (strcmp ($lines[0], "FAIL") == 0) {
        // log for manual investigation
    }
}
 
?>

Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br/>
You may log into your account at <a href='https://www.paypal.com' target="_blank">www.paypal.co.uk</a> to view details of this transaction.<br/>

<script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

  try {
    var pageTracker = _gat._getTracker("<?php echo $tracking_code; ?>");
    pageTracker._trackPageview();
    pageTracker._addTrans(
      "<?php echo $keyarray['txn_id']; ?>", // Order ID
      "", // Affiliation
      "<?php echo $amount; ?>", // Total
      "0", // Tax
      "0", // Shipping
      "<?php echo $keyarray['address_city']; ?>", // City
      "", // State
      "<?php echo $keyarray['address_country']; ?>" // Country
    );
    

    <?php for ($i = 1; $i <= $keyarray['num_cart_items']; $i++) { ?>
        pageTracker._addItem(
          "<?php echo $keyarray['txn_id']; ?>", // Order ID
          "", // SKU
          "<?php echo $keyarray['item_name'.$i]; ?>", // Product Name 
          "", // Category
          "<?php echo $keyarray['mc_gross_' . $i]; ?>", // Price
          "<?php echo $keyarray['quantity' . $i]; ?>" // Quantity
        );
    <?php } ?>
    pageTracker._trackTrans();
  } catch(err) {}
</script>

<!-- Google Code for New Website Conversion Tracking From Google Grants Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 964178591;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "OWc7CLWtklcQn-XgywM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/964178591/?label=OWc7CLWtklcQn-XgywM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<?php $quantity = $keyarray['quantity1']; ?>
<?php $amount = $keyarray['mc_gross_1']; ?>

<!-- Facebook Conversion Code for New Website Conversion Tracking -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6021614408864', {'value':'<?php echo $amount; ?>','currency':'GBP'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6021614408864&amp;cd[value]=<?php echo $amount; ?>&amp;cd[currency]=GBP&amp;noscript=1" /></noscript>

<!-- Twitter -->
​​<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">
twttr.conversion.trackPid('l5og8', { tw_sale_amount: <?php echo $amount; ?>, tw_order_quantity: <?php echo $quantity; ?> });</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l5og8&p_id=Twitter&tw_sale_amount=<?php echo $amount; ?>&tw_order_quantity=<?php echo $quantity; ?>" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l5og8&p_id=Twitter&tw_sale_amount=<?php echo $amount; ?>&tw_order_quantity=<?php echo $quantity; ?>" /></noscript>
