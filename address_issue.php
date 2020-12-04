<?php
  session_start();

  require_once '_functions_.php';
  require_once 'core/init.php';

  login_check();

  _header('Reported Issues');
  _nav_panel();

  error_reporting(E_ERROR);

  $db = new QueryDB();
  if (isset($_GET['fromreport'])) {
    $query = "SELECT *
              FROM request_tbl
              WHERE request_ID='".$_GET['id']."'
              ORDER BY request_date_time ASC";
  } else {
    $query = "SELECT  request_tbl.*,
                      pending_issues.*
              FROM    request_tbl
              INNER JOIN pending_issues
              ON request_tbl.request_ID = pending_issues.request_ID
              WHERE request_tbl.request_ID ='".$_GET['reqid']."'
              ORDER BY pending_issues.report_date ASC";
  }


  // echo $query;
  $reported_array = $db->fetchData($query);
  // echo "<pre>", var_dump($reported_array), "</pre>";
?>
<div class="container pad-top">
  <div class="w3-panel w3-leftbar w3-rightbar w3-pale-green">
    <h3> Service History of <span style="font-family: GoogleSans; font-weight: 300;"><?php echo $reported_array[0]['request_ID']; ?></span> </h3>
  </div>
  <div class="row">
    <div class="col-md-4">
      <form id="issue_form">
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_name']; ?>" placeholder="Capacity Development and Civil Society" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_component']; ?>" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_email']; ?>" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_contact_number']; ?>" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_brand']; ?>" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo $reported_array[0]['request_category']; ?>" readonly>
        </div>
        <div class="form-group">
          <input class="form-control" value="<?php echo date('l, F j, Y', $reported_array[0]['request_date_time']); ?>" readonly>
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="5" readonly><?php echo $reported_array[0]['request_description']; ?></textarea>
        </div>
      </form>
    </div>
    <div class="col-md-8">

      <?php if (isset($_GET['fromreport'])): ?>
        <a class='btn btn-primary shadow' href='reported_issues.php'> Back </a>
      <?php else: ?>
        <?php if ($reported_array[0]['request_status'] == 2): ?>
          <a class='btn btn-primary shadow' href='addressed_issues.php'> Back </a>
        <?php else: ?>
          <a class='btn btn-primary shadow' href='pending_issues.php'> Back </a>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($reported_array[0]['request_status'] != 2): ?>
        <input class='btn btn-primary shadow ml-2' type='button' data-toggle="modal" data-target="#reportModal" value="Submit Service Report" />
      <?php endif; ?>
      <br />
      <div class="table-responsive mt-3">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>History Report</th>
              <th>History Date</th>
            </tr>
          </thead>
          <tfoot class="thead-dark">
            <tr>
              <th>History Report</th>
              <th>History Date</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              if (!isset($_GET['fromreport'])) {
                foreach ($reported_array as $key) {
                  echo "<tr>";
                  foreach ($key as $_key => $value) {
                    if ($_key == 'attending_report') {
                      echo "<td>", $value, "</a></td>";
                    }
                    if ($_key == 'report_date') {
                      echo "<td>", date('l, F j, Y', $value), "</a></td>";
                    }
                  }
                  echo "</tr>";
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Beginning of Cheque Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header w3-panel">
        <h3 class="modal-title" id="reportModalLabel">Service Report</h3>
      </div>

      <div class="modal-body">
          <div class="box-body pad">
            <form name="reportForm" id="reportForm" method="post" enctype="multipart/form-data">
              <input type="hidden" name="request_ID" value="<?php echo $reported_array[0]['request_ID']; ?>" >
              <div class="form-group">
          	  	<label>Service Report: </label>
            		<textarea class="form-control" name="attending_report" rows="5" id='attending_report'></textarea>
              </div>
            </form>
          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="make_request" id="complete" form="reportForm" id="serviceModal" value="Issue Completed" class="btn btn-primary"> Report as Completed </button>
        <button type="submit" name="make_request" id="pending" form="reportForm" id="serviceModal" value="Issue Pending" class="btn btn-primary"> Report as Pending </button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> Cancel </button>
      </div>

    </div>
  </div>
 </div>
 <!-- End of Unit Modal -->

<?php
  logout_modal();
  _footer();
?>
