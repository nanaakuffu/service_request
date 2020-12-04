<?php
  /**
   *
   */
  class QueryDB extends Core
  {
    public function fetchData($query) {
      // query db
      $this->query($query);

      // Get the data from the query
      return $this->get_rows();
    }

    public function dataExists($table, $field, $field_value) {
      $sql = "SELECT $field FROM $table WHERE $field="."'".$field_value."'";
      return (is_null($this->fetchData($sql))) ? FALSE : TRUE;
    }

    public function fetchFields($table) {
      $field_names = $this->fetchData("SHOW COLUMNS FROM $table");
      foreach ($field_names as $_key) {
        foreach ($_key as $key => $value) {
          if ($key == 'Field') {
            $field_list[] = $value;
          }
        }
      }
      return $field_list;
    }

    public function saveData($_data_, $table_name) {
      if (!is_array($_data_)) {
        return FALSE;
      }

      foreach($_data_ as $field => $value) {
        $_data_[$field] = $this->db->real_escape_string(htmlentities($value));

        $field_array[] = $field;
        $value_array[] = $value;
      }

      $fields = implode(",", $field_array);
      $values = implode('","', $value_array);
      $save_query = "INSERT INTO $table_name ($fields) VALUES (\"$values\")";

      if ($this->db->query($save_query)) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    public function updateData($_data_, $table_name, $primary_key_field, $primary_key_value) {
      $update_query = "UPDATE $table_name SET ";

      if (is_array($_data_)) {
        foreach ($_data_ as $field => $value) {
          $value = $this->db->real_escape_string(htmlentities($value));
          $update_query .= "$field ="."'".$value."'".", ";
        }
        $update_query = substr($update_query, 0, strlen($update_query) - 2)." WHERE $primary_key_field = "."'".$primary_key_value."'";
        if ($this->db->query($update_query)) {
          return TRUE;
        } else {
          return FALSE;
        }
      } else {
        return FALSE;
      }
    }

    public function deleteData($table_name, $primary_key_field, $primary_key_value) {
      $delete_query = "DELETE FROM $table_name WHERE $primary_key_field= "."'".$primary_key_value."'";

      if ($result = $this->query($delete_query)) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    public function get_data_array($table, $field, $distinct = FALSE)
    {
      $data_array = [];
      $sql = ($distinct) ? "SELECT DISTINCT $field FROM $table " : "SELECT $field FROM $table" ;

      $data = $this->fetchData($sql);
      foreach ($data as $key) {
        foreach ($key as $_key => $_value) {
          $data_array[] = $_value;
        }
      }
      return $data_array;
    }
  }

?>
