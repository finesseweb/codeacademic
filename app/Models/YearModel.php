<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

namespace App\Models;

use CodeIgniter\Model;

class YearModel extends Model{

    
    protected $table = 'years';
	protected $primaryKey = 'year_id';
    protected $allowedFields = ['year', 'status'];
    //protected $beforeInsert = ['beforeInsert'];
    //protected $beforeUpdate = ['beforeUpdate'];  

    
    
    
    
    /**
     * Saves the users login session to DB
     *
     * @param  mixed $data
     * @return void
     */
    public function add($data)
    {
        $this->db->table('years')
                 ->insert($data);

    }
    
    /**
     * Gets the Auth Token By User Id
     *
     * @param  int $userID
     * @return void 
     */
    public function GetDataByYear($userID)
    {
        return $this->db->table('years')
                           ->where('year',$userID)
                           ->get()
                           ->getRow();

    }
	
	public function GetData()
    {
        return $this->db->table('years')
		                 ->where('status','active')
                          ->get()->getResultArray();
                          

    }
    
    /**
     * Inserts Auth Token
     *
     * @param  mixed $data
     * @return void
     */
   
   
    
    
    
  
public function findAllActiveYear()
    {
        return $this->where('status', 'active')->findAll();
    }
   


}
