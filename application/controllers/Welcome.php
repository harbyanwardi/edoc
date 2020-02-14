<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
    //    $data = $this->M_data->showdata("product");
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			// 'footer'=> $this->footer(),
            // 'data' => $data,
            
        );
        $this->load->view('data',$show);
        // $this->load->view('data');
	}
    
    public function add()
	{
		$show = array(
			'nav'=> $this->nav(),
			'footer'=> $this->footer(),
			
		);
		$this->load->view('product/v_addform',$show);
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

    public function do_delete($id){
		$where = array('id' => $id);
		$res = $this->M_data->DeleteData('product',$where);
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
            $id = $this->input->post('id');
        
        $get = $this->M_data->GetData2("product ","where id = '$id'")->row();
        $where = array('id' => $id);
        $data = array(
            'product_name' => $this->input->post('product_name'),
            'qty' =>$this->input->post('qty'),
            
        );
        
        $res = $this->M_data->UpdateData('product',$data,$where);
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
                redirect('Welcome/index');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('C_product/index');
    }
}

