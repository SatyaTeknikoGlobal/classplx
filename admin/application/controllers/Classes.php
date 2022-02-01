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
class Classes extends MY_Controller
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
        $this->data['title'] = "Class";
        $this->data['subview'] = "master/class";
        $this->load->view("layout",$this->data);
    }

/////// Vaishali////////
    public function add_class()
    {      
        $classes = $this->input->post('class');
        $status = $this->input->post('is_active');
        $this->db->insert('admin_class',array('class'=>$classes,'is_active'=>$status));
        $last_id = $this->db->insert_id();
        if(!empty($last_id))
        {
            $this->add_all_classes();
            // $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
            // if(!empty($schools))
            // {
            //     foreach($schools as $school)
            //     {
            //         $dbArray = [];
            //         $dbArray['schoolID'] = $school->schoolID;
            //         $dbArray['class'] = $classes;
            //         $dbArray['admin_class_id'] = $last_id;

            //        $this->db->insert('classes', $dbArray);
            //     }  
            // }
        }
        redirect('classes/');
    }


    public function add_all_classes(){
        $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
        if(!empty($schools)){
            foreach($schools as $school){
                $classes = $this->db->get_where('admin_class',array('is_active'=>'Y'))->result();
                if(!empty($classes)){
                    foreach($classes as $class){
                     $exists = $this->db->get_where('classes',array('schoolID'=>$school->schoolID,'class'=>$class->class))->row();
                     if(empty($exists)){
                        $dbArr = [];
                        $dbArr['schoolID'] = $school->schoolID;
                        $dbArr['class'] = $class->class;
                        $dbArr['admin_class_id'] = $class->classid;
                        $dbArr['is_active'] = $class->is_active;
                        $this->db->insert('classes',$dbArr);
                    }

                }
            }
        }
    }

}









public function contents()
{
    $this->data['classes'] = $this->dashboard_m->get_multiple_row('admin_class',array('is_active'=>'Y'));
    $this->data['contents'] = $this->dashboard_m->get_multiple_row('admin_content',array('is_active'=>'Y'));
    $this->data['title'] = "Contents";
    $this->data['subview'] = "master/content";
    $this->load->view("layout",$this->data);
    
}

public function subjects()
{
    $this->data['classes'] = $this->dashboard_m->get_multiple_row('admin_class',array('is_active'=>'Y'));
    $this->data['sections'] = $this->dashboard_m->get_multiple_row('admin_section',array('status'=>'1'));
    $this->data['subjects']= $this->db->query("SELECT * FROM `admin_subject` WHERE `is_active` = 'Y'")->result();
    $this->data['title'] = "Subject";
    $this->data['subview'] = "master/subject";
    $this->load->view("layout",$this->data);
}



public function get_subjects()
{
    $classID = $this->input->post('classID');
    $array1 = array('classID'=>$classID);
    $subject = $this->dashboard_m->get_multiple_row('admin_subject',$array1);
    echo json_encode($subject);
}


//////////// Vaishali  (Only Add Section ID and GENERATE foreach loop) ////////////
public function add_subject()
{

   $section_id = $this->input->post('section_id');

   
   $classID = $this->input->post('classID');
   $subject_name = $this->input->post('subject');
   $status = $this->input->post('is_active');        
   $this->db->insert('admin_subject',array('classID'=>$classID,'section_id'=>$section_id,'subject'=>$subject_name,'is_active'=>$status,'added_on'=>date("Y-m-d H:i:s")));

   $last_id = $this->db->insert_id();
   if(!empty($last_id))
   {
    $this->add_all_subject();
            //     $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
            //     if(!empty($schools))
            //     {
            //         foreach($schools as $school)
            //         {
            //             $dbArray = [];
            //             $dbArray['schoolID'] = $school->schoolID;
            //             $dbArray['classID'] = $classID;
            //              $dbArray['section_id'] = $section;                        
            //              $dbArray['subject_name'] = $subject_name;
            //             $dbArray['admin_subject_id'] = $last_id;

            //             print_r($dbArray);
            //             die;

            //          $this->db->insert('subject', $dbArray);
            //         }
            //     }
            // }
}

redirect(base_url('classes/subjects'));

}





