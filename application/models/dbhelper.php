<?php
class Dbhelper extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function read($table)
    {
        $hasil = $this->db->get($table);
        return $hasil->result();
    }

    function save($table, $data)
    {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    function update($table, $column, $is, $data)
    {
        $this->db->where($column, $is);
        $result = $this->db->update($table, $data);
        return $result;
    }

    function select($table, $column, $id)
    {
        $this->db->where($column, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function delete($table, $column, $is)
    {
        $this->db->where($column, $is);
        $result = $this->db->delete($table);
        return $result;
    }

    public function do_upload()
    {
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['file_name'] = time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            //   var_dump($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            //   var_dump($data);
        }
    }

}
