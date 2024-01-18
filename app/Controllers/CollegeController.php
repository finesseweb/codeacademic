<?php

namespace App\Controllers;

use App\Models\CollegeModel;
use App\Models\UniversityModel;
use CodeIgniter\Controller;
use App\Libraries\AuthLibrary;

class CollegeController extends Controller
{
    private $collegeModel;
    private $universityModel;
    private $session;
    private $auth;
    private $config;

    public function __construct()
    {
        $this->session = session();
        $this->auth = new AuthLibrary;
        $this->config = config('Auth');
        $this->collegeModel = new CollegeModel();
        $this->universityModel = new UniversityModel();
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
        $data['colleges'] = $this->collegeModel->getActiveCollegesWithUniversities();
    $this->loadCommonViews('college/index', $data);
    }

    public function create()
    {
        $universityModel = new UniversityModel();
        $data['universities'] = $universityModel->where('status', 'active')->findAll();

        $this->loadCommonViews('college/create', $data);
    }

    public function store()
    {
        $collegeModel = new CollegeModel();
        if ($this->request->getMethod() === 'post' && $this->validate($collegeModel->getValidationRules())) {
            // Save college data
            $collegeModel->save([
                'college_name' => $this->request->getPost('college_name'),
                'university_id' => $this->request->getPost('university_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/college')->with('success', 'College added successfully');
        }

        $data['universities'] = $this->universityModel->findAll();
        $this->loadCommonViews('college/create', $data);
    }

    public function edit($id)
    {
        $data['college'] = $this->collegeModel->find($id);

        if (!$data['college']) {
            return redirect()->to('/college')->with('error', 'College not found');
        }

        $data['universities'] = $this->universityModel->findAll();
        $this->loadCommonViews('college/edit', $data);
    }

    public function update($id)
    {
        $college = $this->collegeModel->find($id);

        if (!$college) {
            return redirect()->to('/college')->with('error', 'College not found');
        }

        if ($this->request->getMethod() === 'post' && $this->validate($this->collegeModel->getValidationRules())) {
            // Update college data
            $this->collegeModel->update($id, [
                'college_name' => $this->request->getPost('college_name'),
                'university_id' => $this->request->getPost('university_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/college')->with('success', 'College updated successfully');
        }

        $data['college'] = $college;
        $data['universities'] = $this->universityModel->findAll();
        $this->loadCommonViews('college/edit', $data);
    }

    public function delete($id)
    {
        $college = $this->collegeModel->find($id);

        if (!$college) {
            return redirect()->to('/college')->with('error', 'College not found');
        }

        $this->collegeModel->delete($id);
        return redirect()->to('/college')->with('success', 'College deleted successfully');
    }
}
