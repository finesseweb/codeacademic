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

            // Get selected college IDs from the form
            $collegeIds = $this->request->getPost('college_ids');

            if (!empty($collegeIds)) {
                // Insert college links for the academic year
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
    $collegeIds = array_column($this->academicYearModel->getCollegeIdsForAcademicYear($id),"college_id");

    // Get all available colleges (for dropdown selection)
    $allColleges = $this->collegeModel->findAllActiveColleges();

    // Create an array of selected college IDs
    $selectedColleges = [];
    foreach ($allColleges as $college) {
        if (in_array($college['college_id'], $collegeIds)) {
            $selectedColleges[] = $college['college_id'];
        }
    }

    // Pass the university ID and selected colleges to the view
  //  $data['university_id'] = $data['academicYear']['university_id'];
    
    // Get the university ID for the selected colleges
    $universityIds = [];
    foreach ($selectedColleges as $collegeId) {
        $universityIds[] = $this->collegeModel->getUniversityIdByCollegeId($collegeId);
    }

    // Ensure that all selected colleges belong to the same university (optional)
    $uniqueUniversityIds = array_unique($universityIds);
    if (count($uniqueUniversityIds) === 1) {
        $data['university_id'] = reset($uniqueUniversityIds);
    }

    // Get colleges related to the selected university
    $relatedColleges = $this->collegeModel->getCollegesByUniversity($data['university_id']);
    
    $data['related_colleges'] = $relatedColleges;
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

        // Get selected college IDs from the form
        $collegeIds = $this->request->getPost('college_id');

        // Delete existing college links and insert updated ones
        $this->academicYearModel->deleteCollegesForAcademicYear($id);

        if (!empty($collegeIds)) {
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

    // Pass the university ID and selected colleges to the view
    $data['university_id'] = $data['academicYear']['university_id'];
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

        $this->academicYearModel->deleteCollegesForAcademicYear($id); // Delete associated college links
        $this->academicYearModel->deleteAcademicYear($id); // Delete the academic year itself

        return redirect()->to('/academicyears')->with('success', 'Academic year deleted successfully');
    }

    public function getCollegesByUniversity($universityId)
    {
        $colleges = $this->collegeModel->getCollegesByUniversity($universityId);
        return $this->response->setJSON($colleges);
    }
}
