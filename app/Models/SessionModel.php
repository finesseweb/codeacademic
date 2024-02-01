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

class SessionModel extends Model{

    
    protected $table = 'sessions';
	 protected $primaryKey = 'session_id';
    protected $allowedFields = ['session_id','session_name', 'status','academic_year_id'];
   // protected $beforeInsert = ['beforeInsert'];
   // protected $beforeUpdate = ['beforeUpdate'];  

    
    
    
    /**
     * Saves the users login session to DB
     *
     * @param  mixed $data
     * @return void
     */
    public function add($data)
    {
        $this->db->table('academic_year_id	')
                 ->insert($data);

    }
	
	

	 public function updateData($data,$id)
    {
         return $this->where('session_id', $id)
                    ->update($data);
    }
    
    /**
     * Gets the Auth Token By User Id
     *
     * @param  int $userID
     * @return void 
     */
    public function GetDataBySession($userID)
    {
        return $this->db->table('sessions')
                           ->where('session_name',$userID)
                           ->get()
                           ->getRow();

    }
	
	
	
	
	
	public function GetDataBySessionID($sessionID)
    {
        return $this->db->table('sessions')
                           ->where('session_id',$sessionID)
                           ->get()
                           ->getRowArray();

    }
	
	public function GetData()
    {
        return $this->db->table('sessions')
		                ->where('status','active')
                          ->get()->getResultArray();
                          

    }
  

   


}
