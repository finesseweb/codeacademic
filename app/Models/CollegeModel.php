<?php

namespace App\Models;

use CodeIgniter\Model;

class CollegeModel extends Model
{
    protected $table = 'Colleges';
    protected $primaryKey = 'college_id';

    protected $allowedFields = ['college_name', 'university_id', 'status'];

    // Define validation rules for create and update
    protected $validationRules = [
        'college_name' => 'required|max_length[255]',
        'university_id' => 'required|numeric|is_not_unique[Universities.university_id]',
        'status' => 'required|in_list[active,inactive]',
    ];
        public function getActiveCollegesWithUniversities()
    {
        return $this->select('Colleges.*, Universities.university_name')
            ->join('Universities', 'Colleges.university_id = Universities.university_id')
            ->where('Universities.status', 'active')
            ->findAll();
    }
    
   public function getCollegesByUniversity($universityId)
{
    return $this->select('college_id, college_name')
        ->where('university_id', $universityId)
        ->where('status', 'active')
        ->findAll();
}
  public function findAllActiveColleges()
    {
        return $this->where('status', 'active')->findAll();
    }
    
     public function getUniversityIdByCollegeId($collegeId)
    {
        return $this->select('university_id')
            ->where('college_id', $collegeId)
            ->get()
            ->getRow('university_id');
    }
}
