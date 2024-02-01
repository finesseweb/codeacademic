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

class DegreeModel extends Model{

    
    protected $table = 'degrees';
    protected $allowedFields = ['name', 'status'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];  

    
    /**
     * Runs before inserting data
     *
     * @param  mixed $data
     * @return void
     */
    protected function beforeInsert(array $data){

        $data = $this->passwordHash($data);
        return $data;
      
    }
    
    /**
     * Runs before Updating data
     *
     * @param  mixed $data
     * @return void
     */
    protected function beforeUpdate(array $data)
    {

        $data = $this->passwordHash($data);
        return $data;
    }
    
    /**
     * passwordHash
     *
     * @param  mixed $data
     * @return void
     */
    protected function passwordHash(array $data)
    {

        if (isset($data['data']['password']))
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_ARGON2ID);
        return $data;

    }
    
    /**
     * Saves the users login session to DB
     *
     * @param  mixed $data
     * @return void
     */
    public function add($data)
    {
        $this->db->table('degrees')
                 ->insert($data);

    }
    
    /**
     * Gets the Auth Token By User Id
     *
     * @param  int $userID
     * @return void 
     */
    public function GetDataByDegree($userID)
    {
        return $this->db->table('degrees')
                           ->where('name',$userID)
                           ->get()
                           ->getRow();

    }
	
	public function GetData()
    {
        return $this->db->table('degrees')
		                   ->where('status',1)
                          ->get()->getResultArray();
                          

    }
    
    /**
     * Inserts Auth Token
     *
     * @param  mixed $data
     * @return void
     */
    public function insertToken($data)
    {
        return $this->db->table('auth_tokens')
                        ->insert($data);
    }
    
    /**
     * Updates Auth Token
     *
     * @param  mixed $data
     * @return void
     */
    public function updateToken($data)
    {
        return $this->db->table('auth_tokens')
                        ->update($data);
    }
    
    /**
     * Gets Auth Token By Selector
     *
     * @param  mixed $selector
     * @return void
     */
    public function GetAuthTokenBySelector($selector)
    {
        return $this->db->table('auth_tokens')
                        ->where('selector', $selector)
                        ->get()
                        ->getRow();

    }
    
    /**
     * Deletes Token By User Id
     *
     * @param  int $userID
     * @return void
     */
    public function DeleteTokenByUserId($userID)
    {
        return  $this->db->table('auth_tokens')
                         ->where('user_id', $userID)
                         ->delete();
    }
    
    /**
     * Updates Selector
     *
     * @param  mixed $data
     * @param  mixed $selector
     * @return void
     */
    public function UpdateSelector($data, $selector)
    {
        return $this->where('selector', $selector)
                    ->update($data);
    }

   


}
