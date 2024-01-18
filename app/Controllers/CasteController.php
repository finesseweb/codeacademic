<?php

namespace App\Controllers;

use App\Models\CasteModel;
use App\Models\CasteCategoryModel;
use CodeIgniter\Controller;

class CasteController extends Controller
{
    private $casteModel;
    private $casteCategoryModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->casteModel = new CasteModel();
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
        $data['castes'] = $this->casteModel->findAllActiveCastes();
        $this->loadCommonViews('caste/index', $data);
    }

    public function create()
    {
        $data['casteCategories'] = $this->casteCategoryModel->findAllActiveCategories();
        $this->loadCommonViews('caste/create', $data);
    }

    public function store()
    {
        $casteModel = $this->casteModel;
        $validationRules = $casteModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Save caste data
            $casteModel->save([
                'caste_name' => $this->request->getPost('caste_name'),
                'caste_category_id' => $this->request->getPost('caste_category_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/caste')->with('success', 'Caste added successfully');
        }

        $data['casteCategories'] = $this->casteCategoryModel->findAllActiveCategories();
        $this->loadCommonViews('caste/create', $data);
    }

    public function edit($id)
    {
        $data['caste'] = $this->casteModel->find($id);

        if (!$data['caste']) {
            return redirect()->to('/caste')->with('error', 'Caste not found');
        }

        $data['casteCategories'] = $this->casteCategoryModel->findAllActiveCategories();
        $this->loadCommonViews('caste/edit', $data);
    }

    public function update($id)
    {
        $caste = $this->casteModel->find($id);

        if (!$caste) {
            return redirect()->to('/caste')->with('error', 'Caste not found');
        }

        $validationRules = $this->casteModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->casteModel->update($id, [
                'caste_name' => $this->request->getPost('caste_name'),
                'caste_category_id' => $this->request->getPost('caste_category_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/caste')->with('success', 'Caste updated successfully');
        }

        $data['caste'] = $caste;
        $data['casteCategories'] = $this->casteCategoryModel->findAllActiveCategories();
        $this->loadCommonViews('caste/edit', $data);
    }

    public function delete($id)
    {
        $caste = $this->casteModel->find($id);

        if (!$caste) {
            return redirect()->to('/caste')->with('error', 'Caste not found');
        }

        $this->casteModel->delete($id);
        return redirect()->to('/caste')->with('success', 'Caste deleted successfully');
    }
}
