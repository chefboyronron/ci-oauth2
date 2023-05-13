<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_blogs()
    {
        $query = $this->db->get('blog');
        $result = $query->result_array();
        return $result;
    }

}