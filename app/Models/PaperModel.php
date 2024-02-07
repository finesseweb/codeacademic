<?php

namespace App\Models;

use CodeIgniter\Model;

class PaperModel extends Model
{
    protected $table = 'papers';
    protected $primaryKey = 'paper_id';

    protected $allowedFields = [
        'course_id',
        'paper_title',
		'paper_description',
		'credits',
		//'countable_credit',
       // 'status',
		'college_id',
    ];

    protected $validationRules = [
	    'paper_title' => 'required|min_length[3]|max_length[255]',
		'paper_description' => 'required|min_length[3]|max_length[255]',
        'course_id' => 'required|integer',
		'credits' => 'required|integer',
        'countable_credit' => 'required|in_list[yes,no]',
		'status' => 'required|in_list[active,inactive]',
		'college_id' => 'required|integer',
  ];

    protected $validationMessages = [
        'paper_title' => [
           'required' => 'The Course name field is required.',
           'min_length' => 'The Course name should be at least {param} characters long.',
            'max_length' => 'The Course name should not exceed {param} characters.',
        ],
		'paper_description' => [
            'required' => 'The Course name field is required.',
            'min_length' => 'The Course name should be at least {param} characters long.',
            'max_length' => 'The Course name should not exceed {param} characters.',
        ],
        'course_id' => [
            'required' => 'The Department name field is required.',
            'integer' => 'The Department name field must be an integer.',
        ],
		'credits' => [
            'required' => 'The Academic Year field is required.',
            'integer' => 'The Academic Year field must be an integer.',
        ],
		'college_id' => [
            'required' => 'The college name field is required.',
            'integer' => 'The college name field must be an integer.',
        ],
		'countable_credit' => [
            'required' => 'The Countable credit field is required.',
            'in_list' => 'The Countable credit field should be yes or no.',
        ],
        'status' => [
            'required' => 'The status field is required.',
           'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActivePapers()
    {
        return $this->select('papers.*, colleges.college_name,courses.course_name')
                ->join('colleges', 'papers.college_id = colleges.college_id')
				->join('courses', 'papers.course_id = courses.course_id')
            ->where('papers.status', 'active')
            ->findAll();
    }
}
