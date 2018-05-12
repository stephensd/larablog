<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
   <h2>Hi Darren,</h2>
   <p>You have recieved a mail from {{ $name }} at larablog.app</p>
   <h5>{!! $subject !!}</h5>
   <p>{!! $mail_message !!}</p>
   <hr>
  </body>
</html>
