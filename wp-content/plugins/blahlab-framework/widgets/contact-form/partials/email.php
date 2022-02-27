<?php

  // $to is provided by the widget setting
  // $to = $_POST['email'];
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $body = stripslashes($_POST['message']);
  $body .= "\n\n sent from " . get_bloginfo('name');
  $from = $_POST['email'];
  // $headers = "Reply-To: " . $from;
  $headers = "From: " . $name . "<" . $from . ">";
  $error_messages = array();
  if( strlen($name) < 1 ) {
    $error_messages[] = "name required";
  }
  if( strlen($body) < 1 ) {
    $error_messages[] = "comment required";
  }
  if( strlen($from) < 1 ) {
    $error_messages[] = "email required";
  }
  // echo $to;
  // echo "\n-----\n";
  // echo $subject;
  // echo "\n-----\n";
  // echo $body;
  // echo "\n-----\n";
  // echo $headers;
  if(sizeof($error_messages) == 0 && mail($to, $subject, $body, $headers)) {
    echo("success");
  } else {
    foreach( $error_messages as $error_message ) {
      echo "$error_message <br />";
    }
  }

?>
