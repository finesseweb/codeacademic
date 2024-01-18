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
}
