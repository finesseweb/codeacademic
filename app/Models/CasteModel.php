<?php

namespace App\Models;

use CodeIgniter\Model;

class CasteModel extends Model
{
    protected $table = 'Caste';
    protected $primaryKey = 'caste_id';

    protected $allowedFields = [
        'caste_name',
        'caste_category_id',
        'status',
    ];

    protected $validationRules = [
        'caste_name' => 'required|min_length[3]|max_length[255]',
        'caste_category_id' => 'required|integer',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'caste_name' => [
            'required' => 'The caste name field is required.',
            'min_length' => 'The caste name should be at least {param} characters long.',
            'max_length' => 'The caste name should not exceed {param} characters.',
        ],
        'caste_category_id' => [
            'required' => 'The caste category field is required.',
            'integer' => 'The caste category field must be an integer.',
        ],
        'status' => [
            'required' => 'The status field is required.',
            'in_list' => 'The status field should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    
    public function findAllActiveCastes()
    {
        return $this->select('Caste.*, CasteCategory.caste_category_name')
                ->join('CasteCategory', 'Caste.caste_category_id = CasteCategory.caste_category_id')
            ->where('CasteCategory.status', 'active')
            ->findAll();
    }
}
