<?php
/*
| -----------------------------------------------------
| PRODUCT NAME: 	Tekniko School
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
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">SELECT CLASS AND SECTION</h3>
            <p class="text-muted m-b-30 font-13"> SELECT CLASS AND SECTION AND CLICK ON VIEW </p>
            <div class="form-inline">
                <div class="col-sm-5">
                    <label class="col-sm-3">Class : </label>
                    <div class="col-sm-8">
                        <select class="form-control" style="width: 100%" name="classID" id="classID1" required>
                            <option value="">--SELECT--</option>
                            <?php foreach ($classes as $c){ ?>
                                <option value="<?=$c->classid?>"><?=$c->class?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="col-md-12">
                        <button class="btn btn-success" onclick="viewSubject_new1()"> View </button>
                    </div>
                    <p id="demo"></p>
                </div>
            </div>
            <h3>&nbsp;</h3>
        </div>
    </div>

</div>
<!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="col-sm-8">
        <div class="white-box">
            <h3 class="box-title m-b-0"><?=$title?></h3>


            <div class="table-responsive">
                <table id="subject_table1" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">
                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Subject</h3>
            <p class="text-muted m-b-30 font-13"> Add Subject </p>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form" action="<?=base_url("/classes/add_subject")?>">
                  <div class="form-group">
                    <label class="col-sm-12">Class</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="add_classID" id="add_classID1" required>
                            <option value="">--SELECT--</option>
                            <?php foreach ($classes as $c){ ?>
                                <option value="<?=$c->classid?>"><?=$c->class?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Subject Name<span class="help"></span></label>
                    <div class="col-md-12">
                        <input type="text" required class="form-control" name="subject" id="subject_name1" placeholder="Enter Subject Name"> </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-12">Type</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="type" id="type1" required>
                            <option value="Mandatory">Mandatory</option>
                            <option value="Optional">Optional</option>
                        </select>
                    </div>
                </div>               
                <div class="form-group">
                    <label class="col-sm-12">Syllabus (only PDF File)</label>
                    <div class="col-sm-12">
                        <input type="file" required name="syllabus" id="syllabus1" class="form-control" accept="application/pdf">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="is_active" id="is_active1" required>
                            <option value="Y">Active</option>
                            <option value="N">InActive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success" value="ADD SUBJECT" id="submit_btn"> </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.row -->
<script>
    function viewSubject_new1() {
        var classID = $('#classID1').val();
        var data = "classID="+classID;
        if (classID == "")
        {
            alert("Please Select Class");
        }else {
            $.ajax({
                url: "<?= base_url("classes/get_subjects")?>",
                method: "POST",
                data:data,
                success:function(res)
                {

                    var myObj = JSON.parse(res);
                    var i;
                    var subjects = '<thead><tr><th>#</th><th>Subject Code</th><th>Subject</th><th>TYPE</th><th>Status</th><th>Syllabus</th><th>Action</th></tr></thead><tfoot><tr><th>#</th><th>Subject Code</th><th>Subject</th><th>TYPE</th><th>Status</th><th>Syllabus</th><th>Action</th></tr></tfoot><tbody>';
                    var count = 0;
                    for (i in myObj)
                    {
                        count++;
                        var subID = myObj[i]['subID'];
                        var subject_code = myObj[i]['subject_code'];
                        var subject = myObj[i]['subject'];
                        var type = myObj[i]['type'];
                        var syllabus = myObj[i]['syllabus'];
                        var status = myObj[i]['is_active'];
                        var link = "<?php echo base_url('uploads/subject/');?>";
                        var link2 = "<?php echo base_url('uploads/syllabus.png');?>";
                        var link3 = "<?php echo base_url('classes/update_subject/');?>";

                        subjects += '<tr><td>'+count+'</td><td>'+subject_code+'</td><td>'+subject+'</td><td>'+type+'</td><td>'+status+'</td><td><a href="'+link+syllabus+'" target="_blank"><img height="40px" src="'+link2+'"></a></td><td><a class="btn btn-danger" data-toggle="modal" data-target="#responsive-modal'+subID+'"><i class="fa fa-edit"></i></a><div id="responsive-modal'+subID+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Update Class</h4> </div><form id="update_form1'+subID+'" enctype="multipart/form-data" action="<?php echo base_url("/classes/update_subject/");?>'+subID+'" method="POST""><div class="modal-body"><div class="form-group"><label for="class" class="control-label">Subject Name<span class="help"></span></label><input type="text" required class="form-control" name="subject" id="subject_name'+subID+'" value = "'+subject+'"></div><div class="form-group"><label for="class" class="control-label">Subject Code<span class="help"></span></label><input type="text" required class="form-control" name="subject_code" id="subject_code'+subID+'" value = "'+subject_code+'"></div><div class="form-group"><label for="class" class="control-label">Type</label><select class="form-control" name="type" id="type'+subID+'" required>';
                        if(type == 'Mandatory')
                        {
                            subjects += '<option value="Mandatory" selected>Mandatory</option><option value="Optional">Optional</option>';
                        } else {
                            subjects += '<option value="Mandatory" >Mandatory</option><option value="Optional" selected>Optional</option>';
                        }
                        

                        subjects += '</select></div><div class="form-group"><label for="class" class="control-label">Syllabus (only PDF File)</label><input type="file" name="syllabus" id="syllabus'+subID+'" class="form-control" accept="application/pdf"></div><div class="form-group"><label for="class" class="control-label">Status</label><select class="form-control" name="is_active" id="is_active'+subID+'" required>';
                        if (myObj[i]['is_active'] == 'Y') {
                            subjects += '<option selected value="Y">Active</option><option value="N">InActive</option>';
                        }else{
                            subjects += '<option value="Y">Active</option><option selected value="N">InActive</option>';
                        }
                        subjects +='</select></div></div><div class="modal-footer"><button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button><input class="update_subject btn btn-danger waves-effect waves-light" type="button" value="update" att="'+subID+'"></div></form></div></div></div></td></tr>';
                    }
                    subjects += '</tbody>';
                    $("#subject_table1").html(subjects);
                    $("#subject_table1").DataTable().destroy();
                    $("#subject_table1").DataTable();
                    
                }
            });
        }
    }
</script>
<script type="text/javascript">
    $(document).on("click",".update_subject",function(e){
        var id = $(this).attr("att");
        var subject_name = $("#subject_name"+id).val();
        var subject_code = $("#subject_code"+id).val();
        var type = $("#type"+id).val();
        var syllabus = $("#syllabus"+id).val();
        var is_active = $("#is_active"+id).val();
       
        if (subject_name != "" && subject_code != "" &&  type != "" && is_active != "") {
            e.preventDefault();
            var formData =$("#update_form1"+id).submit(function(e){
                return ;
            });
            var formData = new FormData(formData[0]);
            $.ajax({
                url: $("#update_form1"+id).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response){
                    alert(response);
                    location.reload();
                    
                    $("#responsive-modal"+id).modal('hide');
                    $(window).on('hidden.bs.modal', function() { 
                        $("#responsive-modal"+id).modal('hide');
                        viewSubject_new();
                    });
                   
                },
                contentType: false,
                processData: false,
                cache: false
            });


        }else{
            alert("Please fill all fields");
        }

    });
</script>



