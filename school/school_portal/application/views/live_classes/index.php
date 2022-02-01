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
?>


<!-- .row -->
<div class="row">
    <div class="col-sm-4">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Live Class</h3>
            <p class="text-muted m-b-30 font-13"></p>
            <form class="form-horizontal" method="post">
             

                <div class="form-group">
                    <label class="col-md-12">Class<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <select class="form-control" name="class_id" id="class_id">
                                <option value="" selected disabled>Select Class</option>
                                <?php
                                   if(!empty($class_details)){
                                 foreach ($class_details as $c) {                                        
                                ?>
                                <option value="<?php echo $c->classID?>"><?=$c->class?> <!--  <?php echo $c->classID?> --></option>
                                <?php } }?>
                            </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Section<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <select class="form-control" name="section_id" id="section_id">
                                <option value="" selected disabled>Select Section</option>                              
                            </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Subject<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                          <select class="form-control" name="subject_id" id="subject_id">
                                <option value="" selected disabled>Select Subject</option>                               
                            </select>
                    </div>
                </div>

                 <?php //print_r($teacher_details); ?>
                 <div class="form-group">
                    <label class="col-md-12">Teacher<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                            <select class="form-control" name="teacher_id" id="teacher_id">
                                <option value="" selected disabled>Select Teacher</option>
                                 <?php
                                   if(!empty($teacher_details)){
                                 foreach ($teacher_details as $t) {                                        
                                ?>
                                <option value="<?php echo $t->teacherID?>"><?=$t->name?></option>
                                <?php } }?>                                
                            </select>

                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Title<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Start Date<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="date" name="start_date" id="start_date" class="form-control"  placeholder="Enter Start Date">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">End Date<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <input type="date" name="end_date" id="end_date" class="form-control"  placeholder="Enter End Date">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Start Time<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <input type="time" name="start_time" id="start_time" class="form-control"  placeholder="Enter Start Time">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">End Time<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <input type="time" name="end_time" id="end_time" class="form-control"  placeholder="Enter End Time">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Type <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                      <select class="form-control" name="type" id="type">
                        <option value="" selected disabled>Select Type</option>
                            <option value="youtube">Youtube</option>                          

                      </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Channel<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <input type="text" name="channel_id" id="channel_id" class="form-control"  placeholder="Enter Channel">
                    </div>
                </div>

              <!--    <div class="form-group">
                    <label class="col-md-12">Password<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password">
                    </div>
                </div> -->
               <!--  <div class="form-group">
                    <label class="col-md-12">Exam Date <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group date" id="datepicker1">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" required class="form-control" name="exam_date" id="exam_date" placeholder="e.g., 2018-01-20 ">
                    </div>
                </div> -->
               <!--  <div class="form-group">
                    <label class="col-sm-12">Classes <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group">
                        <select class="selectpicker form-control" name="classes[]" id="classes" required multiple >
                           
                                <option value=""></option>
                                               </select>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="white-box">
             <h3 class="box-title m-b-0"><?=$title?></h3>
            <div class="table-responsive">

               
                <table id="exam_table" class="display table table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-2">Title</th>
                        <th class="col-sm-2">Start Date</th>
                        <th class="col-sm-2">Start Time</th>
                        <th class="col-sm-2">End Date</th>
                        <th class="col-sm-2">End Time</th>                       
                        <th class="col-sm-3">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                         <?php foreach($live_classes as $lc){ ?> 
                        <tr>                       
                 
                            <td><?=$lc->id?></td>
                            <td><?=$lc->title?></td>
                            <td><?=$lc->start_date?></td>
                            <td><?=$lc->start_time?></td>
                            <td><?=$lc->end_date?></td>
                            <td><?=$lc->end_time?></td>
                            <td>
                                <?php

                                $html = '';

                                $html.= '<p><a class="btn btn-primary btn-sm" id="edit_class" href = "' . base_url("live_classes/edit/$lc->id") . '"><i class="fa fa-edit"></i></a>&nbsp;
                                <a class="btn btn-danger btn-sm" id="delete_class" onclick="return confirm(\'Are you sure want to delete this ?\');" href = "' . base_url("live_classes/delete/$lc->id") . '"><i class="fa fa-trash"></i></a></p>';

                                echo $html;

                                ?>
                                
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.row -->
<script>

    $('document').ready(function () {
        $('#class_id').change(function () {
            var class_id = $(this).val();
            var data = "class_id="+class_id;
            if (class_id != ''){
                $.ajax({
                    url: "<?= base_url("live_classes/get_section")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {  

                        var i, x = "";
                        var myObj = JSON.parse(res);
                        x += "<option value=''>Select Section</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].sectionID + "'>" + myObj[i].section + "</option>";
                        }
                        document.getElementById("section_id").innerHTML = x;
                    }
                });
            }
        });
    });



 $('document').ready(function () {
        $('#section_id').change(function () {
            var class_id = $('#class_id').val();
            var section_id = $(this).val();
            // var data = "class_id="+class_id+ "section_id="+section_id;
            //alert("data = "+data);
            if (class_id != ''){
                $.ajax({
                    url: "<?= base_url("live_classes/get_subject")?>",
                    method: "POST",
                    data:{class_id:class_id,section_id:section_id},
                    success:function(res)
                    {   
             
                        var i, x = "";
                        var myObj = JSON.parse(res);
                         // console.log("objects = "+myObj);
                        x += "<option value=''>Select Subject</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].subjectID   + "'>" + myObj[i].subject_name + "</option>";
                        }
                        document.getElementById("subject_id").innerHTML = x;
                    }
                });
            }
        });
    });



</script>

