<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademicYearModel extends Model
{
  protected $table = 'AcademicYears';
    protected $primaryKey = 'academic_year_id';
    protected $allowedFields = ['academic_year_code', 'start_date', 'end_date', 'status'];

   
 protected $validationRules = [
      'academic_year_code' => 'required|max_length[20]',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|in_list[active,inactive]',
    ];
public function getActiveAcademicYearsWithCollegesAndUniversities()
{
    return $this->select('AcademicYears.*, Colleges.college_name, Universities.university_name')
        ->join('AcademicYearCollege', 'AcademicYears.academic_year_id = AcademicYearCollege.academic_year_id', 'left')
        ->join('Colleges', 'AcademicYearCollege.college_id = Colleges.college_id', 'left')
        ->join('Universities', 'Colleges.university_id = Universities.university_id', 'left')
       // ->where('AcademicYears.status', 'active')
        ->where('Colleges.status', 'active')
        ->where('Universities.status', 'active')
        ->groupBy('AcademicYears.academic_year_id')
        ->findAll();
}



    public function insertAcademicYear($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function updateAcademicYear($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteAcademicYear($id)
    {
        $this->delete($id);
    }

    public function insertColleges($academicYearId, $collegeIds)
    {
        $data = [];
        foreach ($collegeIds as $collegeId) {
            $data[] = [
                'academic_year_id' => $academicYearId,
                'college_id' => $collegeId,
            ];
        }
        $this->db->table('AcademicYearCollege')->insertBatch($data);
    }

    public function deleteCollegesForAcademicYear($academicYearId)
    {
        $this->db->table('AcademicYearCollege')->where('academic_year_id', $academicYearId)->delete();
    }

    public function getCollegeIdsForAcademicYear($academicYearId)
    {
        return $this->db->table('AcademicYearCollege')
            ->where('academic_year_id', $academicYearId)
            ->get()->getResultArray();
    }
	
	
	public function GetData()
    {
        return $this->db->table('academicyears')
		                   ->where('status','active')
                          ->get()->getResultArray();
                          

    }
}
  
    
     

