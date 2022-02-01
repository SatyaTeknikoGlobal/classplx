<?php

/*
| -----------------------------------------------------
| PRODUCT NAME: 	MENTOR ERP
| -----------------------------------------------------
| AUTHOR:			Kshitij Kumar Singh
| -----------------------------------------------------
| EMAIL:			kshitij.singh@teknikoglobal.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY TEKNIKOGLOBAL
| -----------------------------------------------------
| WEBSITE:			https://www.teknikoglobal.com
| -----------------------------------------------------
*/
class Sections extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("signin_m");
        $this->load->model("dashboard_m");
    }

    public function index()
    {
        $this->data['classes']= $this->db->query("SELECT * FROM `admin_class` WHERE `is_active` = 'Y'")->result();
        $this->data['sections'] =$this->db->query("SELECT * FROM `admin_section` WHERE `status` = '1'")->result();
        $this->data['title'] = "Section";
        $this->data['subview'] = "master/section";
        $this->load->view("layout",$this->data);
    }

/////// Vaishali////////
    public function add_section()
    { 
    
        $class_id = $this->input->post('class_id');
         $name = $this->input->post('name');
        $status = $this->input->post('status');
        $this->db->insert('admin_section',array('class_id'=>$class_id,'name'=>$name,'status'=>$status));
        $last_id = $this->db->insert_id();
        if(!empty($last_id))
         {
            $this->add_all_sections();
            // $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
            // if(!empty($schools))
            // {
            //     foreach($schools as $school)
            //     {
            //         $dbArray = [];
            //         $dbArray['schoolID'] = $school->schoolID;
            //         $dbArray['classID'] = $class_id;
            //          $dbArray['section'] = $name;
            //         $dbArray['admin_section_id'] = $last_id;

            //      $this->db->insert('section', $dbArray);
            //     }
            // }
        }
       redirect('sections/');

    }



    public function add_all_sections(){
 $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
 if(!empty($schools)){
    foreach($schools as $school){
        $classes = $this->db->get_where('classes',array('schoolID'=>$school->schoolID,'is_active'=>'Y'))->result();
        if(!empty($classes)){
            foreach($classes as $class){
                $admin_class_id = $class->admin_class_id;
                $sections = $this->db->get_where('admin_section',array('class_id'=>$admin_class_id,'status'=>1))->result();
                if(!empty($sections)){
                    foreach($sections as $section){
                        $exists = $this->db->get_where('section',array('schoolID'=>$school->schoolID,'classID'=>$class->classID,'section'=>$section->name))->row();
                        if(empty($exists)){

                            $dbArr = [];
                            $is_active = 'N';
                            if($section->status == 1){
                                $is_active = 'Y';
                            }
                            $dbArr['schoolID'] = $school->schoolID;
                            $dbArr['classID'] = $class->classID;
                            $dbArr['section'] = $section->name;
                            $dbArr['admin_section_id'] = $section->id;
                            $dbArr['is_active'] = $is_active;
                            $this->db->insert('section',$dbArr);
                        }

                    }
                }
            }
        }
    }
}

}


    // public function subjects()
    // {
    //     $this->data['classes'] = $this->dashboard_m->get_multiple_row('admin_class',array('is_active'=>'Y'));
    //     $this->data['title'] = "Subject";
    //     $this->data['subview'] = "master/subject";
    //     $this->load->view("layout",$this->data);
    // }
   
   
    
   
    
   

    

 
   
    
   
}