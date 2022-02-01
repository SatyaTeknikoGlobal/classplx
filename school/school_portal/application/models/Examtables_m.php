<?php  
class Examtables_m extends CI_Model  
{  
 
  var $table = "exam_section";  
  var $select_column = array("id","school_id","class_id","section_id","subject_id","title","start_date","status"); 


  var $order_column = array("id","school_id","class_id","section_id","subject_id","title","start_date","status");

  
  function make_query()  
  {  
   $this->db->select($this->select_column);  
   $this->db->from($this->table);  
   if(isset($_POST["search"]["value"]))  
   {  
   // $this->db->like("name", $_POST["search"]["value"]);  
    //$this->db->or_like("name", $_POST["search"]["value"]);  
  }  
  if(isset($_POST["order"]))  
  {  
    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
  }  
  else  
  {  
    $this->db->order_by('ID', 'DESC');  
  }  
}  
function make_datatables(){  
 $this->make_query();  
 if($_POST["length"] != -1)  
 {  
  $this->db->limit($_POST['length'], $_POST['start']);  
}  

$query = $this->db->get();  
return $query->result();  
}  
function get_filtered_data(){  
 $this->make_query();  
 $query = $this->db->get();  
 return $query->num_rows();  
}       
function get_all_data()  
{  
 $this->db->select("*");  
           //$this->db->where($st, 1);  
 $this->db->from($this->table);  
 return $this->db->count_all_results();  
}  
}  