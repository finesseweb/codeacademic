<?php

namespace App\Controllers;

use App\Models\AcademicYearModel;
use App\Models\CollegeModel;
use App\Models\UniversityModel;
use CodeIgniter\Controller;

class AcademicYearController extends Controller
{
    private $academicYearModel;
    private $collegeModel;
    private $session;
    private $universityModel;

    public function __construct()
    {
        $this->session = session();
        $this->academicYearModel = new AcademicYearModel();
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
        $data['academicYears'] = $this->academicYearModel->getActiveAcademicYearsWithCollegesAndUniversities();
        $this->loadCommonViews('academicyears/index', $data);
    }

    public function create()
    {
        $data['universities'] = $this->universityModel->findAllActiveUniversities();
        $this->loadCommonViews('academicyears/create', $data);
    }

    public function store()
    {
        $academicYearModel = $this->academicYearModel;
        $validationRules = $academicYearModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Save academic year data
            $academicYearData = [
                'academic_year_code' => $this->request->getPost('academic_year_code'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'status' => $this->request->getPost('status'),
            ];

            // Insert academic year and get its ID
            $academicYearId = $academicYearModel->insertAcademicYear($academicYearData);

            // Get selected university and college IDs from the form
            $universityIds = $this->request->getPost('university_ids');
            $collegeIds = $this->request->getPost('college_ids');

            if (!empty($universityIds) && !empty($collegeIds)) {
                $academicYearModel->insertColleges($academicYearId, $collegeIds);
            }

            return redirect()->to('/academicyears')->with('success', 'Academic year added successfully');
        }

        $data['universities'] = $this->universityModel->findAllActiveUniversities();
        $this->loadCommonViews('academicyears/create', $data);
    }

    public function edit($id)
    {
        $data['academicYear'] = $this->academicYearModel->find($id);

        if (!$data['academicYear']) {
            return redirect()->to('/academicyears')->with('error', 'Academic year not found');
        }

        $data['universities'] = $this->universityModel->findAllActiveUniversities();

        // Get college IDs associated with the academic year
        $collegeIds = array_column($this->academicYearModel->getCollegeIdsForAcademicYear($id), "college_id");

        // Get all available colleges (for dropdown selection)
        $allColleges = $this->collegeModel->findAllActiveColleges();

        // Create an array of selected college IDs
        $selectedColleges = [];
        foreach ($allColleges as $college) {
            if (in_array($college['college_id'], $collegeIds)) {
                $selectedColleges[] = $college['college_id'];
            }
        }
//echo "<pre>"; print_r($allColleges);exit;
        // Pass the university IDs and selected colleges to the view
        $data['university_ids'] = array_column($this->academicYearModel->getUniversityIdsForAcademicYear($id),'university_id');
       // echo "<pre>"; print_R( $data);exit;
        $data['selected_colleges'] = $selectedColleges;
        $data['all_colleges'] = $allColleges;

        $this->loadCommonViews('academicyears/edit', $data);
    }

    public function update($id)
    {
        $academicYear = $this->academicYearModel->find($id);

        if (!$academicYear) {
            return redirect()->to('/academicyears')->with('error', 'Academic year not found');
        }

        $validationRules = $this->academicYearModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update academic year data
            $academicYearData = [
                'academic_year_code' => $this->request->getPost('academic_year_code'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'status' => $this->request->getPost('status'),
            ];

            $this->academicYearModel->updateAcademicYear($id, $academicYearData);

            // Get selected university and college IDs from the form
            $universityIds = $this->request->getPost('university_ids');
            $collegeIds = $this->request->getPost('college_ids');

            // Delete existing university and college links
            $this->academicYearModel->deleteCollegesForAcademicYear($id);
            // Insert updated university and college links
            if (!empty($universityIds) && !empty($collegeIds)) {
                $this->academicYearModel->insertColleges($id, $collegeIds);
            }

            return redirect()->to('/academicyears')->with('success', 'Academic year updated successfully');
        }

        $data['academicYear'] = $academicYear;
        $data['universities'] = $this->universityModel->findAllActiveUniversities();

        // Get college IDs associated with the academic year
        $collegeIds = $this->academicYearModel->getCollegeIdsForAcademicYear($id);

        // Get all available colleges (for dropdown selection)
        $allColleges = $this->collegeModel->findAllActiveColleges();

        // Create an array of selected college IDs
        $selectedColleges = [];
        foreach ($allColleges as $college) {
            if (in_array($college['college_id'], $collegeIds)) {
                $selectedColleges[] = $college['college_id'];
            }
        }

        // Pass the university IDs and selected colleges to the view
        $data['university_ids'] = $this->academicYearModel->getUniversityIdsForAcademicYear($id);
        $data['selected_colleges'] = $selectedColleges;
        $data['all_colleges'] = $allColleges;

        $this->loadCommonViews('academicyears/edit', $data);
    }

    public function delete($id)
    {
        $academicYear = $this->academicYearModel->find($id);

        if (!$academicYear) {
            return redirect()->to('/academicyears')->with('error', 'Academic year not found');
        }

        $this->academicYearModel->deleteCollegesForAcademicYear($id);
        $this->academicYearModel->deleteAcademicYear($id);

        return redirect()->to('/academicyears')->with('success', 'Academic year deleted successfully');
    }

    public function getCollegesByUniversities()
    {
        $universityIds = $this->request->getPost('university_ids');
        $colleges = $this->collegeModel->getCollegesByUniversities($universityIds);
        return $this->response->setJSON($colleges);
    }
}
