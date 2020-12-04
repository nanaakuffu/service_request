<?php
  /**
   *
   */

  class Core{
    protected $db, $result;

    private $rows;

    public function __construct() {
      $this->db = new mysqli('localhost', 'root', '', 'service_db');
      if ($this->db->connect_errno) {
        printf("Database connection failed: %s", $this->db->connect_error);
      }
      $this->db->set_charset('utf8');
    }

    public function query($sql_string) {
      $this->result = $this->db->query($sql_string);
    }

    public function get_rows() {
      for ($i=1; $i <= $this->db->affected_rows; $i++) {
        $this->rows[] = $this->result->fetch_assoc();
      }
      return $this->rows;
    }

    // public function num_of_rows($sql_string) {
    //   $this->query($sql_string);
    //   return count($this->get_rows());
    // }

    public function destroy() {
      return $this->db->close();
    }

  }

?>
