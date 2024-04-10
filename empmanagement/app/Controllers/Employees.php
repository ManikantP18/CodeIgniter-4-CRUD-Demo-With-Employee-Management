<?php

namespace App\Controllers;
use App\Models\EmployeeModel;

class Employees extends BaseController
{

    /**
     * Clean Data Before Saving 
     * Author: Manikant Patidar
     */
    function cleanDataForDBSecurity($data) {
        $trimmed_post = [];
        
        foreach($data as $var => $val) {
            $trimmed_post[$var] = trim(strip_tags($val)); 
        }

        return $trimmed_post;
    }
    
    /**
     * Pull Employees Data & Show as List to End Users
     * @author : Manikant Patidar
     */

    public function index()
    {
        $employee = new EmployeeModel();
        //Get only records which are not deleted
        $data['employees'] = $employee->getWhere(['is_deleted' => 1])->getResult();

        echo view('header');
        return view('emplist',$data);
    }

    /**
     * Create New Employees UI Render
     * @author : Manikant Patidar
     */
    public function create()
    {
        helper (['form']);   
        echo view('header');
        return view('addemp');
    }

    /**
     * Create Employee Data Store Into Employees & Redirect back to Employees List
     * Function Performed Actions LikeValidate Data Before Saving, Removing Whilte Spaces, Removing Tags, Save to Employee Table etc
     * @author : Manikant Patidar
     */

    public function store()
    {

        $request = request(); 

        helper(['form', 'url']);
        
        //Response Defined
        $data = ['success' => false, 'messages' => ' Error in Insertions'];

        $this->validation =  \Config\Services::validation();
        $data['validation'] = $this->validation;

        if ($request->getPost()) {

            $requestData = $this->cleanDataForDBSecurity($request->getPost());

            $rules = [
                'first_name'   => ['label' => 'First Name', 'rules'   => 'trim|strip_tags|required|min_length[2]|max_length[20]'],
                'last_name'   => ['label' => 'Last Name', 'rules'   => 'trim|strip_tags|required|min_length[2]|max_length[20]'],
                'email'   => ['label' => 'Email', 'rules'   => 'trim|strip_tags|required|max_length[254]|valid_email'],
                'mobile'   => ['label' => 'Mobile Number', 'rules'   => 'trim|strip_tags|required|min_length[10]|max_length[10]|alpha_numeric'],
                'contry_code'   => ['label' => 'Country Code', 'rules'   => 'required'],
                'address'   => ['label' => 'Address', 'rules'   => 'trim|strip_tags|required|min_length[10]|max_length[1000]'],
                'image' =>  [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[image]',
                        'is_image[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[image,100]',
                        'max_dims[image,1024,768]',
                    ]
                ],
            ];
        
            if (!$this->validate($rules)) {
                echo view('header');
                return view('addemp', array('validation' => $this->validator));
            } else {

                //Checking for duplicate Emplotyee

                $employeeExist = $this->EmployeeModel->query('select * from employees where is_deleted = "1" AND email = "'.$requestData['email'].'"')->getResult();

                if (!empty($employeeExist)) {

                    $data['success'] = false;
                    $data['messages'] = 'Using Same Email Already Exist An Employee!';

                    echo view('header');
                    return view('addemp',$data);

                }

                // Uploading File
                $img = $this->request->getFile('image');
                $newName = $img->getRandomName();
                $img->move(WRITEPATH . 'uploads', $newName);

                $requestData['image'] = $newName;

                $this->EmployeeModel = new EmployeeModel();

                //$requestData['hobby'] = implode(',',$requestData['hobby']);

                unset($requestData['hobby[]']);
        
                if ($this->EmployeeModel->insert($requestData)) {
        
                    $data['success'] = true;
                    $data['messages'] = lang("App.insert-success");

                    $session = \Config\Services::session();

                    $session->setFlashdata('flashmessages', $data);

                    $redirectResponse = \config\Services::redirectresponse();

                    return redirect()->route('/');
                } else {
        
                    $data['success'] = false;
                    $data['messages'] = lang("App.insert-error");

                    echo view('header');
                    return view('addemp',$data);
                }
            }
            
        }

        
    }

 // Edit single Employee Data Using ID
 public function edit($id = null){
    helper(['form', 'url']);
    $emp = new EmployeeModel();
    $data['emp_obj'] = $emp->where('id', $id)->first();
    echo view('header');
    return view('editemp', $data);
}


