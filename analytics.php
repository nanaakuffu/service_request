<?php
  session_start();
  require_once '_functions_.php';
  require_once 'core/init.php';

  login_check();

  _header('Analytics');
  _nav_panel();

  error_reporting(E_ERROR);

  $db = new QueryDB();
  $analytics_array = ['Component', 'Brand', 'Category', 'Status'];
  $graph_array = ['Line', 'Bar', 'Pie', 'Doughnut'];
?>
<div class="container pad-top">
  <div class="w3-panel w3-leftbar w3-rightbar w3-pale-green">
    <h3> Analytics </h3>
  </div>

  <form id="analyticsForm" method="post" >
    <div class="form-row">
      <div class="form-group col-md-6">
        <select class='form-control' name='analytics_type' id='analytics_type' placeholder="Select Analytics Type" required>
          <?php select_data($analytics_array, '', TRUE); ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <select class='form-control' name='graph_type' id='graph_type' placeholder="Select Graph Type" required>
          <?php select_data($graph_array, '', TRUE); ?>
        </select>
      </div>
      <div class="form-group col-md-2">
        <input class='btn btn-primary btn-block shadow' type='submit' name='make_request' value='Draw Graph' />
      </div>
    </div>
  </form>

  <hr />
  <div class='chart-container'>
    <canvas id="graphCanvas"></canvas>
  </div>
</div>

<?php
  logout_modal();
  _footer();
?>
