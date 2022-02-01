<?php

/*

| -----------------------------------------------------

| PRODUCT NAME:     MENTOR ERP

| -----------------------------------------------------

| AUTHOR:           Kshitij Kumar Singh

| -----------------------------------------------------

| EMAIL:            kshitij.singh@teknikoglobal.com

| -----------------------------------------------------

| COPYRIGHT:        RESERVED BY TEKNIKOGLOBAL

| -----------------------------------------------------

| WEBSITE:          https://www.teknikoglobal.com

| -----------------------------------------------------

*/



class Content extends MY_Controller

{

    function __construct()

    {

        parent::__construct();

        $this->load->model("signin_m");

        $this->load->model("configuration_m");

        $this->load->model("fcm_m");

    }

    public function index(){

        if ($_SESSION['role'] == "school"){

            $array1 = array('schoolID'=>$_SESSION['loginUserID']);

            $get_conf = $this->configuration_m->get_single_row('school_config',$array1);

            /*if (count($get_conf)){*/
                if ($get_conf){

                if ($_POST)

                {

                    $this->db->where(array('configID'=>$get_conf->configID));

                    $this->db->update('school_config',$_POST);

                    redirect(base_url("configuration/index"));

                }else{

                    $this->data['is_config'] = "Y";

                    $this->data['configuration'] = $get_conf;

                    $this->data['title'] = "School Setup";

                    $this->data['subview'] = "school/index";

                    $this->load->view("layout",$this->data);

                }

            }else{

                $this->data['is_config'] = "N";

                $this->data['title'] = "School Setup";

                $this->data['subview'] = "school/index";

                $this->load->view("layout",$this->data);

            }



        }



    }

    public function contents()
    {
        if ($_SESSION['role'] == "school")
        {
            $schoolID = $_SESSION['loginUserID'];
            $this->data['classes'] = $this->configuration_m->get_multiple_row('classes',array('schoolID'=>$schoolID,'is_active'=>'Y'));

            $this->data['title'] = "Contents";
            $this->data['subview'] = "school/content";
            $this->load->view("layout",$this->data);
        }
    }
    public function classes($param1 = '',$param2 = ''){

        if ($_SESSION['role'] == "school"){

            $array1 = array('schoolID'=>$_SESSION['loginUserID']);

            if ($param1 == 'edit' && $param2 != '')

            {

                $classID = $param2;

                if ($_POST)

                {

                    $array2 = array('class'=>$this->input->post('class'),

                        'is_active'=>$this->input->post('is_active')

                    );

                    $this->db->where(array('classID'=>$classID));

                    $this->db->update('classes',$array2);

                    redirect(base_url('configuration/classes'));

                }

            }else{

                if ($_POST)

                {

                    $array2 = array('schoolID'=>$_SESSION['loginUserID'],

                        'class'=>$this->input->post('class'),

                        'is_active'=>$this->input->post('is_active'),

                        'added_on' => date("Y-m-d H:i:s")

                    );

                    $this->db->insert('classes',$array2);

                    redirect(base_url('configuration/classes'));

                }else{

                    $this->data['classes'] = $this->configuration_m->get_multiple_row('classes',$array1);

                    $this->data['title'] = "Classes";

                    $this->data['subview'] = "school/classes";

                    $this->load->view("layout",$this->data);

                }

            }





        }



    }
    public function add_content()
    {
        if ($_SESSION['role'] == "school")
        {
            $schoolID = $_SESSION['loginUserID'];
            $classID = $this->input->post('add_classID');
            $sectionID = $this->input->post('add_sectionID');
            $subject_name = $this->input->post('subject_name');
            $subject_code = $this->input->post('subject_code');
            $type = $this->input->post('type');
            $status = $this->input->post('is_active');
            $target_path = "uploads/subject/"; // replace this with the path you are going to save the file to
            $target_dir = "uploads/subject/";
            $actual_image_name = "default.pdf";
            if(file_exists($_FILES["syllabus"]["tmp_name"]))
            {
                $target_file = $target_dir . basename($_FILES["syllabus"]["name"]);
                foreach($_FILES as $fileKey => $fileVal)
                {
//                    $imagename = basename($_FILES["syllabus"]["name"]);
                    $extension = substr(strrchr($_FILES['syllabus']['name'], '.'), 1);
                    if ($extension == "pdf" || $extension == "PDF")
                    {
                        $actual_image_name = "syllabus".time().".".$extension;
                        move_uploaded_file($_FILES["syllabus"]["tmp_name"],$target_path.$actual_image_name);
//                        $this->db->where(array('subjectID'=>$subjectID));
//                        $this->db->update('subject',array('syllabus'=>$actual_image_name));
                    }

                }

            }
            foreach ($sectionID as $sectionID){
                $this->db->insert('subject',array('schoolID'=>$schoolID,'classID'=>$classID,'sectionID'=>$sectionID,'subject_name'=>$subject_name,'subject_code'=>$subject_code,'type'=>$type,'syllabus'=>$actual_image_name,'is_active'=>$status,'added_on'=>date("Y-m-d H:i:s")));
            }
            redirect(base_url('configuration/subject'));

        }
    }
     public function edit_content($content_id)

