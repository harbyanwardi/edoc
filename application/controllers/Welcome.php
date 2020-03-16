<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }

    }

	public function index()
	{
        $id = 1; //KAS BESAR
       $data = $this->M_data->showKas($id);
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			// 'footer'=> $this->footer(),
            'data' => $data,
            
        );
        $this->load->view('data',$show);
        // $this->load->view('data');
	}
    
 //    public function add()
	// {
	// 	$show = array(
	// 		'nav'=> $this->nav(),
	// 		'footer'=> $this->footer(),
			
	// 	);
	// 	$this->load->view('product/v_addform',$show);
	// }

    public function add(){
        $this->form_validation->set_rules('amount', 'amount', 'required|integer');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if($this->form_validation->run()==FALSE){
            
            $this->flashdata_failed();
        }else{
            $data=array(
                "amount"=> $_POST['amount'],
                "kas_type"=>$_POST['kas_type'],
                "created_by" => $this->session->userdata('username'),
                "created_at" => $date,
            );
            $this->db->insert('mst_kas',$data);
           $this->flashdata_succeed();
        }
    }

	public function do_insert()
	{
		
		$product_name = $_POST['product_name'];
        $qty = $_POST['qty'];
     
        $data_insert = array(
            'product_name' => $product_name,
            'qty' => $qty,
        );
        $res = $this->M_data->InsertData('product',$data_insert);
        if($res>=1){
            $this->flashdata_succeed();
        }
        else{
            $this->flashdata_failed();
        }
 
    }

    public function delete($id){
		$where = array('id' => $id);
		$res = $this->M_data->DeleteData('mst_kas',$where);
		if($res>=1){
			$this->flashdata_succeed();
	   }
       else{
            $this->flashdata_failed();
        }
    }

	public function do_edit($id){
        $get = $this->M_data->GetData("product ","where id = '$id'");
        $data = array(
        	'nav'=> $this->nav(),
			'footer'=> $this->footer(),
            'id' => $id,
            'product_name' => $get[0]['product_name'] ,
            'qty' => $get[0]['qty'],

        );
        
        $this->load->view('product/v_editform',$data);
    }

    public function do_update(){
            $id = $this->input->post('kas_id');
        
        $get = $this->M_data->GetData2("mst_kas ","where id = '$id'")->row();
        $where = array('id' => $id);
        $data = array(
            'amount' => $this->input->post('amount'),
            'kas_type' =>$this->input->post('kas_type'),
            "created_by" => $this->session->userdata('username'),
            
        );
        
        $res = $this->M_data->UpdateData('mst_kas',$data,$where);
        if($res>=1){
            $this->flashdata_succeed();
        }
        else{
            $this->flashdata_failed();
        }
    }

    public function header(){
		$data = array();
		$show = $this->load->view('component/header',$data,TRUE);
		return $show;
    }

    public function navbar(){
		$data = array();
		$show = $this->load->view('component/navbar',$data,TRUE);
		return $show;
    }

    
    public function sidebar(){
		$data = array();
		$show = $this->load->view('component/sidebar',$data,TRUE);
		return $show;
    }
    
	public function footer(){
		$data = array();
		$show = $this->load->view('component/footer',$data,TRUE);
		return $show;
	}


    public function flashdata_succeed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
                redirect('/');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('/');
    }
}