public function add_all_subject(){
    $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
    if(!empty($schools)){
        foreach($schools as $school){
            $classes = $this->db->get_where('classes',array('schoolID'=>$school->schoolID,'is_active'=>'Y'))->result();
            if(!empty($classes)){
                foreach($classes as $class){
                    $sections = $this->db->get_where('section',array('schoolID'=>$school->schoolID,'classID'=>$class->classID,'is_active'=>'Y'))->result();
                    if(!empty($sections)){
                        foreach($sections as $section){
                            $admin_section_id = $section->admin_section_id;
                            $subjects = $this->db->get_where('admin_subject',array('section_id'=>$admin_section_id,'is_active'=>'Y'))->result();
                            if(!empty($subjects)){
                                foreach($subjects as $subject){
                                    // $dbArr = [];
                                    // $dbArr['schoolID'] = $school->schoolID;
                                    // $dbArr['classID'] = $class->classID;
                                    // $dbArr['sectionID'] = $section->sectionID;
                                    // $dbArr['subject_name'] = $subject->subject;
                                    // $dbArr['subject_code'] = '';
                                    // $dbArr['admin_subject_id'] = $subject->subID;
                                    // $this->db->insert('subject',$dbArr);


                                    $exists = $this->db->get_where('subject',array('schoolID'=>$school->schoolID,'sectionID'=>$section->sectionID,'classID'=>$class->classID,'subject_name'=>$subject->subject))->row();
                                    if(empty($exists)){
                                       $dbArr = [];
                                       $dbArr['schoolID'] = $school->schoolID;
                                       $dbArr['classID'] = $class->classID;
                                       $dbArr['sectionID'] = $section->sectionID;
                                       $dbArr['subject_name'] = $subject->subject;
                                       $dbArr['subject_code'] = '';
                                       $dbArr['admin_subject_id'] = $subject->subID;
                                       $this->db->insert('subject',$dbArr);

                                   }


                               }
                           }
                       }
                   }
               }
           }
       }
   }


}
public function update_subject($param = "")
{
    if ($param != "")
    {
        $subjectID = $param;
        $subject_name = $this->input->post('subject');
        $status = $this->input->post('is_active');
        $this->db->where(array('subID'=>$subjectID));
        $this->db->update('admin_subject',array('subject'=>$subject_name,'is_active'=>$status));
        echo "success";
    }
}

public function chapter()
{
    $this->data['classes'] = $this->dashboard_m->get_multiple_row('admin_class',array('is_active'=>'Y'));
    $this->data['chapters'] = $this->dashboard_m->get_multiple_row('admin_chapter',array('is_active'=>'Y'));
    $this->data['title'] = "Chapter";
    $this->data['subview'] = "master/chapter";
    $this->load->view("layout",$this->data);
}
public function get_chapters()
{

    $classID = $this->input->post('classID');
    $subjectID = $this->input->post('subjectID');
    $array1 = array('classID'=>$classID,'subjectID'=>$subjectID);
    $chapters = $this->dashboard_m->get_multiple_row('admin_chapter',$array1);
    if(!empty($chapters)){
        foreach($chapters as $chap){
            $this->db->select('subject');
            $subject = $this->db->get_where('admin_subject',array('subID'=>$chap->subjectID))->row();
            $chap->subjectID = isset($subject->subject) ? $subject->subject :'';
        }
    }
    echo json_encode($chapters);
}
public function get_chapters_by_id(){
    $chapterID   = !empty($this->input->post('chapterID')) ? $this->input->post('chapterID') : "";
    $d = $this->db->get_where('admin_chapter',array('chapterID'=>$chapterID))->row();
    if ($d) {
        echo json_encode(array('status'=>true,'data'=>$d)); 
    }else{
        echo json_encode(array('status'=>false,'data'=>''));   
    }
}


    ///////////// Vaishali////////

public function get_sectionbyclass()
{
    $classID = $this->input->post('classID');
    $array1 = array('class_id'=>$classID);
    $sections = $this->dashboard_m->get_multiple_row('admin_section',$array1);
    echo json_encode($sections);
}



public function get_subjectbysection()
{
   $section_id = $this->input->post('section_id');
   $array1 = array('section_id'=>$section_id);
   $subject = $this->dashboard_m->get_multiple_row('admin_subject',$array1);
   echo json_encode($subject);          
}


public function get_subjectbyclass1()
{
    $classID = $this->input->post('classID3');
    $array1 = array('classID'=>$classID);
    $subject = $this->dashboard_m->get_multiple_row('admin_subject',$array1);
    echo json_encode($subject);
}

////////// VAISHALI (Only Add Section ID )  /////

public function add_chapter()
{       
    $classID = $this->input->post('classID');
    $section_id = $this->input->post('section_id');
    $subjectID = $this->input->post('subject_id');
    $chapter_name = $this->input->post('chapter_name');
    $status = $this->input->post('is_active');
    $a = $this->db->insert('admin_chapter',array('classID'=>$classID,'section_id'=>$section_id,'subjectID'=>$subjectID,'chapter_name'=>$chapter_name,'is_active'=>$status,'added_on'=>date("Y-m-d H:i:s")));
    $this->add_all_chapter();

    redirect(base_url('classes/chapter'));
}



