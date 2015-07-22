<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ASCE Younger Member Renewal Form</title>

  <!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">

  <!-- If you are using the gem version, you need this only -->
  <link rel="stylesheet" href="css/app.css">

  <script src="js/vendor/modernizr.js"></script>

</head>
<body>
  
  <div class="page">
    <!-- Header Section -->
    <div class="row header">
      <div class="small-12 columns">
        <img src="img/ym-email-header.jpg" class="right">
      </div>
    </div>
    <!-- End Header Section -->

    <!-- Main Section -->
    <div class="row main-content">
      <div class="small-12 columns">
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
        <h1>Remind an ASCE Younger Member Friend to Renew</h1>
      </div>

      <div class="small-12 columns">
        <?php
          // display form if user has not clicked submit
          if (!isset($_POST["submit"])) {
        ?>
        
        <form id="remindForm" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
          <div class="small-12 columns">
            <p>Spread the word by reminding your ASCE friends how important it is to renew their ASCE membership. Encourage everyone in your Section to renew before December 12, 2014 to increase your Section's chances to win $1,000!</p>
          </div>

          <div class="row">

            <div class="small-12 medium-2 columns">&nbsp;</div>

            <div class="small-12 medium-7 columns">
              <div class="row">
                <div class="small-4 columns">
                  <label for="first-name-label" class="right inline">Your First Name</label>
                </div>
                <div class="small-8 columns">
                  <input required id="first-name-label" type="text" name="first" placeholder="ex: John">
                </div>
              </div>

              <div class="row">
                <div class="small-4 columns">
                  <label for="last-name-label" class="right inline">Your Last Name</label>
                </div>
                <div class="small-8 columns">
                  <input required id="last-name-label" type="text" name="last" placeholder="ex: Smith">
                </div>
              </div>

              <div class="row">
                <div class="small-4 columns">
                  <label for="email-label" class="right inline">Your E-mail Address</label>
                </div>
                <div class="small-8 columns">
                  <input id="email-label" type="text" name="from" placeholder="ex: jsmith@example.com">
                </div>
              </div>

              <div class="row">
                <div class="small-4 columns">
                  <label for="recipient-email-label" class="right inline">Who are you asking to renew?</label>
                </div>
                <div class="small-8 columns">
                  <input id="recipient-email-label" type="text" name="to" placeholder="ex: yoursectionfriend@example.com">
                </div>
              </div>

              <div class="row">
                <div class="small-4 columns">
                  &nbsp;
                </div>
                <div class="small-8 columns">
                  <input type="submit" name="submit" value="Submit" class="button small secondary">
                </div>
              </div>
            </div>

            <div class="small-12 medium-3 columns">
              &nbsp;
            </div>
          </div>
        </form>
        <?php 
          } else {  // the user has submitted the form
            // Check if the "from" input field is filled out
            if (isset($_POST["from"])) {
              // Check if "from" email address is valid
              $mailcheck = spamcheck($_POST["from"]);
              if ($mailcheck==FALSE) {
                echo "Invalid input";
              } else {
                $fName = strip_tags($_POST["first"]);
                $lName = strip_tags($_POST["last"]);
                $from = strip_tags($_POST['from']); // sender
                $to = strip_tags($_POST["to"]); // reicipient
                $subject = "Remember to renew your ASCE membership";
                $message = '<html><body>';
                $message .= '<p>Hi,</p><p>'.$fName.' '.$lName.' reminded you to renew your ASCE membership.<br>The Section with the highest percentage of renewed members by December 12, 2014 will win a cash prize of $1,000!</p> <p>Go to <a href="http://www.asce.org/ymfinishline/">www.asce.org/finishline</a> today.</p>';
                $message .= '</body></html>';
                // message lines should not exceed 70 characters (PHP rule), so wrap it
                $message = wordwrap($message, 70);
                $headers = "From: " . $from . "\r\n";
                $headers .= "Reply-To: ". $from . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // send mail
                mail($to,$subject,$message,$headers);
                echo '<p>Thank you for spreading the word and putting your Section one step closer to winning the $1,000 cash prize!</p> <p><a href="http://www.asce.org/ymfinishline/">See your Section&#39;s standing in the race</a>.</p>';
              }
            }
          }
        ?>
      </div>
    </div>
    <!-- End Main Section -->

    <!-- Footer Section -->
    <div class="row footer">
      <div class="small-12 columns">
        <div class="logo-area">
          <a href="http://www.asce.org/" target="_blank"><img src="img/ASCE_logo_sig_REV.png"></a>
        </div>
      </div>
    </div>
    <!-- End Footer Section -->
  </div>

  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script src="js/vendor/jquery.validate.min.js"></script>
  <script>
    $(document).foundation();
    $("#remindForm").validate({
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