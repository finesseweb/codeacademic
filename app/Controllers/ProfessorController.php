<?php

namespace App\Controllers;

use App\Models\ProfessorModel;
use App\Models\DepartmentModel;
use CodeIgniter\Controller;

class ProfessorController extends Controller
{
    private $departmentModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->departmentModel = new DepartmentModel();
		$this->professorModel = new ProfessorModel();
        
		
    }

    // Common method to load header, sidebar, and footer views
    private function loadCommonViews($viewName, $data = [])
    {
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view($viewName, $data);
        echo view('templates/footer', $data);
    }

    public function index()
    {
        $data['professors'] = $this->professorModel->findAllActiveProfessor();
		//print_r($data); die();
        $this->loadCommonViews('Professor/index', $data);
    }

    public function create()
    {
        
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Professor/create', $data);
    }

    public function store()
    {
        $professorModel = $this->professorModel;
        $validationRules = $professorModel->getValidationRules();
//print_r($validationRules); die();

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $professorModel->save([
                'first_name' => $this->request->getPost('first_name'),
				'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
				'department_id' => $this->request->getPost('department_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/professor')->with('success', 'Professor added successfully');
        }
          
       	$data['department'] = $this->departmentModel->findAllActiveDepartments();
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('Professor/create', $data);
    }

    public function edit($id)
    {
        $data['professor'] = $this->professorModel->find($id);
      // print_r($data); die();
        if (!$data['professor']) {
            return redirect()->to('/courses')->with('error', 'Professor not found');
        }

        //$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Professor/edit', $data);
    }

    public function update($id)
    {
        $professor = $this->professorModel->find($id);

        if (!$professor) {
            return redirect()->to('/professor')->with('error', 'Professor not found');
        }

        $validationRules = $this->professorModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->professorModel->update($id, [
                'first_name' => $this->request->getPost('first_name'),
				'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
				'department_id' => $this->request->getPost('department_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/professor')->with('success', 'Professor updated successfully');
        }

        $data['professor'] = $professor;
       // $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Professor/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/courses')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/courses')->with('success', 'Course deleted successfully');
    }
}
