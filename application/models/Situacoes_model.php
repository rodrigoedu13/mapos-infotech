<?php

class Situacoes_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    function __construct() {
        parent::__construct();
    }

    function getSituacoes() {
        $this->db->order_by('idSituacao', 'desc');
        $query = $this->db->get('situacoes');
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

    function getSituacaoOs($id) {
        $this->db->where('status', $id);
        return $this->db->get('os')->row();
    }

    function getMarcasDropdown() {
        $this->db->select('idMarcas,marca');
        $this->db->order_by('marca');
        $results = $this->db->get('marcas')->result();
        $list = array();
        foreach ($results as $result) {
            $list[$result->idMarcas] = $result->marca;
        }
        return $list;
    }

}
