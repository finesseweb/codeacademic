<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\DepartmentModel;
use App\Models\CollegeModel;
use App\Models\DegreeModel;
use App\Models\AcademicYearModel;
use CodeIgniter\Controller;

class CoursesController extends Controller
{
    private $departmentModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->departmentModel = new DepartmentModel();
		$this->degreeModel = new DegreeModel();
        $this->collegeModel = new CollegeModel();
		$this->AcademicYearModel = new AcademicYearModel();
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
        $data['courses'] = $this->courseModel->findAllActiveCourses();
		//print_r($data); die();
        $this->loadCommonViews('Courses/index', $data);
    }

    public function create()
    {
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		$data['degrees'] = $this->degreeModel->GetData();
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('courses/create', $data);
    }

    public function store()
    {
        $courseModel = $this->courseModel;
        $validationRules = $courseModel->getValidationRules();
//print_r($validationRules); die();

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $courseModel->save([
                'course_name' => $this->request->getPost('course_name'),
				'department_id' => $this->request->getPost('department_id'),
                'academic_year_id' => $this->request->getPost('academic_year_id'),
				'college_id' => $this->request->getPost('college_id'),
				'credits' => $this->request->getPost('credits'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/courses')->with('success', 'Course added successfully');
        }
          
       	$data['department'] = $this->departmentModel->findAllActiveDepartments();
		 $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('courses/create', $data);
    }

    public function edit($id)
    {
        $data['courses'] = $this->courseModel->find($id);
      // print_r($data); die();
        if (!$data['courses']) {
            return redirect()->to('/courses')->with('error', 'Course not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Courses/edit', $data);
    }

    public function update($id)
    {
        $courses = $this->courseModel->find($id);

        if (!$courses) {
            return redirect()->to('/department')->with('error', 'Course not found');
        }

        $validationRules = $this->courseModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->courseModel->update($id, [
                'course_name' => $this->request->getPost('course_name'),
				'department_id' => $this->request->getPost('department_id'),
                'academic_year_id' => $this->request->getPost('academic_year_id'),
				'college_id' => $this->request->getPost('college_id'),
				'credits' => $this->request->getPost('credits'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/courses')->with('success', 'Course updated successfully');
        }

        $data['courses'] = $courses;
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Courses/edit', $data);
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
