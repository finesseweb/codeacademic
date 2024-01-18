<?php

namespace App\Controllers;

use App\Models\CasteCategoryModel;
use CodeIgniter\Controller;
use App\Libraries\AuthLibrary;

class CasteCategoryController extends Controller
{
    private $casteCategoryModel;
    private $session;
    private $auth;
    private $config;

    public function __construct()
    {
        $this->session = session();
        $this->auth = new AuthLibrary;
        $this->config = config('Auth');
        $this->casteCategoryModel = new CasteCategoryModel();
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
        $data['casteCategories'] = $this->casteCategoryModel->findAll();
        $this->loadCommonViews('castecategory/index', $data);
    }

    public function create()
    {
        $this->loadCommonViews('castecategory/create');
    }

    public function store()
    {
        $casteCategoryModel = new CasteCategoryModel();
        if ($this->request->getMethod() === 'post' && $this->validate($casteCategoryModel->getValidationRules())) {
            // Save caste category data
            $casteCategoryModel->save([
                'caste_category_name' => $this->request->getPost('caste_category_name'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/castecategory')->with('success', 'Caste category added successfully');
        }

        $this->loadCommonViews('castecategory/create');
    }

    public function edit($id)
    {
        $data['caste_category'] = $this->casteCategoryModel->find($id);

        if (!$data['caste_category']) {
            return redirect()->to('/castecategory')->with('error', 'Caste category not found');
        }

        $this->loadCommonViews('castecategory/edit', $data);
    }

    public function update($id)
    {
        $casteCategory = $this->casteCategoryModel->find($id);

        if (!$casteCategory) {
            return redirect()->to('/castecategory')->with('error', 'Caste category not found');
        }

        if ($this->request->getMethod() === 'post' && $this->validate($this->casteCategoryModel->getValidationRules())) {
            // Update caste category data
            $this->casteCategoryModel->update($id, [
                'caste_category_name' => $this->request->getPost('caste_category_name'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/castecategory')->with('success', 'Caste category updated successfully');
        }

        $data['casteCategory'] = $casteCategory;
        $this->loadCommonViews('castecategory/edit', $data);
    }

    public function delete($id)
    {
        $casteCategory = $this->casteCategoryModel->find($id);

        if (!$casteCategory) {
            return redirect()->to('/castecategory')->with('error', 'Caste category not found');
        }

        $this->casteCategoryModel->delete($id);
        return redirect()->to('/castecategory')->with('success', 'Caste category deleted successfully');
    }
}
