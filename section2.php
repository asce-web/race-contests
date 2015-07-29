<!DOCTYPE html><!--[if IE 9]><html class="lt-ie10" lang="en"> <![endif]-->
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASCE Section Renewal Form</title>
    <!-- If you are using CSS version, only link these 3 files, you may add app.css to use for your overrides if you like.-->
    <link rel="stylesheet" href="bower_components/normalize.css/normalize.css">
    <link rel="stylesheet" href="bower_components/xmeter/xmeter.css">
    <link rel="stylesheet" href="css/foundation.css">
    <!-- If you are using the gem version, you need this only-->
    <link rel="stylesheet" href="css/app2.css">
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body class="s-younger_member">
    <main>
      <header><img src="img/email-header-section-2016.jpg" class="c-HeaderImg"></header>
      <div class="c-Content">
        <?php
          function spamcheck($field) {
            // Sanitize e-mail address
            $field=filter_var($field, FILTER_SANITIZE_EMAIL);
            // Validate e-mail address
            if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
              return TRUE;
            } else {
              return FALSE;
            }
          }
        ?>
        <h1>Remind an ASCE Section Friend to Renew</h1><?php
          // display form if user has not clicked submit
          if (!isset($_POST['submit'])) {
        ?>
        <form id="remindForm" method="post" action="&lt;?php echo $_SERVER['PHP_SELF'];?&gt;">
          <p>
            Spread the word by reminding your ASCE friends how important it is
            to renew their ASCE membership. Encourage everyone in your Section
            to renew before December 11, 2015 to increase your Section&rsquo;s chances
            to win $1,000!
            
          </p>
          <dl class="o-FlexContainer o-FormField">
            <dt class="o-FormField__Label">
              <label for="first-name-label">Your First Name</label>
            </dt>
            <dd class="o-FormField__Input">
              <input id="first-name-label" required="" type="text" name="first" placeholder="ex: John">
            </dd>
            <dt class="o-FormField__Label">
              <label for="last-name-label">Your Last Name</label>
            </dt>
            <dd class="o-FormField__Input">
              <input id="last-name-label" required="" type="text" name="last" placeholder="ex: Smith">
            </dd>
            <dt class="o-FormField__Label">
              <label for="email-label">Your E-mail Address</label>
            </dt>
            <dd class="o-FormField__Input">
              <input id="email-label" required="" type="email" name="from" placeholder="ex: jsmith@example.com">
            </dd>
            <dt class="o-FormField__Label">
              <label for="recipient-email-label">Who are you asking to renew?</label>
            </dt>
            <dd class="o-FormField__Input">
              <input id="recipient-email-label" required="" type="email" name="to" placeholder="ex: yoursectionfriend@example.com">
            </dd>
            <dt class="o-FormField__Label"></dt>
            <dd class="o-FormField__Input">
              <input type="submit" name="submit" class="button small secondary">
            </dd>
          </dl>
        </form><?php
          } else { // the user has submitted the form
            // Check if the "from" input field is filled out
            if (isset($_POST['from'])) {
              // Check if "from" email address is valid
              $mailcheck = spamcheck($_POST['from']);
              if ($mailcheck==FALSE) {
                echo 'Invalid input';
              } else {
                $fName = strip_tags($_POST['first']);
                $lName = strip_tags($_POST['last']);
                $from = strip_tags($_POST['from']); // sender
                $to = strip_tags($_POST['to']); // reicipient
                $subject = 'Remember to renew your ASCE membership';
                $message = '<html><body>';
                $message .= '<p>Hi,</p><p>'.$fName.' '.$lName.' reminded you to renew your ASCE membership.<br>The Section with the highest percentage of renewed members by December 12, 2014 will win a cash prize of $1,000!</p> <p>Go to <a href="http://www.asce.org/ymfinishline/">www.asce.org/finishline</a> today.</p>';
                $message .= '</body></html>';
                // message lines should not exceed 70 characters (PHP rule), so wrap it
                $message = wordwrap($message, 70);
                $headers = 'From: ' . $from . "\r\n"; // need double-quotes for character escapes
                $headers .= 'Reply-To: '. $from . "\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
                // send mail
                mail($to,$subject,$message,$headers);
                echo '<p>Thank you for spreading the word and putting your Section one step closer to winning the $1,000 cash prize!</p> <p><a href="http://www.asce.org/ymfinishline/">See your Section&#39;s standing in the race</a>.</p>';
              }
            }
          }
        ?>
      </div>
      <footer class="o-LogoArea"><a href="http://www.asce.org/" target="_blank"><img src="img/ASCE_logo_sig_REV.png"></a></footer>
    </main>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/vendor/jquery.validate.min.js"></script>
    <script>
      $(document).foundation();
      $('#remindForm').validate({
        rules: {
          from: {
            required: true,
            email: true
          },
          to: {
            required: true,
            email: true
          }
        }
      });
    </script>
  </body>
</html>