<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller
{
    public $template = 'template'; 

    public function action_home(){
        
       if (Auth::instance()->logged_in()){    
           $this->response->body(View::factory('home'));
       }else{
           $this->response->body(View::factory('login/form'));
       }
         
    }
    public function action_login()
    {
        
        $this->response->body(View::factory('login/form'));

       $login_form_url = HTTP::redirect('login/form');
    
       try{
           if (Auth::instance()->logged_in()){
               if (!Auth::instance()->logout()){
                   
                   if(!Auth::instance()->login('username' == Null)){                        
                       $this->response->body(View::factory('home')
                           ->bind('login_form_url',$login_form_url));                    
                   }else{
                       $this->response->body(View::factory('login/form')
                             ->bind('errors',$errors));                      
                   }
                   
               }else{
                   $this->response->body(View::factory('login/form')
                             ->bind('errors',$errors));
               }
           }    
       }catch(ORM_Validation_Exception $e){
               $errors = $e->errors('model');
       }
       
       $this->response->body(View::factory('login/form')
                             ->bind('errors',$errors));    

    }
    

     public function action_register()
    {
        $view = View::factory('register/form');
        
        //if ($this->request->method() === HTTP_Request::POST)
        //{
            $post = $this->request->post();
            
            // Validate the input data
            $validation = Validation::factory($post)
                ->rule('username', 'not_empty')
                ->rule('email', 'not_empty')
                ->rule('password', 'not_empty')
                ->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));

            if ($validation->check())
            {
                $user = ORM::factory('User');
                $user->username = $post['username'];
                $user->email = $post['email'];
                $user->password = Auth::instance()->hash_password($post['password']);
                
                try
                {
                    $user->save();
                    $this->response->body(View::factory('home'));
                }
                catch (ORM_Validation_Exception $e)
                {
                    $view->set('error',
                               'Registration failed: '.$e->getMessage());
                }
            }
            else
            {
                $this->response->body(View::factory('register/form')
                                        ->bind('errors',$errors));
            }
               
        $this->response->body(View::factory('register/form')
                                        ->bind('errors',$errors));
        //}
    }
    
    
    public function action_process()
    {        
       if($_POST){
           try{
               $username = $this->request->post('username');
               $password = $this->request->post('password');
               
               $user = ORM::factory('User')
                   ->where('username', '=', $username)
                   ->find();
                   
           }catch(ORM_Validation_Exception $e){
               $errors = $e->errors('model');
           }
       }
       
           $auth = Auth::instance();
           
           if(empty($password) || empty($username)){
       
               $this->response->body(View::factory('login/form') 
                   ->set('error', 'fill username or password')
                   ->bind('errors',$error));
           }else{
               $this->response->body(View::factory('home')
                                     ->bind('user',$user)
                                     ->bind('errors',$errors));  
           }
           
           if ($auth) {
               $this->response->body(View::factory('home')
                                     ->bind('user',$user)
                                     ->bind('errors',$errors));
           } else {
               $this->response->body(View::factory('login/form') 
                   ->set('error', 'Invalid username or password')
                   ->bind('errors',$errors));
           }   
           

    }
    
    public function action_logout() {
        $logout =  Auth::instance()->logout();
        
        if($logout){    
            $this->response->body(View::factory('login/form')
                                  ->bind('errors',$errors));
        }
    }
}
