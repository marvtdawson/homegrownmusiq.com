<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 5/10/17
 * Time: 7:32 PM
 */

namespace library\Models;


class SlideShowModel extends Model
{
    public $fields,
        $_pdo,
        $slider_images,
        $_tableName = 'syst3mSlid3sz';

    public static $handler,
        $entries = null,
        $corePagesName;

    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    /**
     * connect to db and table
     *
     */
    public function __construct()
    {
        //parent::__construct(); // connect to db via parent class

        // connect to db
        $this->_db = Model::getInstance();

    }

    /**
     * Before filter which is useful for login authentication
     *
     * @return void
     */
    protected function before(){}

    /**
     * After filter which could potentially be good for destroying sessions
     *
     * @return void
     */
    protected function after(){}

    /**
     * @param null $keywordType
     * @return bool
     *
     * Find user data in table
     *
     */
    public function find($keywordType = null){  // search for user provided info

        if($keywordType){ // if userInfo not equal to null, proceed

            // set field var to get either table id via potential customer account number or email values
            $field = ($keywordType) ? 'slide_Type' : '';

            // select user info from table where field equals $keywordType value using Model's get($table, $where)
            $data = $this->_db->get($this->_tableName, array($field,'=',$keywordType));

            // data is equivalent to rows, count() = 0 on Model class
            if($data->count()){

                // take first and only result found in table
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function update($tableName, $fields = array(), $id =  null)
    {
        if(!$id && $this->curruserInfo->isLoggedIn()){
            $id = $this->curruserInfo->data()->id;
        }

        if(!$this->_db->update($tableName, $id, $fields)){
            throw new Exception('There was a problem updating your account.');
        }
    }

    /**
     * @return mixed
     * return all of this page data in table as string
     */
    public function data(){
        return $this->_data;
    }

}