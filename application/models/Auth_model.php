<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Auth_model extends CI_Model
{
    function insert_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }
    function where_data($table, $data)
    {
        return $this->db->get_where($table, $data, 1);
    }
}
