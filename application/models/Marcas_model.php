<?php

class Marcas_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    function __construct() {
        parent::__construct();
    }

    function getMarcas() {
        $this->db->order_by('idMarcas', 'desc');
        $query = $this->db->get('marcas');
        return $query->result();
    }

    function getById($id) {
        $this->db->where('idMarcas', $id);
        $this->db->limit(1);
        return $this->db->get('marcas')->row();
    }

    function add($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    function edit($table, $data, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }

        return FALSE;
    }

    function delete($table, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    function getMarcasOs($id) {
        $this->db->where('marcas_id', $id);
        return $this->db->get('os')->row();
    }

    function getMarcasDropdown() {
        $this->db->select('idMarcas,marca');
        $results = $this->db->get('marcas')->result();
        $list = array();
        foreach ($results as $result) {
            $list[$result->idMarcas] = $result->marca;
        }
        return $list;
    }

}
