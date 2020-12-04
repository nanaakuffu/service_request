<?php
  require_once '_functions_.php';
  require_once 'core/init.php';

  _header('Track Request');

  error_reporting(E_ERROR);

  if (isset($_POST['_tracking_'])) {
    $db = new QueryDB();
    $query = "SELECT request_tbl.request_ID,
                     request_tbl.request_name,
                     request_tbl.request_status,
                     pending_issues.attending_report,
                     pending_issues.report_date
              FROM   request_tbl
              LEFT JOIN pending_issues
              ON     request_tbl.request_ID = pending_issues.request_ID
              WHERE  request_tbl.request_ID ='".$_POST['search_text']."'
              ORDER BY pending_issues.report_date ASC";
    $tracking_array = $db->fetchData($query);
    $db->destroy();
  }
?>
<div class="container">
  <div class="row">
    <div class="col-md-2">
      <br />
    </div>
    <?php if (!isset($_POST['_tracking_']) or strlen($_POST['search_text']) == 0): ?>
      <div class="col-md-8 login-center">
        <form method="post" action="request_tracking.php">
          <h2 class="w3-panel w3-leftbar w3-rightbar w3-pale-green text-center"> Request Tracking </h2>
          <div class="input-group input-group-lg shadow">
            <input class="form-control " name="search_text" placeholder="Please input your request ID to track your request status." autofocus>
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" name="_tracking_"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    <?php else: ?>
      <div class="col-md-8" style="margin-top: 50px">
        <form method="post" action="request_tracking.php" >
          <h2 class="w3-panel w3-leftbar w3-rightbar w3-pale-green text-center"> Request Tracking </h2>
          <div class="input-group input-group-lg shadow-sm">
            <input class="form-control " name="search_text" value="<?php echo $_POST['search_text']; ?>"
                placeholder="Please input your request ID to track your request status."
                <?php echo (is_null($tracking_array)) ? "autofocus" : "" ; ?> >
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" name="_tracking_"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
        <?php if (is_null($tracking_array)): ?>
          <br />
          <h4 class="text-center"> No records found. Possibly the request ID does not exist. </h4>
        <?php else: ?>
          <?php
            switch ($tracking_array[0]['request_status']) {
              case 0:
                $status = "Received";
                break;

              case 1:
                $status = "Pending";
                break;

              default:
                $status = "Completed";
                break;
            }
          ?>
          <div class="clearfix mt-2 mb-2">
            <h4 class="float-left"> Request by: <span style="font-family: GoogleSans; font-weight: 300;"> <?php echo $tracking_array[0]['request_name']; ?> </span></h4>
            <h4 class="float-right"> Request status: <span style="font-family: GoogleSans; font-weight: 300;"> <?php echo $status; ?> </span></h4>
          </div>

          <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
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
                  foreach ($tracking_array as $key) {
                    echo "<tr>";
                    foreach ($key as $_key => $value) {
                      if (!is_null($value)) {
                        if ($_key == 'attending_report') {
                          echo "<td>", $value, "</a></td>";
                        }
                        if ($_key == 'report_date') {
                          echo "<td>", date('l, F j, Y', $value), "</a></td>";
                        }
                      }
                    }
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="col-md-2">
      <br />
    </div>
  </div>
  <br />
</div>
<?php
  _footer();
?>
