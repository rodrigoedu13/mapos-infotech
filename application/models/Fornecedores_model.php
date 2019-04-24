<?php
class Fornecedores_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    
    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idFornecedor','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function getFornecedores(){
        $this->db->order_by('idFornecedor', 'desc');
        $query = $this->db->get('fornecedores');
        return $query->result();
    }

    function getById($id){
        $this->db->where('idFornecedor',$id);
        $this->db->limit(1);
        return $this->db->get('fornecedores')->row();
    }
    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }

    function count($table) {
        return $this->db->count_all($table);
    }
    
    public function getLancamentoByFornecedor($id){
        $this->db->where('fornecedor_id',$id);
        $this->db->limit(1);
        return $this->db->get('lancamentos')->result();
    }
    
    public function autoCompleteFornecedor($q){

        $this->db->select('*');
        $this->db->like('nomeFornecedor', $q);
        $query = $this->db->get('fornecedores');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nomeFornecedor'], 'id'=>$row['idFornecedor']);
            }
            echo json_encode($row_set);
        }
    }

}