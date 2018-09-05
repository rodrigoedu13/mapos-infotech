<?php

class Equipamentos_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    function __construct() {
        parent::__construct();
    }

    function getEquipamentos() {
        $this->db->order_by('idEquipamentos', 'desc');
        $query = $this->db->get('equipamentos');
        return $query->result();
    }

    function getById($id) {
        $this->db->where('idEquipamentos', $id);
        $this->db->limit(1);
        return $this->db->get('equipamentos')->row();
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
    
    function getEquipamentosOs($id){
        $this->db->where('equipamentos_id',$id);
        return $this->db->get('os')->row();
    }

    function count($table) {
        return $this->db->count_all($table);
    }

}