    {
        if (strtolower($_SESSION['role']) == 'school')

        {

            if ($_POST) {

                    $content_id = $content_id;
                    $schoolID = $_SESSION['loginUserID'];
                    $is_active = $this->input->post('is_active');
                   

                    $this->db->where(array('id'=>$content_id));
                    $this->db->update('subject_wise_content',array('is_active'=>$is_active));
                    

                   redirect('content/contents');

                }else{

                     $schoolID = $_SESSION['loginUserID'];
                    $this->data['classes'] = $this->db->get_where('classes',array('schoolID'=>$schoolID))->result();
                     $this->data['subjects'] = $this->db->get_where('subject',array('schoolID'=>$schoolID))->result();
                      $this->data['chapters'] = $this->db->get_where('chapters',array('schoolID'=>$schoolID))->result();
                    $this->data['content'] = $this->db->get_where('subject_wise_content',array('id'=>$content_id,'schoolID'=>$schoolID))->row();
                      /* var_dump($this->data['content']);
                    echo $this->db->last_query();
                    die();*/
                    $this->data['title'] = "Edit contents";

                    $this->data['subview'] = "school/edit_content";


                    $this->load->view("layout",$this->data);

                }

            

        }

    }
     public function edit_content11($content_id)

    {
        if (strtolower($_SESSION['role']) == 'school')

        {

            if ($_POST) {

                    $content_id = $content_id;
                    $schoolID = $_SESSION['loginUserID'];
                    $schoolID =  $schoolID;
                    $classID = $this->input->post('classID');
                    $subjectID = $this->input->post('subjectID');
                    $chapterID = $this->input->post('chapterID');
                    $type = $this->input->post('type');
                    $hls = $this->input->post('hls');
                    $title = $this->input->post('title');
                    $status = $this->input->post('is_active');


                    /*if ($type == 'pdf') {
                        if (!empty($_FILES['hls']['name'])){
                            $target_path = 'uploads/contents/';
                            $extension = substr(strrchr($_FILES['hls']['name'], '.'), 1);
                            $actual_image_name = 'hls'. time() . "." . $extension;
                            move_uploaded_file($_FILES["hls"]["tmp_name"],$actual_image_name);
                            $file = $actual_image_name;

                        }
                    }else{
                        $file =  $this->input->post('hls');
                    }


                 */
                    /* echo "<pre>";
                     print_r($_POST);*/

                    $this->db->where(array('id'=>$content_id));
                    $this->db->update('subject_wise_content',array('schoolID'=>$schoolID,'classID'=>$classID,'subjectID'=>$subjectID,'chapterID'=>$chapterID,'type'=>$type,'title'=>$title,'hls'=>$hls,'is_active'=>$status));

                   redirect('content/contents');

                }else{

                     $schoolID = $_SESSION['loginUserID'];
                    $this->data['classes'] = $this->db->get_where('classes',array('schoolID'=>$schoolID))->result();
                     $this->data['subjects'] = $this->db->get_where('subject',array('schoolID'=>$schoolID))->result();
                      $this->data['chapters'] = $this->db->get_where('chapters',array('schoolID'=>$schoolID))->result();
                    $this->data['content'] = $this->db->get_where('subject_wise_content',array('id'=>$content_id,'schoolID'=>$schoolID))->row();
                      /* var_dump($this->data['content']);
                    echo $this->db->last_query();
                    die();*/
                    $this->data['title'] = "Edit contents";

                    $this->data['subview'] = "school/edit_content";


                    $this->load->view("layout",$this->data);

                }

            

        }

    }
   

    public function get_contents_by_id(){

    $contentID   = !empty($this->input->post('contentID')) ? $this->input->post('contentID') : "";

    $d = $this->db->get_where('subject_wise_content',array('contentID'=>$contentID))->row();

    if ($d) {
        echo json_encode(array('status'=>true,'data'=>$d)); 
    }else{
        echo json_encode(array('status'=>false,'data'=>''));   

    }

}


