<?php
    require_once '_functions_.php';

    _header('Request Sent');

    error_reporting(E_ERROR);
?>
<div class='container-fluid'>
  <div class="row">
    <div class='col-md-4'>
      <br />
    </div>
    <div class='col-md-4 login-center login-font'>
      <div class='card shadow-lg mx-auto'>
        <div class='card-header rounded-top card-color'>
          <b style='font-size:20px'> Request Sent! </b>
        </div>
        <div class='card-body'>
          <p> This is to tell you that your request has been successfully sent to the right quarters. </p>
          <p> The IT department will attend to this issue and get back to you as soon as possible. </p>
          <p> Use <span style="font-family: GoogleSans; font-weight: 300;"><?php echo $_SESSION['request_ID']; ?></span> to track the progress of your request. To do this please go to <a href="localhost/service_request/request_tracking.php">THIS PAGE.</a> </p>
        </div>
      </div>
    </div>
    <div class='col-md-4'>
      <br />
    </div>
  </div>
</div>
<hr>

<?php
  unset($_SESSION['request_ID']);
  _footer();
?>
