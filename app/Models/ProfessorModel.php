<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    protected $table = 'professors';
    protected $primaryKey = 'professor_id';

    protected $allowedFields = [
        'first_name',
		'last_name',
		'email',
        'department_id',
		'status',
		
    ];

    protected $validationRules = [
	    'first_name' => 'required|min_length[3]|max_length[255]',
		'last_name' => 'required|min_length[3]|max_length[255]',
		'email' => 'required|min_length[3]|max_length[255]',
        'department_id' => 'required|integer',
		'status' => 'required|in_list[active,inactive]',
		
  ];

    protected $validationMessages = [
        'first_name' => [
            'required' => 'The First name field is required.',
            'min_length' => 'The First name should be at least {param} characters long.',
            'max_length' => 'The First name should not exceed {param} characters.',
        ],
		'last_name' => [
            'required' => 'The Last name field is required.',
            'min_length' => 'The Last name should be at least {param} characters long.',
            'max_length' => 'The Last name should not exceed {param} characters.',
        ],
		'email' => [
            'required' => 'The Email field is required.',
            'min_length' => 'The Email should be at least {param} characters long.',
            'max_length' => 'The Email should not exceed {param} characters.',
        ],
        'department_id' => [
            'required' => 'The Department name field is required.',
            'integer' => 'The Department name field must be an integer.',
        ],		
        'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActiveProfessor()
    {
        return $this->select('professors.*,departments.department_name')
              ->join('departments', 'professors.department_id = departments.department_id')
            ->where('professors.status', 'active')
            ->findAll();
    }
}