    public function update_subject($param = "")
    {
        if ($_SESSION['role'] == "school")
        {
            if ($param != "")
            {
                $subjectID = $param;
                $schoolID = $_SESSION['loginUserID'];
                $subject_name = $this->input->post('subject_name');
                $subject_code = $this->input->post('subject_code');
                $type = $this->input->post('type');
                $status = $this->input->post('is_active');
                $this->db->where(array('subjectID'=>$subjectID));
                $this->db->update('subject',array('schoolID'=>$schoolID,'subject_name'=>$subject_name,'subject_code'=>$subject_code,'type'=>$type,'is_active'=>$status));

                $target_path = "uploads/subject/"; // replace this with the path you are going to save the file to
                $target_dir = "uploads/subject/";
                if(file_exists($_FILES["syllabus"]["tmp_name"]))
                {
                    foreach($_FILES as $fileKey => $fileVal)
                    {
                        $extension = substr(strrchr($_FILES['syllabus']['name'], '.'), 1);
                        if ($extension == "pdf" || $extension == "PDF")
                        {
                            $actual_image_name = "syllabus".time().".".$extension;
                            move_uploaded_file($_FILES["syllabus"]["tmp_name"],$target_path.$actual_image_name);
                            $this->db->where(array('subjectID'=>$subjectID));
                            $this->db->update('subject',array('syllabus'=>$actual_image_name));
                        }

                    }

                }
                echo "success";
                //redirect(base_url("configuration/subject"));

            }
        }

    }


