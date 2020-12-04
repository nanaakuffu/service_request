<?php
  session_start();
  require_once '_functions_.php';
  require_once 'core/init.php';

  login_check();

  _header('Pending Issues');
  _nav_panel();

  error_reporting(E_ERROR);

  $db = new QueryDB();
  $query = 'SELECT  request_ID,
                    request_name,
                    request_component,
                    request_brand,
                    request_category,
                    request_date_time
            FROM    request_tbl
            WHERE   request_status = 1
            ORDER BY request_date_time ASC';
  $reported_array = $db->fetchData($query);
?>
<div class="container pad-top">
  <div class="w3-panel w3-leftbar w3-rightbar w3-pale-green">
    <h3> All Pending Issues </h3>
  </div>
  <div class="table-reponsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
      <thead class="thead-dark">
        <tr>
          <th>Request By</th>
          <th>Component</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Date and Time Requested</th>
        </tr>
      </thead>
      <tfoot class="thead-dark">
        <tr>
          <th>Request By</th>
          <th>Component</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Date and Time Requested</th>
        </tr>
      </tfoot>
      <tbody>
        <?php
          foreach ($reported_array as $key) {
            echo "<tr>";
            foreach ($key as $_key => $value) {
              if ($_key != 'request_ID' and $_key != 'pending_ID') {
                if ($_key == 'request_date_time') {
                  echo "<td><a href='address_issue.php?reqid={$key['request_ID']}'>", date('l, F j, Y', $value), "</a></td>";
                } else {
                  echo "<td><a href='address_issue.php?reqid={$key['request_ID']}'>", $value, "</a></td>";
                }
              }
            }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
  logout_modal();
  _footer();
?>
