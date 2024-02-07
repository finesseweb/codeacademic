<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\CollegeModel;
use App\Models\DegreeModel;
use CodeIgniter\Controller;

class DepartmentController extends Controller
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
        $data['department'] = $this->departmentModel->findAllActiveDepartments();
		//print_r($data); die();
        $this->loadCommonViews('department/index', $data);
    }

    public function create()
    {
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('department/create', $data);
    }

    public function store()
    {
        $departmentModel = $this->departmentModel;
        $validationRules = $departmentModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Save caste data
            $departmentModel->save([
                'department_name' => $this->request->getPost('department_name'),
                'degree_id' => $this->request->getPost('degree_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/department')->with('success', 'Department added successfully');
        }

        $data['casteCategories'] = $this->casteCategoryModel->findAllActiveCategories();
        $this->loadCommonViews('caste/create', $data);
    }

    public function edit($id)
    {
        $data['department'] = $this->departmentModel->find($id);

        if (!$data['department']) {
            return redirect()->to('/department')->with('error', 'Caste not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('department/edit', $data);
    }

    public function update($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {
            return redirect()->to('/department')->with('error', 'Caste not found');
        }

        $validationRules = $this->departmentModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->departmentModel->update($id, [
                'department_name' => $this->request->getPost('department_name'),
                'degree_id' => $this->request->getPost('degree_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/department')->with('success', 'Department updated successfully');
        }

        $data['department'] = $department;
        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['degrees'] = $this->degreeModel->GetData();
        $this->loadCommonViews('department/edit', $data);
    }

    public function delete($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {
            return redirect()->to('/department')->with('error', 'Department not found');
        }

        $this->departmentModel->delete($id);
        return redirect()->to('/department')->with('success', 'Department deleted successfully');
    }
}