    public function submit_content()
    {
        if ($_SESSION['role'] == "school")
        {
            $schoolID = $_SESSION['loginUserID'];
            $classID = $this->input->post('classID1');
            $sectionID = $this->input->post('sectionID1');
            $subjectID = $this->input->post('subjectID1');
            $chapterID = $this->input->post('chapterID1');
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
//                    $imagename = basename($_FILES["syllabus"]["name"]);
                    $extension = substr(strrchr($_FILES['syllabus']['name'], '.'), 1);
                    if ($extension == "pdf" || $extension == "PDF")
                    {
                        $actual_image_name = "syllabus".time().".".$extension;
                        move_uploaded_file($_FILES["syllabus"]["tmp_name"],$target_path.$actual_image_name);
//                        $this->db->where(array('subjectID'=>$subjectID));
//                        $this->db->update('subject',array('syllabus'=>$actual_image_name));
                    }

                }

            }else{
                $actual_image_name = $this->input->post('youtube');
            }
            foreach ($sectionID as $sectionID){
                $this->db->insert('subject_wise_content',array('schoolID'=>$schoolID,'classID'=>$classID,'sectionID'=>$sectionID,'subjectID'=>$subjectID,'chapterID'=>$chapterID,'type'=>$type,'title'=>$title,'hls'=>$actual_image_name,'is_active'=>$status,'added_on'=>date("Y-m-d H:i:s")));
            }
            redirect(base_url('content/contents'));

        }
    }


    public function section($param1 = '',$param2 = ''){

        if ($_SESSION['role'] == "school"){

            $this->data['classes'] = $this->configuration_m->get_multiple_row('classes',array('schoolID'=>$_SESSION['loginUserID'],'is_active'=>"Y"),'classID,class');

            $this->data['teacher'] = $this->configuration_m->get_multiple_row('teacher',array('schoolID'=>$_SESSION['loginUserID'],'is_active'=>"Y"),'teacherID,name');

            $array1 = array('section.schoolID'=>$_SESSION['loginUserID']);



            if ($param1 == 'edit' && $param2 != '')

            {

                $sectionID = $param2;

                if ($_POST)

                {

                    $array2 = array(

                        'classID'=>$this->input->post('classID'),

                        'section'=>$this->input->post('section'),

                        'class_teacherID'=>$this->input->post('class_teacherID'),

                        'is_active'=>$this->input->post('is_active')

                    );

                    $this->db->where(array('sectionID'=>$sectionID));

                    $this->db->update('section',$array2);

                    redirect(base_url('configuration/section'));

                }else{

                    $this->data['section'] = $this->configuration_m->get_single_row('section',array('sectionID'=>$sectionID));

                    $this->data['title'] = "Update Section";

                    $this->data['subview'] = "school/section";

                    $this->load->view("layout",$this->data);

                }



            }else{

                if ($_POST)

                {

                    $array2 = array('section.schoolID'=>$_SESSION['loginUserID'],

                        'classID'=>$this->input->post('classID'),

                        'section'=>$this->input->post('section'),

                        'class_teacherID'=>$this->input->post('class_teacherID'),

                        'is_active'=>$this->input->post('is_active'),

                        'added_on' => date("Y-m-d H:i:s")

                    );

                    $this->db->insert('section',$array2);

                    redirect(base_url('configuration/section'));

                }else{

                    $this->data['section'] = $this->configuration_m->get_section($array1);

                    $this->data['title'] = "Section";

                    $this->data['subview'] = "school/section";

                    $this->load->view("layout",$this->data);

                }

            }





        }



    }

    public function get_sectionbyclass()

    {

        if ($_POST){

            $schoolID = $_SESSION['loginUserID'];

            $classID = $this->input->post('classID');

            $section = $this->db->get_where('section',array('classID'=>$classID , 'schoolID'=>$schoolID))->result();

            echo json_encode($section);

        }

    }



    public function get_subjectbysection()

    {

        if ($_POST){

            $schoolID = $_SESSION['loginUserID'];

            $classID = $this->input->post('classID');

            $sectionID = $this->input->post('sectionID');



            $subjects = $this->db->get_where('subject',array('classID'=>$classID , 'schoolID'=>$schoolID,'sectionID'=>$sectionID))->result();

            echo json_encode($subjects);

        }

    }
    public function get_chapterbysubject()

    {

        if ($_POST){

            $schoolID = $_SESSION['loginUserID'];
            $classID = $this->input->post('classID');
            $sectionID = $this->input->post('sectionID');
            $subjectID = $this->input->post('subjectID');

            $chapters = $this->db->get_where('chapters',array('classID'=>$classID , 'schoolID'=>$schoolID,'sectionID'=>$sectionID,'subjectID'=>$subjectID))->result();
            //echo $this->db->last_query();
            echo json_encode($chapters);

        }

    }


    public function get_chapterbysubject_re()

    {

        if ($_POST){

            $schoolID = $_SESSION['loginUserID'];
            $classID = $this->input->post('classID');
            $sectionID = $this->input->post('sectionID');
            $subjectID = $this->input->post('subjectID');

            $chapters = $this->db->get_where('chapters',array('classID'=>$classID , 'schoolID'=>$schoolID,'subjectID'=>$subjectID))->result();
            //echo $this->db->last_query();
            echo json_encode($chapters);

        }

    }



    public function get_subjectbyclass()

    {

        if ($_POST){

            $schoolID = $_SESSION['loginUserID'];

            $classID = $this->input->post('classID');

            $subjects = $this->db->get_where('subject',array('classID'=>$classID , 'schoolID'=>$schoolID))->result();
//echo $this->db->last_query();
            echo json_encode($subjects);

        }

    }


    public function chapter()

    {

        if ($_SESSION['role'] == "school")

        {

            $schoolID = $_SESSION['loginUserID'];

            $this->data['classes'] = $this->configuration_m->get_multiple_row('classes',array('schoolID'=>$schoolID,'is_active'=>'Y'));

            $this->data['title'] = "Chapter";

            $this->data['subview'] = "school/chapter";

            $this->load->view("layout",$this->data);

        }

    }





    public function get_contents()

    {

        if ($_SESSION['role'] == "school")

        {

            $schoolID = $_SESSION['loginUserID'];

            $classID = $this->input->post('classID');
            $sectionID = $this->input->post('sectionID');
            $subjectID = $this->input->post('subjectID');
            $chapterID = $this->input->post('chapterID');

            $array1 = array('schoolID'=>$schoolID,'classID'=>$classID,'sectionID'=>$sectionID,'subjectID'=>$subjectID,'chapterID'=>$chapterID);

            $contents = $this->configuration_m->get_multiple_row('subject_wise_content',$array1);
            if(!empty($contents)){
                foreach($contents as $con){
                    $this->db->select('subject_name');
                    $subject = $this->db->get_where('subject',array('subjectID'=>$con->subjectID))->row();
                    $con->subjectID = isset($subject->subject_name) ? $subject->subject_name :'';

                }
                foreach($contents as $con){
                    $this->db->select('chapter_name');
                    $chapt = $this->db->get_where('chapters',array('chapterID'=>$con->chapterID))->row();
                    $con->chapterID = isset($chapt->chapter_name) ? $chapt->chapter_name :'';

                }
                foreach($contents as $con){
                    $this->db->select('class');
                    $class_name = $this->db->get_where('classes',array('classID'=>$con->classID))->row();
                    $con->classID = isset($class_name->class) ? $class_name->class :'';

                }

              /* echo "<pre>";
            print_r($contents);*/
        }
        

            echo json_encode($contents);

        }



    }







    public function get_subjects()

    {

        if ($_SESSION['role'] == "school")

        {

            $schoolID = $_SESSION['loginUserID'];

            $classID = $this->input->post('classID');

            $sectionID = $this->input->post('sectionID');

            $array1 = array('schoolID'=>$schoolID,'classID'=>$classID,'sectionID'=>$sectionID);

            $subject = $this->configuration_m->get_multiple_row('subject',$array1);

            echo json_encode($subject);

        }



    }


}