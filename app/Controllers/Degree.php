<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

 namespace App\Controllers;
use App\Models\DegreeModel;
use App\Libraries\AuthLibrary;

class Degree extends BaseController
{
	
	public function __construct()
	{
		$this->DegreeModel =	new DegreeModel();
		$this->Session = session();		
		$this->Auth = new AuthLibrary;
		$this->config = config('Auth');
	}
	
	public function index()
	{
		$data = [];
		
		$data = $this->DegreeModel->GetData();
		
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('degree/index',$data);
		echo view('templates/footer');
		
	}
	
	
	
	public function add()
	{
		
		if ($this->request->getMethod() == 'post') {
			
			
		   $first_name = $this->request->getPost('degree');
           $status  = $this->request->getPost('status');

			//SET RULES
			$rules = [
				'degree' => 'trim|required|min_length[2]|max_length[25]|alpha_numeric',
				//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|alpha_numeric');
			];
			
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				//SET Data
			$degdata = [
				'name' => $this->request->getPost('degree'),
				'status' => $this->request->getPost('status'),
			];
			
			$getrecords=$this->DegreeModel->GetDataByDegree(trim($first_name));
			
			if($getrecords){
			   $this->Session->setFlashdata('message', 'Record Exits!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
				return redirect()->to('/degree');

			}
			else {
		        
		        if($this->DegreeModel->insert($degdata)){
                $this->Session->setFlashdata('message', 'Added Successfully!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
			   return redirect()->to('/degree');

				}
		}
		}
		}
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('degree/add');
		echo view('templates/footer');
		
	}
	
	
	public function edit($id=null)
	{
		
		
		
		if ($this->request->getMethod() == 'post') {
			
			//print_r($this->request); die();
		   $first_name = $this->request->getPost('degree');
           $status  = $this->request->getPost('status');

			//SET RULES
			$data = [
				'name' => $first_name,
				'status' => $status,
			];
			
		$result = $this->DegreeModel->add($data);
		if($result){

					return redirect()->to('/index');

				}
		}
		$result = $this->DegreeModel->find($id);
		
        $data['degree'] = $result;
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('degree/edit',$data);
		echo view('templates/footer');
		
	}

	//--------------------------------------------------------------------

}
