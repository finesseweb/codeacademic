<?php

namespace App\Controllers;

use App\Models\AcademicYearModel;
use App\Models\CollegeModel;
use CodeIgniter\Controller;

class AcademicYearController extends Controller
{
    private $academicYearModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->academicYearModel = new AcademicYearModel();
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
        $data['academicYears'] = $this->academicYearModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyear/index', $data);
    }

    public function create()
    {
        $data['colleges'] = $this->collegeModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyear/create', $data);
    }

    public function store()
    {
        $academicYearModel = $this->academicYearModel;
        $validationRules = $academicYearModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Save academic year data
            $academicYearModel->save([
                'academic_year_code' => $this->request->getPost('academic_year_code'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/academicyear')->with('success', 'Academic year added successfully');
        }

        $data['colleges'] = $this->collegeModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyear/create', $data);
    }

    public function edit($id)
    {
        $data['academicYear'] = $this->academicYearModel->find($id);

        if (!$data['academicYear']) {
            return redirect()->to('/academicyear')->with('error', 'Academic year not found');
        }

        $data['colleges'] = $this->collegeModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyear/edit', $data);
    }

    public function update($id)
    {
        $academicYear = $this->academicYearModel->find($id);

        if (!$academicYear) {
            return redirect()->to('/academicyear')->with('error', 'Academic year not found');
        }

        $validationRules = $this->academicYearModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update academic year data
            $this->academicYearModel->update($id, [
                'academic_year_code' => $this->request->getPost('academic_year_code'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/academicyear')->with('success', 'Academic year updated successfully');
        }

        $data['academicYear'] = $academicYear;
        $data['colleges'] = $this->collegeModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyear/edit', $data);
    }

    public function delete($id)
    {
        $academicYear = $this->academicYearModel->find($id);

        if (!$academicYear) {
            return redirect()->to('/academicyear')->with('error', 'Academic year not found');
        }

        $this->academicYearModel->delete($id);
        return redirect()->to('/academicyear')->with('success', 'Academic year deleted successfully');
    }
}
