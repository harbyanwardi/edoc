<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function showdata($table){
		
	    $this->db->order_by('id', 'desc');
		$data = $this->db->get($table);
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function GetData($tableName,$where="")
	{
		$data = $this->db->query('select * from '.$tableName.$where);
		return $data->result_array();
	}

	public function GetData2($tableName,$where="")
	{
		$data = $this->db->query('select * from '.$tableName.$where);
		return $data;
	}
	
	public function InsertData($tabelName,$data){
		$res = $this->db->insert($tabelName,$data);
		return $res;
	}

	public function DeleteData($tabelName,$where){
		$res = $this->db->delete($tabelName,$where);
		return $res;
	}
	
	public function UpdateData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}

	

}
