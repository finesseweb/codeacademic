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
use App\Models\SessionModel;
use App\Models\YearModel;
use App\Libraries\AuthLibrary;

class SessionController extends BaseController
{
	
	public function __construct()
	{
		$this->SessionModel =	new SessionModel();
		$this->YearModel =	new YearModel();
		$this->Session = session();		
		$this->Auth = new AuthLibrary;
		$this->config = config('Auth');
	}
	
	public function index()
	{
		$data = [];
		
		$data = $this->SessionModel->GetData();
		
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('session/index',$data);
		echo view('templates/footer');
		
	}
	
	
	
	public function add()
	{
		
		if ($this->request->getMethod() == 'post') {
			
			
		   $session = $this->request->getPost('session');
		   $year = $this->request->getPost('year');
           $status  = $this->request->getPost('status');

			//SET RULES
			$rules = [
				'session' => 'trim|required|max_length[25]',
				//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|alpha_numeric');
			];
			
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				//SET Data
			$degdata = [
				'session_name' => $this->request->getPost('session'),
				'academic_year_id' => $this->request->getPost('year'),
				'status' => $this->request->getPost('status'),
			];
			
			$getrecords=$this->SessionModel->GetDataBySession(trim($session));
			
			if($getrecords){
			   $this->Session->setFlashdata('message', 'Record Exits!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
				return redirect()->to('/session');

			}
			else {
		        
		        if($this->SessionModel->insert($degdata)){
                $this->Session->setFlashdata('message', 'Added Successfully!');
               $this->Session->setFlashdata('alert-class', 'alert-success');
			   return redirect()->to('/session');

				}
		}
		}
		}
		
		$data['Years'] = $this->YearModel->findAllActiveYear();
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('session/add',$data);
		echo view('templates/footer');
		
	}
	
	
	public function edit($session_id=null)
	{
		
		
		
		if ($this->request->getMethod() == 'post') {
			
			//print_r($this->request); die();
		   $session = $this->request->getPost('session');
		   $year = $this->request->getPost('year');
           $status  = $this->request->getPost('status');

			//SET RULES
			$rules = [
				'session' => 'trim|required|max_length[25]',
				//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|alpha_numeric');
			];
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				
				
				$result = $this->SessionModel->update($session_id, [
                'session_name' => $this->request->getPost('session'),
				'academic_year_id' => $this->request->getPost('year'),
				'status' => $this->request->getPost('status'),
            ]);
			
		if($result){

					return redirect()->to('/session');

				}
		} }
		$result = $this->SessionModel->GetDataBySessionID($session_id);
		//print_r($result); die();
		$data['Years'] = $this->YearModel->findAllActiveYear();
        $data['session'] = $result;
		echo view('templates/header');
		echo view('templates/sidebar');
		echo view('session/edit',$data);
		echo view('templates/footer');
		
	}
public function delete($id=null) {
		
		$year = $this->SessionModel->find($id);

        if (!$year) {
            return redirect()->to('/session')->with('error', 'Session not found');
        }
		$data='deactive';
		$message=' Session Deactiveted';
		//if($status==1) {
			
			//$data='2';
			//$message=' Degree Deactiveted';
		//}else {
		//	$data='1';
		//	$message='Degree Activeted';
		//}-->
		$result = $this->SessionModel->update($id, [
                
				'status' => $data,
				
            ]);
			
			if($result){
                $this->Session->setFlashdata('message', $message);
               $this->Session->setFlashdata('alert-class', 'alert-success');
					return redirect()->to('/session');

				}
	}
	//--------------------------------------------------------------------

}
