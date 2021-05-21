<?php
class Admin_model extends CI_Model 
{       
    public function __construct()
    {
            $this->load->database();
    }

    function delete($table_name = '', $where=array()) {

        return $this->db->delete($table_name,$where);
    }
    
    
    function get_where_pinasc($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('pin_code','ASC');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }
    

    function get_count($table_name = '', $where=array()){

        $rs = $this->db->get_where($table_name,$where);
        return $rs->num_rows();
    }

    function get_where_order($table_name = '', $where = array(), $order = '', $asc ='') {

        $this->db->select('*');
        $this->db->order_by($order,$asc);
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }

    function get_where_asc($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('id','ASC');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }
    
    function get_where($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('id','desc');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }
    
    function get_where_name($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('name_english','ASC');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }
    
    function get_where_array($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('id','ASC');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result_array();
    }

    function get_where_sort($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $this->db->order_by('sort_order','DESC');
        $rs = $this->db->get_where($table_name,$where);
        return $rs->result();
    }

    function get_where_row($table_name = '', $where=array(), $data = '*' ) {

        $this->db->select($data);
        $rs = $this->db->get_where($table_name,$where);
        return $rs->row();
    }

    function update($table_name , $data ,$where){

        $this->db->update($table_name,$data,$where);
        $result = $this->db->get_where($table_name,$where);
        return $result->row();
    }

    function insert($table_name = '', $data=array()) {
        
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
    }     
 }
 ?>