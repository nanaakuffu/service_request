<?php
    require_once '_functions_.php';
    require_once 'core/init.php';

    _header('Login Form');

    error_reporting(E_ERROR);
?>

<div class='container-fluid'>
  <div class="row">
    <div class='col-md-2'>
      <br />
    </div>
    <div class='col-md-8 center-any'>
      <div class="card-group">
        <div class="card bg-primary">
          <div class="card-body text-center">
            <p class="card-text">Some text inside the first card</p>
          </div>
        </div>
        <div class="card bg-warning">
          <div class="card-body text-center">
            <p class="card-text">Some text inside the second card</p>
          </div>
        </div>
        <div class="card bg-success">
          <div class="card-body text-center">
            <p class="card-text">Some text inside the third card</p>
          </div>
        </div>
        <div class="card bg-danger">
          <div class="card-body text-center">
            <p class="card-text">Some text inside the fourth card</p>
          </div>
        </div>
      </div>
    </div>
    <div class='col-md-2'>
      <br />
    </div>
  </div>
</div>
<hr>

<?php
  // add_footer();
  _footer();
?>
