<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademicYearModel extends Model
{
    protected $table = 'AcademicYears';
    protected $primaryKey = 'academic_year_id';
    protected $allowedFields = ['academic_year_code', 'start_date', 'end_date', 'college_id', 'status'];

    protected $validationRules = [
        'academic_year_code' => 'required|alpha_numeric|max_length[20]',
        'start_date' => 'required|valid_date',
        'end_date' => 'required|valid_date',
        'college_id' => 'required|is_valid_college',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'college_id' => [
            'is_valid_college' => 'The selected college is not valid or inactive.',
        ],
    ];

  public function getActiveAcademicYearsWithCollegesAndUniversities()
{
    return $this->select('AcademicYears.*, Colleges.college_name, Universities.university_name')
        ->join('Colleges', 'AcademicYears.college_id = Colleges.college_id')
        ->join('Universities', 'Colleges.university_id = Universities.university_id')
        ->where('Colleges.status', 'active')
        ->orWhere('Universities.status', 'active')
        ->findAll();
}

    
    
     
}
