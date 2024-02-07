<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'department_id';

    protected $allowedFields = [
        'department_name',
        'college_id',
		'degree_id',
        'status',
    ];

    protected $validationRules = [
        'department_name' => 'required|min_length[3]|max_length[255]',
        'college_id' => 'required|integer',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'department_name' => [
            'required' => 'The Department name field is required.',
            'min_length' => 'The Department name should be at least {param} characters long.',
            'max_length' => 'The Department name should not exceed {param} characters.',
        ],
        'college_id' => [
            'required' => 'The college name field is required.',
            'integer' => 'The college name field must be an integer.',
        ],
        'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActiveDepartments()
    {
        return $this->select('departments.*, colleges.college_name,degrees.name')
                ->join('colleges', 'departments.college_id = colleges.college_id')
				->join('degrees', 'departments.degree_id = degrees.id')
            ->where('departments.status', 'active')
            ->findAll();
    }
}
