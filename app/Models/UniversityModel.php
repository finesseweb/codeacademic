<?php

namespace App\Models;

use CodeIgniter\Model;

class UniversityModel extends Model
{
    protected $table = 'Universities'; // Your table name
    protected $primaryKey = 'university_id'; // Your primary key field name
    protected $allowedFields = ['university_name', 'university_location', 'status']; // Fields that can be mass-assigned

    // Validation rules for creating and updating records
    protected $validationRules = [
        'university_name' => 'required|max_length[255]',
        'university_location' => 'required|max_length[255]',
        'status' => 'required|in_list[active,inactive]',
    ];

    // Validation messages for custom error messages
    protected $validationMessages = [
        'university_name' => [
            'required' => 'University name is required.',
            'max_length' => 'University name should not exceed 255 characters.',
        ],
        'university_location' => [
            'required' => 'University location is required.',
            'max_length' => 'University location should not exceed 255 characters.',
        ],
        'status' => [
            'required' => 'Status is required.',
            'in_list' => 'Invalid status value. It should be either active or inactive.',
        ],
    ];
    
     public function findAllActiveUniversities()
    {
        // Fetch all active universities
        return $this->where('status', 'active')->findAll();
    }

}
