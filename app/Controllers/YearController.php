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
use App\Models\YearModel;
use App\Libraries\AuthLibrary;

class YearController extends BaseController
{
	
	public function __construct()
	{
		$this->YearModel = new YearModel();
		$this->Session = session();		
		$this->Auth = new AuthLibrary;
		$this->config = config('Auth');
	}
	
	public function index()
	{
		$data = [];
		
		$data = $this->YearModel->GetData();
		
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('Year/index',$data);
		echo view('templates/footer');
		
	}
	
	
	
	public function add()
	{
		
		if ($this->request->getMethod() == 'post') {
			
			
		   $first_name = $this->request->getPost('year');
           $status  = $this->request->getPost('status');

			//SET RULES
			$rules = [
				'year' => 'trim|required|min_length[2]|max_length[25]|alpha_numeric',
				//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|alpha_numeric');
			];
			
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				//SET Data
			$degdata = [
				'year' => $this->request->getPost('year'),
				'status' => $this->request->getPost('status'),
			];
			
			$getrecords=$this->YearModel->GetDataByYear(trim($first_name));
			
			if($getrecords){
			   $this->Session->setFlashdata('message', 'Record Exits!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
				return redirect()->to('/year');

			}
			else {
		        
		        if($this->YearModel->insert($degdata)){
                $this->Session->setFlashdata('message', 'Added Successfully!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
			   return redirect()->to('/year');

				}
		}
		}
		}
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('Year/add');
		echo view('templates/footer');
		
	}
	
	
	public function edit($id=null)
	{
		
		
		
		if ($this->request->getMethod() == 'post') {
			
			//print_r($this->request); die();
		   $year = $this->request->getPost('year');
           $status  = $this->request->getPost('status');

			$rules = [
				'year' => 'trim|required|min_length[2]|max_length[25]|alpha_numeric',
				//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|alpha_numeric');
			];
			
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				
		        $result= $this->YearModel->update($id, [
                'year' => $this->request->getPost('year'),
                 'status' => $this->request->getPost('status'),
            ]);
		if($result){
               $this->Session->setFlashdata('message', 'Update Successfully!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
					return redirect()->to('/year');

				}
		}
		}
		$result = $this->YearModel->find($id);
		
        $data['year'] = $result;
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('year/edit',$data);
		echo view('templates/footer');
		
	}
	
public function delete($id=null) {
		
		$year = $this->YearModel->find($id);

        if (!$year) {
            return redirect()->to('/year')->with('error', 'Year not found');
        }
		$data='deactive';
		$message=' Degree Deactiveted';
		//if($status==1) {
			
			//$data='2';
			//$message=' Degree Deactiveted';
		//}else {
		//	$data='1';
		//	$message='Degree Activeted';
		//}-->
		$result = $this->YearModel->update($id, [
                
				'status' => $data,
				
            ]);
			
			if($result){
                $this->Session->setFlashdata('message', $message);
               $this->Session->setFlashdata('alert-class', 'alert-success');
					return redirect()->to('/year');

				}
	}
	//--------------------------------------------------------------------

}
