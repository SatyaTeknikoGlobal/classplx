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
class School extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("signin_m");
        $this->load->model("dashboard_m");
        $this->load->library('SSP');
        $this->load->library('encryption');

    }
    public function hash($string) {
        return hash("sha512", $string . config_item("encryption_key"));
    }
    public function send_sms($mobile, $message){
        $sender = "TESTIN";
        $message = urlencode($message);

        $msg = "sender=".$sender."&route=4&country=91&message=".$message."&mobiles=".$mobile."&authkey=285140A0X8iGTZqowq5d2adb8b";

        $ch = curl_init('http://api.msg91.com/api/sendhttp.php?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        $result = curl_close($ch);
        return $res;
    }
    public function index(){
        if (strtolower($_SESSION['role']) == "admin"){
            $this->data['title'] = "Schools";
            $this->data['subview'] = "member/school";
            $this->load->view("layout",$this->data);
        }
    }
    public function list_school()
    {
        if ($_SESSION['role'] == "admin") {
            $table = "(select `school_registration`.`schoolID`,`school_registration`.`school_code`,`school_registration`.`name` as admin,`school_registration`.`email`,school_registration.phone,`school_registration`.`is_approved`,school_registration.image,school_registration.added_on,school_registration.subscription_status,school_config.school_name as school  FROM school_registration left join school_config on school_registration.schoolID = school_config.schoolID order by school_registration.added_on DESC)as table1";

            $primaryKey = 'schoolID';
            $columns = array(
                array( 'db' => 'image',
                    'dt' => 0,
                    'formatter' => function( $d, $row ) {
                        if (is_null($d) || $d == ""){
                            return "<img class='img-rounded' height = '70px' src=".base_url1('uploads/images').'/default.png'.">";
                        }else{
                            return "<img class='img-rounded' height = '70px' src=".base_url1('uploads/images').'/'.$d.">";
                        }
                    }
                ),
                array( 'db' => 'school_code','dt' => 1 ),
                array( 'db' => 'school','dt' => 2 ),
                array( 'db' => 'admin','dt' => 3 ),
                array( 'db' => 'email', 'dt' => 4 ),
                array( 'db' => 'phone', 'dt' => 5 ),
                array( 'db' => 'is_approved', 'dt' => 6 ),
                array( 'db' => 'added_on',
                    'dt' => 7,
                    'formatter' => function( $d, $row ) {
                        return date("Y-m-d",strtotime($d));
                    }
                ),
                /*array( 'db' => 'subscription_status','dt' => 7),*/
                array( 'db' => 'schoolID',
                    'dt' => 8,
                    'formatter' => function( $d, $row ) {
                        return "<a class='btn btn-success' title='view school' target='_blank' href='".base_url('school/view/').$d."'><i class='fa fa-eye'></i></a>
                        &nbsp;&nbsp;
                        <a title='visit portal' class='btn btn-primary' target='_blank' href='".base_url1('login/support_school/').$d.'/'.$this->signin_m->hash($d)."'><i class='fa fa-sign-in-alt'></i></a>
                        &nbsp;&nbsp;
                        <a class='btn btn-success' title='Approve school' href='".base_url('school/approve_school/').$d."'><i class='fa fa-edit'></i></a>";




                    }
                )
            );

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );


            $response = SSP::complex_kshitij( $_GET, $sql_details, $table, $primaryKey, $columns);

            echo json_encode($response);

        }

    }
    public function view($param = ''){
        if (strtolower($_SESSION['role']) == "admin"){
            if ($param != ''){
                $path = base_url1('uploads/images/');
                $schoolID = $param;
                $this->db->select("school_config.*,school_registration.name as admin_name,school_registration.phone as admin_phone, school_registration.email as admin_email,school_registration.address as admin_address,school_registration.school_code,school_registration.username,school_registration.subscription_status, CONCAT('".$path."',COALESCE(NULLIF(school_registration.image, ''),'default.png')) as image");
                $this->db->join('school_config','school_registration.schoolID = school_config.schoolID','LEFT');
                $school = $this->db->get_where('school_registration',array('school_registration.schoolID'=>$schoolID))->row();
                $this->data['student']= $this->db->query("SELECT count(*) as count from student where schoolID=$schoolID")->row();
                $this->data['active_student']= $this->db->query("SELECT count(*) as count from student where schoolID=$schoolID AND is_active='Y'")->row();
                $this->data['teacher']= $this->db->query("SELECT count(*) as count from teacher where schoolID=$schoolID")->row();
                $this->data['active_teacher']= $this->db->query("SELECT count(*) as count from teacher where schoolID=$schoolID AND is_active='Y'")->row();
                $this->data['parent']= $this->db->query("SELECT count(*) as count from student where schoolID=$schoolID AND parentID is not null AND parentID != ''")->row();
                $this->data['active_parent']= $this->db->query("SELECT count(*) as count from student LEFT join parent on student.parentID = parent.parentID where student.parentID is not null AND student.schoolID=$schoolID AND student.is_active = 'Y' AND parent.is_active='Y'")->row();
                $this->data['school'] = $school;
                $this->data['title'] = "$school->school_name";
                $this->data['subview'] = "member/school_view";
                $this->load->view("layout",$this->data);
            }
        }
    }
    public function approve_school() {
        $schoolID = $this->uri->segment(3);
        if ($_POST)
        {
            $data = $_POST;
            $is_approved = $data['is_approved'];

            $array = array(
              "is_approved" =>  $is_approved,
              "modified_on" => date('Y-m-d H:i:s'),
          );
            $this->db->where(array('schoolID'=>$schoolID));
            $this->db->update('school_registration',array('schoolID'=>$schoolID,'is_approved'=>$is_approved));
            if ($is_approved == 'Y') {

                $this->add_class($schoolID);


                /////////////////Add role /////////

                $exist = $this->db->get_where('other_roles',array('schoolID'=>$schoolID,'role'=>'Accountant'))->row();
                if(empty($exist)){
                    $this->db->insert('other_roles',array(
                        'schoolID' => $schoolID,
                        'role' => 'Accountant',
                        'modules' => '7',
                    ));
                }


                /////////////////Add role /////////











                $school = $this->db->query("SELECT * from school_registration where schoolID=$schoolID")->row();
                $phone =  $school->phone;
                $email =  $school->email;
                $school_code =  $school->school_code;
                $password =  $school->real_password;
                $username =  $school->username;

                $subject = "School Registration";
                $message = "Thank You For registering as ".strtoupper($role)." with us.\n Your 'Username' is $username.";
               $this->send_sms($phone, $message);
               $this->send_mail($email,$subject,$message);
                
            }
            redirect(base_url('school'));

        }else{

            $this->data['school']= $this->db->query("SELECT * from school_registration where schoolID=$schoolID")->row();
            $this->data['title'] = "Approve Schools";
            $this->data['subview'] = "member/approve_school";
            $this->load->view("layout",$this->data);
        }
    }




    public function bulk_insert(){
        $schools = $this->db->get_where('school_registration',['is_approved'=>'Y'])->result();
        if(!empty($schools)){
            foreach($schools as $school){
                $this->add_class($school->schoolID);
            }
        }
    }



    public function add_class($schoolID){
        $classes = $this->db->get_where('admin_class',array('is_active'=>'Y'))->result();
        if(!empty($classes)){
            foreach($classes as $class){

                $exist = $this->db->get_where('classes',['schoolID'=>$schoolID,'class'=>$class->class])->row();
                if(empty($exist)){
                    $dbArray = [];
                    $dbArray['schoolID'] = $schoolID;
                    $dbArray['class'] = $class->class;
                    $dbArray['is_active'] = 'Y';

                    $this->db->insert('classes', $dbArray);
                }
            }
        }
    }

    public function send_mail11($email,$subject,$message){
        $to = $email;
        $from = 'anisha@teknikoglobal.com';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.'Classplx'."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)){
            return true;
           /* echo 'Your mail has been sent successfully.';
           die();*/
       } else{
        return false;
           //echo 'Unable to send email. Please try again.';
    }
}
public function send_mail($email,$subject,$message){
    $this->load->library('email');

    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","587");
    $config = array();
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_user'] = 'techhub921@gmail.com';
    $config['smtp_pass'] = 'TechHub96@';
    $config['smtp_port'] = 587;
    $config['newline'] = "\r\n";
    $config['smtp_crypto'] = 'tls'; 

    $this->email->initialize($config);


    $from_email = "anishashrivastava20@gmail.com";
    //$to_email = 'satyatekniko@gmail.com';
        //Load email library
    $this->load->library('email');
    $this->email->from($from_email, 'Classplx');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
        //Send mail
    if($this->email->send())
     return true;
 else
     return false;

}






}