public function add_all_chapter(){
    $schools = $this->db->get_where('school_registration',array('is_active' => 'Y'))->result();
    if(!empty($schools)){
        foreach($schools as $school){
            $classes = $this->db->get_where('classes',array('schoolID'=>$school->schoolID,'is_active'=>'Y'))->result();
            if(!empty($classes)){
                foreach($classes as $class){
                    $sections = $this->db->get_where('section',array('schoolID'=>$school->schoolID,'classID'=>$class->classID,'is_active'=>'Y'))->result();
                    if(!empty($sections)){
                        foreach($sections as $section){
                            $subjects = $this->db->get_where('subject',array('schoolID'=>$school->schoolID,'classID'=>$class->classID,'sectionID'=>$section->sectionID,'is_active'=>'Y'))->result();
                            if(!empty($subjects)){
                                foreach($subjects as $subject){
                                 $admin_subject_id = $subject->admin_subject_id;
                                 $chapters = $this->db->get_where('admin_chapter',array('subjectID'=>$admin_subject_id,'is_active'=>'Y'))->result();
                                 if(!empty($chapters)){
                                    foreach($chapters as $chapter){
                                        $exists = $this->db->get_where('chapters',array('schoolID'=>$school->schoolID,'sectionID'=>$section->sectionID,'classID'=>$class->classID,'subjectID'=>$subject->subjectID,'chapter_name'=>$chapter->chapter_name))->row();
                                        if(empty($exists)){
                                           $dbArr = [];
                                           $dbArr['schoolID'] = $school->schoolID;
                                           $dbArr['classID'] = $class->classID;
                                           $dbArr['sectionID'] = $section->sectionID;
                                           $dbArr['subjectID'] = $subject->subjectID;
                                           $dbArr['chapter_name'] = $chapter->chapter_name;
                                           $dbArr['is_active'] = $chapter->is_active;
                                           $dbArr['admin_chapter_id'] = $chapter->chapterID;
                                           $this->db->insert('chapters',$dbArr);
                                       }
                                   }

                               }
                           }
                       }
                   }
               }
           }
       }
   }


}

}

public function edit_chapter()
{

    $classID = $this->input->post('add_classID');
    $chapter_name = $this->input->post('chapter_name');
    $status = $this->input->post('is_active');
    $chapter_id = $this->input->post('chapter_id');
    $this->db->where(array('chapterID'=>$chapter_id));
    $this->db->update('admin_chapter',array('classID'=>$classID,'chapter_name'=>$chapter_name,'is_active'=>$status));
    redirect(base_url('classes/chapter'));
}

public function get_chapterbysubject_re11()

{
    if ($_POST){
        $classID = $this->input->post('classID2');
        $subjectID = $this->input->post('subjectID2');
        $chapters = $this->db->get_where('admin_chapter',array('classID'=>$classID ,'subjectID'=>$subjectID))->result();
        echo json_encode($chapters);

    }

}
public function get_chapterbysubject_re()

{
    if ($_POST){
        $classID = $this->input->post('classID');
        $section_id = $this->input->post('section_id');
        $subjectID = $this->input->post('subjectID3');
        $chapters = $this->db->get_where('admin_chapter',array('classID'=>$classID ,'section_id'=>$section_id,'subjectID'=>$subjectID))->result();
        echo json_encode($chapters);

    }

}
public function submit_content()
{ 

 
    $classID = $this->input->post('classID');
    $section_id = $this->input->post('section_id');
    $subjectID = $this->input->post('subjectID');
    $chapterID = $this->input->post('chapterID');
    $title = $this->input->post('title');
    $type = $this->input->post('type');
    $status = $this->input->post('is_active');
        $target_path = "uploads/contents/"; // replace this with the path you are going to save the file to
        $target_dir = "uploads/contents/";
        $actual_image_name = "default.pdf";
        if(file_exists($_FILES["syllabus"]["tmp_name"]))
        {
            $target_file = $target_dir . basename($_FILES["syllabus"]["name"]);
            foreach($_FILES as $fileKey => $fileVal)
            {
                $extension = substr(strrchr($_FILES['syllabus']['name'], '.'), 1);
                if ($extension == "pdf" || $extension == "PDF")
                {
                    $actual_image_name = "syllabus".time().".".$extension;
                    move_uploaded_file($_FILES["syllabus"]["tmp_name"],$target_path.$actual_image_name);
                }
            }

        }else{
            $actual_image_name = $this->input->post('youtube');
        }
        $this->db->insert('admin_content',array('classID'=>$classID,'section_id'=>$section_id,'subjectID'=>$subjectID,'chapterID'=>$chapterID,'type'=>$type,'title'=>$title,'hls'=>$actual_image_name,'is_active'=>$status,'added_on'=>date("Y-m-d H:i:s")));
        redirect(base_url('classes/contents'));

    }
    public function get_contents()
    {
        $classID = $this->input->post('classID');
        $subjectID = $this->input->post('subjectID');
        $chapterID = $this->input->post('chapterID');
        $array1 = array('classID'=>$classID,'subjectID'=>$subjectID,'chapterID'=>$chapterID);
        $contents = $this->dashboard_m->get_multiple_row('admin_content',$array1);
        if(!empty($contents)){
            foreach($contents as $con){
                $this->db->select('subject');
                $subject = $this->db->get_where('admin_subject',array('subID'=>$con->subjectID))->row();
                $con->subjectID = isset($subject->subject) ? $subject->subject :'';

            }
            foreach($contents as $con){
                $this->db->select('chapter_name');
                $chapt = $this->db->get_where('admin_chapter',array('chapterID'=>$con->chapterID))->row();
                $con->chapterID = isset($chapt->chapter_name) ? $chapt->chapter_name :'';

            }
            foreach($contents as $con){
                $this->db->select('class');
                $class_name = $this->db->get_where('admin_class',array('classid'=>$con->classID))->row();
                $con->classID = isset($class_name->class) ? $class_name->class :'';
            }
        }
        echo json_encode($contents);
    }

}