/**
     * Create Employee Data Store Into Employees & Redirect back to Employees List
     * Function Performed Actions LikeValidate Data Before Saving, Removing Whilte Spaces, Removing Tags, Save to Employee Table etc
     * @author : Manikant Patidar
     */

     public function update()
     {
 
         $request = request(); 
 
         helper(['form', 'url']);
         
         //Response Defined
         $data = ['success' => false, 'messages' => ' Error in Insertions'];
 
         $this->validation =  \Config\Services::validation();
         $data['validation'] = $this->validation;
 
         if ($request->getPost()) {
 
             $requestData = $this->cleanDataForDBSecurity($request->getPost());
 
             $rules = [
                 'first_name'   => ['label' => 'First Name', 'rules'   => 'trim|strip_tags|required|min_length[2]|max_length[20]'],
                 'last_name'   => ['label' => 'Last Name', 'rules'   => 'trim|strip_tags|required|min_length[2]|max_length[20]'],
                 'email'   => ['label' => 'Email', 'rules'   => 'trim|strip_tags|required|max_length[254]|valid_email'],
                 'mobile'   => ['label' => 'Mobile Number', 'rules'   => 'trim|strip_tags|required|min_length[10]|max_length[10]|alpha_numeric'],
                 'contry_code'   => ['label' => 'Country Code', 'rules'   => 'required'],
                 'address'   => ['label' => 'Address', 'rules'   => 'trim|strip_tags|required|min_length[10]|max_length[1000]'],
                 'image' =>  [
                     'label' => 'Image File',
                     'rules' => [
                         'uploaded[image]',
                         'is_image[image]',
                         'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                         'max_size[image,100]',
                         'max_dims[image,1024,768]',
                     ]
                 ],
             ];
         
             if (!$this->validate($rules)) {
                 echo view('header');
                 return view('editemp', array('validation' => $this->validator));
             } else {
 
                 // Uploading File
                 $img = $this->request->getFile('image');
                 $newName = $img->getRandomName();
                 $img->move(WRITEPATH . 'uploads', $newName);
 
                 $requestData['image'] = $newName;
 
                 $this->EmployeeModel = new EmployeeModel();
 
                 //$requestData['hobby'] = implode(',',$requestData['hobby']);
 
                 unset($requestData['hobby[]']);

                 //Checking for duplicate Emplotyee

                 $employeeExist = $this->EmployeeModel->query('select * from employees where is_deleted = "1" AND email = "'.$requestData['email'].'" AND id != "'.$requestData['id'].'"')->getResult();

                 if (!empty($employeeExist)) {

                     $data['success'] = false;
                     $data['messages'] = 'Using Same Email Already Exist An Employee!';
 
                     echo view('header');
                     return view('editemp',$data);

                 }
         
                 if ($this->EmployeeModel->update($requestData['id'],$requestData)) {
         
                     $data['success'] = true;
                     $data['messages'] = lang("App.insert-success");
 
                     $session = \Config\Services::session();
 
                     $session->setFlashdata('flashmessages', $data);
 
                     $redirectResponse = \config\Services::redirectresponse();
 
                     return redirect()->route('/');
                 } else {
         
                     $data['success'] = false;
                     $data['messages'] = lang("App.insert-error");
 
                     echo view('header');
                     return view('aeditemp',$data);
                 }
             }
             
         }
 
         
     }

     /**
      * Delete An Employee Data
      */
      public function delete($id = null){
        $emp = new EmployeeModel();
        $data['emp_obj'] = $emp->where('id', $id)->delete();

        $redirectResponse = \config\Services::redirectresponse();

        return redirect()->route('/');
    }

}
