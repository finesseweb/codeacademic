<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';

    protected $allowedFields = [
        'course_name',
        'department_id',
		'credits',
		'academic_year_id',
        'status',
		'college_id',
    ];

    protected $validationRules = [
	    'course_name' => 'required|min_length[3]|max_length[255]',
        'department_id' => 'required|integer',
		'credits' => 'required',
        'academic_year_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		'college_id' => 'required|integer',
  ];

    protected $validationMessages = [
        'course_name' => [
            'required' => 'The Course name field is required.',
            'min_length' => 'The Course name should be at least {param} characters long.',
            'max_length' => 'The Course name should not exceed {param} characters.',
        ],
        'department_id' => [
            'required' => 'The Department name field is required.',
            'integer' => 'The Department name field must be an integer.',
        ],
		'academic_year_id' => [
            'required' => 'The Academic Year field is required.',
            'integer' => 'The Academic Year field must be an integer.',
        ],
		'college_id' => [
            'required' => 'The college name field is required.',
            'integer' => 'The college name field must be an integer.',
        ],
		'credits' => [
            'required' => 'The Credit name field is required.',
            'integer' => 'The Credit name field must be an integer.',
        ],
        'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActiveCourses()
    {
        return $this->select('courses.*, colleges.college_name,departments.department_name')
                ->join('colleges', 'courses.college_id = colleges.college_id')
				->join('departments', 'courses.department_id = departments.department_id')
            ->where('courses.status', 'active')
            ->findAll();
    }
}
