<?php

/*

| -----------------------------------------------------

| PRODUCT NAME:     Tekniko School

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

?>

<!-- .row -->

<div class="row">

    <!-- <div class="col-sm-8">

        <div class="white-box">

            <h3 class="box-title m-b-0"><?=$title?></h3>

            <div class="table-responsive">

                <table id="example23" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>School</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Title</th>
                         <th>Notification</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>School</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Title</th>
                         <th>Notification</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                    $count = 0;
                    foreach ($notification as $notify)
                    {
                        $count++;
                        $school = $this->db->get_where('school_registration',['schoolID '=>$notify->schoolID])->row();

                        ?>
                        <tr>
                            <td><?=$count?></td>
                            <td><?=$school->name?></td>
                            <td><?=$notify->userID?></td>
                            <td><?=$notify->role?></td>
                            <td><?=$notify->title?></td>
                            <td><?=$notify->notification?></td>
                            <td><?php if ($notify->status == '1' ) {
                               echo "Active";
                            }else{
                                echo "Inactive";
                            }  ?></td>
                        </tr>
                    <?php }?>

                    </tbody>

                </table>

            </div>

        </div>

    </div> -->

    <?php //print_r($schools);  ?>

     <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Send Notification</h3>
            <p class="text-muted m-b-30 font-13"> Send Notification </p>
            <form class="form-horizontal" method="post" id="form" action="<?=base_url("/notifications/add_notification")?>">
                  
                <div class="form-group">
                    <label class="col-md-12">Choose School</label>
                    <div class="col-md-12">
                       <select name="schoolID" id="schoolID" class="form-control">
                            <option value="" disabled selected>Select School</option>
                    <?php foreach($schools as $school){ ?>
                           <option value="<?php  echo $school->schoolID; ?>"><?php echo $school->name; ?></option>                          
                    <?php } ?>
                       </select>
                </div>
            </div>

                <div class="form-group">
                    <label class="col-md-12">Choose Role</label>
                    <div class="col-md-12">
                       <select name="role" id="role" class="form-control">
                         <option value="" disabled selected>Select Role</option>
                           <option value="student">Student</option>
                           <option value="teacher">Teacher</option>
                       </select>
                     </div>
                </div>

               <!--  <div class="form-group">
                    <label class="col-md-12">Select User</label>
                    <div class="col-md-12">
                       <select name="user_type_list" id="user_type_list" class="form-control">
                         
                           
                       </select>
                     </div>
                </div> -->

                   <div class="form-group">
                    <label class="col-md-12">Title</label>
                    <div class="col-md-12">
                       <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                     </div>
                </div>

                   <div class="form-group">
                    <label class="col-md-12">Message</label>
                    <div class="col-md-12">
                       <textarea type="text" name="notification" id="notification" class="form-control" placeholder=""></textarea>
                     </div>
                </div>
                
            
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success" value="SUBMIT" id="submit_btn"></div>
                </div>
            </form>
        </div>
    </div>



   



</div>

<!-- /.row -->

<script>
    
    // $('document').ready( function() {
    //     $('#role').on('change',function() {            
    //         var role = this.value;
    //         var data = "role="+role;
    //         if (role != ''){
    //         $.ajax({
    //             url: "<?= base_url("notifications/get_userbyrole")?>",
    //             method: "POST",
    //             data:data,
    //             success:function(res)
    //             {  
    //                 var resp = res.split('|');

    //                if(resp[1] == 'student')
    //                {
    //                     var i, x = "";
    //                     var myObj = JSON.parse(resp[0]);
    //                     for (i in myObj) {
    //                         x += "<option value='" + myObj[i].studentID  + "'>" + myObj[i].name + "</option>";
    //                     }
    //                }
    //                if(resp[1] == 'teacher')
    //                {                     
    //                     var i, x = "";
    //                     var myObj = JSON.parse(resp[0]);
    //                     for (i in myObj) {
    //                         x += "<option value='" + myObj[i].teacherID  + "'>" + myObj[i].name + "</option>";
    //                     }
    //                }                  
    //             document.getElementById("user_type_list").innerHTML = x;
    //             }
    //         });
    //     }

    //     });
    // });
</script>

