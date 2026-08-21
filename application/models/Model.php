<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *@author:    niyodon paci
 * Email:    niyodonpaci@gmail.com
 * Gitgub:    https://github.com/niyodon3564
*/
class Model extends CI_Model{


    function create($table, $data) {
        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;
    }

    function read($table, $criteres = array(), $order_by_column = null, $order = 'DESC') {
    
    if (!empty($criteres)) {
        $this->db->where($criteres);
    }

    if (!empty($order_by_column)) {
        $this->db->order_by($order_by_column, $order);
    }

    $query = $this->db->get($table);
    return $query->result_array();
}

    function readWhereIdIn($table, $ids = array()) {
        $this->db->where('isDeleted !=', 1);
        $this->db->where('isApproved !=', 0);
        $this->db->where_in('idAccount', $ids);
        $query = $this->db->get($table);
        return $query->result_array();
    }



    function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }


    function updateWhereIdIn($table, $ids = array()) {
    // $this->db->where('isDeleted !=', 1);
    date_default_timezone_set('Africa/Bujumbura');
    $date=date('Y-m-d:H:i:s');
    $this->db->where_in('idAccount', $ids);
    $query = $this->db->get($table);
    $result = $query->result_array();

    // Update isApproved to 0 for matching IDs
    $matchedIds = array_column($result, 'idAccount');
    $updateIds = array_intersect($ids, $matchedIds);

    if (!empty($updateIds)) {
        $this->db->where_in('idAccount', $updateIds);
        $this->db->update($table, array('isTreated' => 1,'dateTreated'=>$date));
    }

    return $result;
}



    function updateReturnAffectedRow($table, $criteres, $data) {
        $this->db->where($criteres);
        $this->db->update($table, $data);
        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            $query = $this->db->get_where($table, $criteres);
            return $query->row_array();
        } else {
            return null;
        }
    }


    public function login($email, $password) {
        if($email && $password) {
          $sql = "SELECT * FROM users WHERE email = ? AND status = 'active'";
          $query = $this->db->query($sql, array($email));

          if($query->num_rows() == 1) {
            $result = $query->row_array();

            // Mot de passe haché (bcrypt)
            if(password_verify($password, $result['password'])) {
              return $result;
            }

            // Compatibilité ancien mot de passe en clair : vérifier puis rehacher
            if(hash_equals($result['password'], $password)) {
              $this->db->where('id', $result['id']);
              $this->db->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
              return $result;
            }

            return false;
          }
          else {
            return false;
          }
        }

        return false;
    }

    public function check_email($email){ // it checks if a specific email exist 
      if($email) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $query = $this->db->query($sql, array($email));
        $result = $query->num_rows();
        return ($result == 1) ? true : false;
      }

      return false;
    }
    
    function delete($table,$criteres){
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }

    function readOne($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function readQuery($query,$bindings = null){
      if (!is_null($bindings) && !empty($bindings)) {
            $query=$this->db->query($query, $bindings);
        } else {
            $query=$this->db->query($query);
        }

      if ($query) {
         return $query->result_array();
      }
    }

    function readQueryOne($query,$bindings = null){
      
      if (!is_null($bindings) && !empty($bindings)) {
            $query=$this->db->query($query, $bindings);
        } else {
            $query=$this->db->query($query);
        }
      if ($query) {
        return $query->row_array();
      }
    }


    function createLastId($table, $data) {
        $query = $this->db->insert($table, $data);
       if ($query) {
            return $this->db->insert_id();
        }
    }

    function get_setting($key, $default = null) {
        if (!$this->db->table_exists('settings')) {
            return $default;
        }

        $query = $this->db->get_where('settings', array('key' => $key));
        $row = $query->row_array();

        return (!empty($row)) ? $row['value'] : $default;
    }












   



    

 

  }  
 

