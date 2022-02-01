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
class Notifications extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("signin_m");
        $this->load->model("dashboard_m");
    }

    public function index()
    {
       $this->data['notification']= $this->dashboard_m->get_multiple_row('notification',array('status'=>1));
       $this->data['schools']= $this->dashboard_m->get_multiple_row('school_registration',array('is_active'=>'Y'));
       $this->data['title'] = "Notifications";
       $this->data['subview'] = "member/notification";
       $this->load->view("layout",$this->data);
   }



   public function add_notification()
   {
    $role = $this->input->post('role');
    $schoolID = $this->input->post('schoolID');
    $title = $this->input->post('title');
    $notification = $this->input->post('notification');

    if($role == 'teacher'){
        $teachers = $this->dashboard_m->get_multiple_row('teacher',array('schoolID'=>$schoolID,'is_active'=>'Y'));
        if(!empty($teachers)){
            foreach($teachers as $teacher){
                $devices = $this->db->get_where('user_login',['role'=>$role,'userID'=>$teacher->teacherID])->result();
                if(!empty($devices)){
                    foreach($devices as $device){
                        $data1 = '{"notification_type":"text","title":"'.$title.'","msg":"'.$notification.'","type":"group_notification","role":"teacher"}';
                        $data1 = array("m" => $data1);
                        $success = $this->fcmNotification($device->deviceID, $data1);
                        // if($success){

                        // }

                    }
                }
                $data = array(
                    'schoolID' => $schoolID,
                    'role' => $role, 
                    'userID' => $teacher->teacherID,                    
                    'title' => $title,
                    'notification' => $notification,
                    'status' => 1
                );
                $this->db->insert('notification',$data);
            }
        }
    }


    if($role == 'student'){
        $student = $this->dashboard_m->get_multiple_row('student',array('schoolID'=>$schoolID,'is_active'=>'Y'));

        if(!empty($student)){
            foreach($student as $stud){
                $devices = $this->db->get_where('user_login',['role'=>$role,'userID'=>$stud->studentID])->result();
                if(!empty($devices)){
                    foreach($devices as $device){
                        $data1 = '{"notification_type":"text","title":"'.$title.'","msg":"'.$notification.'","type":"group_notification","role":"stud"}';
                        $data1 = array("m" => $data1);
                        $success = $this->fcmNotification($device->deviceID, $data1);
                        // if($success){

                        // }

                    }
                }


                $data = array(
                    'schoolID' => $schoolID,
                    'role' => $role, 
                    'userID' => $stud->studentID,                    
                    'title' => $title,
                    'notification' => $notification,
                    'status' => 1
                );
                $this->db->insert('notification',$data);


            }
        }
    }



    redirect('notifications/'); 
}

public function fcmNotification($device_id, $sendDetails)
{
    if (!defined('API_ACCESS_KEY')){
        define('API_ACCESS_KEY', 'AAAAWhbEet8:APA91bEEl6s1yeYOQKKU3aja5MIJoTa41aFs6ixzcaCjZTUJn2GiSyHGjrEi9OO1RopM3obNyCCFUVGpnjavQcxI_J7atHjyNsWw0HGFF7SWbVDbY__hkFgDIzhBHmpe5CKLcxZ2wpBu');
    }

    $fields = array
    (
        'to'        => $device_id,
        'data'  => $sendDetails,
        'notification'  => $sendDetails
    );


    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
#Send Reponse To FireBase Server
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch);
//$data = json_decode($result);
    if($result === false)
       die('Curl failed ' . curl_error($ch));

   curl_close($ch);
   return $result;
}



}