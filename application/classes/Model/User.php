<?php

class Model_User extends ORM
{
    protected $_table_name = 'users';

    //protected $_primary_key = 'username';
    
    //public function unique_key($id = null)
    //{
    //    if ( ! empty($id) && is_string($id) && ! ctype_digit($id)) {
    //        return 'username';
    //    }
    //    
    //    return parent::unique_key($id);
    //}
    //
    //$array['roles'] = 'admin';


    public function unique_key() {
        return 'username'; // Replace 'email' with the actual unique key column name
    }

    
    public function rules(){

        return array(
            'username' => array( array('not_empty') ),
            'email' => array( array('not_empty') ),
            'password' => array( array('not_empty') ),
        );

    }
    
    /**
    * Filters to run when data is set in this model. The password filter
    * automatically hashes the password when it's set in the model.
    *
    * @return array Filters
    */
   //public function filters()
   //{
   //    return array(
   //        'password' => array(
   //            array(array(Auth::instance(), 'hash'))
   //        )
   //    );
   //}

    
}