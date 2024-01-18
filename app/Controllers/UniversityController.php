<?php

namespace App\Controllers;

use App\Models\UniversityModel;
use CodeIgniter\Controller;
use App\Libraries\AuthLibrary;

class UniversityController extends Controller
{
    private $universityModel;
    private $session;
    private $auth;
    private $config;

    public function __construct()
    {
        
        $this->session = session();
        $this->auth = new AuthLibrary;
        $this->config = config('Auth');
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
       // echo "hi"; die;
        $data['universities'] = $this->universityModel->findAll();
        $this->loadCommonViews('university/index', $data);
    }

    public function create()
    {
        $this->loadCommonViews('university/create');
    }

    public function store()
    {
        $universityModel = new UniversityModel();
        if ($this->request->getMethod() === 'post' && $this->validate($universityModel->getValidationRules())) {
            // Save university data
            $universityModel->save([
                'university_name' => $this->request->getPost('university_name'),
                'university_location' => $this->request->getPost('university_location'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/university')->with('success', 'University added successfully');
        }

        $this->loadCommonViews('university/create');
    }

    public function edit($id)
    {
        $data['university'] = $this->universityModel->find($id);

        if (!$data['university']) {
            return redirect()->to('/university')->with('error', 'University not found');
        }

        $this->loadCommonViews('university/edit', $data);
    }

    public function update($id)
    {
        $university = $this->universityModel->find($id);

        if (!$university) {
            return redirect()->to('/university')->with('error', 'University not found');
        }

        if ($this->request->getMethod() === 'post' && $this->validate($this->universityModel->getValidationRules())) {
            // Update university data
            $this->universityModel->update($id, [
                'university_name' => $this->request->getPost('university_name'),
                'university_location' => $this->request->getPost('university_location'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/university')->with('success', 'University updated successfully');
        }

        $data['university'] = $university;
        $this->loadCommonViews('university/edit', $data);
    }

    public function delete($id)
    {
        $university = $this->universityModel->find($id);

        if (!$university) {
            return redirect()->to('/university')->with('error', 'University not found');
        }

        $this->universityModel->delete($id);
        return redirect()->to('/university')->with('success', 'University deleted successfully');
    }
}
