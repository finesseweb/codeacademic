<?php

namespace App\Models;

use CodeIgniter\Model;

class CasteCategoryModel extends Model
{
    protected $table = 'CasteCategory';
    protected $primaryKey = 'caste_category_id';
    protected $allowedFields = ['caste_category_name', 'status'];
    
    protected $validationRules = [
        'caste_category_name' => 'required|max_length[255]',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'caste_category_name' => [
            'required' => 'Caste category name is required.',
            'max_length' => 'Caste category name should not exceed 255 characters.',
        ],
        'status' => [
            'required' => 'Status is required.',
            'in_list' => 'Status should be either active or inactive.',
        ],
    ];

    protected $skipValidation = false;
    
    public function findAllActiveCategories()
    {
        return $this->where('status', 'active')->findAll();
    }
}
