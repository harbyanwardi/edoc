<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_project extends CI_Controller {

	function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }

    }

	public function index()
	{
        
       $data = $this->M_data->showdata("mst_project");
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			// 'footer'=> $this->footer(),
            'data' => $data,
            
        );
        $this->load->view('project/index',$show);
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
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if($this->form_validation->run()==FALSE){
            
            $this->flashdata_failed();
        }else{
            $data=array(
                "project_name"=> $_POST['project_name'],
                "description"=>$_POST['description'],
                "pic"=>$_POST['pic'],
                "estimate_start"=>$_POST['estimate_start'],
                "estimate_end" => $_POST['estimate_end'],
                "created_by" => $this->session->userdata('username'),
                "created_at" => $date,
            );
            $this->db->insert('mst_project',$data);
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

	

    public function do_update(){
            $id = $this->input->post('project_id');
        
        $get = $this->M_data->GetData2("mst_project ","where id = '$id'")->row();
        $where = array('id' => $id);
        $data = array(
            'project_name' => $_POST['project_name'],

            'description' =>$_POST['description'],
            'pic' =>$_POST['pic'],
            'estimate_start' =>$_POST['estimate_start'],
            'estimate_end' =>$_POST['estimate_end'],
            "created_by" => $this->session->userdata('username'),
            
        );
        
        $res = $this->M_data->UpdateData('mst_project',$data,$where);
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
                redirect('/C_project');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('/C_project');
    }
}

