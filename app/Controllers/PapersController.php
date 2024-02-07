<?php

namespace App\Controllers;


use App\Models\PaperModel;
use App\Models\CollegeModel;
use App\Models\CourseModel;

use CodeIgniter\Controller;

class PapersController extends Controller
{
   // private $paperModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->paperModel = new paperModel();
		$this->collegeModel = new CollegeModel();
		$this->courseModel = new CourseModel();
		
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
        $data['papers'] = $this->paperModel->findAllActivePapers();
		//print_r($data); die();
        $this->loadCommonViews('Papers/index', $data);
    }

    public function create()
    {
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		$data['courses'] = $this->courseModel->findAllActiveCourses();
        $this->loadCommonViews('Papers/create', $data);
    }

    public function store()
    {
        //$paperModel = $this->paperModel;
        $validationRules =  $this->paperModel->getValidationRules();

   //  if ($this->validate($validationRules )) {
	//		print_r($this->validator); die();
     //     }      
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			// print_r($this->validator); die();
            // Save caste data
			
			$degdata = [
				'paper_title' => $this->request->getPost('paper_title'),
				'paper_description' => $this->request->getPost('paper_description'),
				'course_id' => $this->request->getPost('course_id'),
				'college_id' => $this->request->getPost('college_id'),
				'credits' => $this->request->getPost('credits'),
				'countable_credit' => $this->request->getPost('countable_credit'),
				'status' => $this->request->getPost('status'),
			];
			  
         // print_r($degdata); die();
			if($this->paperModel->insert($degdata)){
        
            return redirect()->to('/papers')->with('success', 'Paper added successfully');
			}
		   
        }
          
       //	$data['department'] = $this->departmentModel->findAllActiveDepartments();
		 $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		$data['courses'] = $this->courseModel->findAllActiveCourses();
		//$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('Papers/create', $data);
    }

    public function edit($id)
    {
        $data['paper'] = $this->paperModel->find($id);
      // print_r($data); die();
        if (!$data['paper']) {
            return redirect()->to('/papers')->with('error', 'Course not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
		$data['courses'] = $this->courseModel->findAllActiveCourses();
        $this->loadCommonViews('Papers/edit', $data);
    }

    public function update($id)
    {
        $paper = $this->paperModel->find($id);

        if (!$paper) {
            return redirect()->to('/papers')->with('error', 'Course not found');
        }

        $validationRules = $this->paperModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->paperModel->update($id, [
                'paper_title' => $this->request->getPost('paper_title'),
				'paper_description' => $this->request->getPost('paper_description'),
				'course_id' => $this->request->getPost('course_id'),
				'college_id' => $this->request->getPost('college_id'),
				'credits' => $this->request->getPost('credits'),
				'countable_credit' => $this->request->getPost('countable_credit'),
				'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/papers')->with('success', 'Course updated successfully');
        }

        $data['paper'] = $paper;
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
		$data['courses'] = $this->courseModel->findAllActiveCourses();
        $this->loadCommonViews('Papers/edit', $data);
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
