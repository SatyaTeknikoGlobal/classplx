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
            <p class="text-muted m-b-30 font-13"> SELECT CLASS AND SECTION AND SUBJECT AND CLICK ON VIEW </p>
            <div class="form-inline">
                <div class="col-sm-3">
                    <label class="col-sm-3">Class:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="width: 100%" name="classID" id="classID" required>
                            <option value="">--SELECT--</option>
                            <?php foreach ($classes as $c){ ?>
                                <option value="<?=$c->classID?>"><?=$c->class?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="col-sm-3">SECTION:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="width: 100%" name="sectionID" id="sectionID" required>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="col-sm-3">SUBJECT:</label>
                    <div class="col-sm-8">
                        <select class="form-control" style="width: 100%" name="subjectID" id="subjectID" required>
                        </select>
                    </div>
                </div>




                <div class="col-sm-2">
                    <div class="col-md-10">
                        <button class="btn btn-success" onclick="viewChapter_new()"> View </button>
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
                <table id="chapter_table" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">

                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Chapter</h3>
            <p class="text-muted m-b-30 font-13"> Add Chapter for your School </p>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form" action="<?=base_url("/configuration/add_chapter")?>">


              <div class="form-group">
                <label class="col-sm-12">Class</label>
                <div class="col-sm-12">
                    <select class="form-control" name="add_classID" id="add_classID" required>
                        <option value="">--SELECT--</option>
                        <?php foreach ($classes as $c){ ?>
                            <option value="<?=$c->classID?>"><?=$c->class?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-12">Section (Select Multiple)</label>
                <div class="col-sm-12">
                    <select class="form-control" style="width: 100%" name="add_sectionID[]" id="add_sectionID" required multiple>


                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-12">Choose Subject<span class="help"></span></label>
                <div class="col-md-12">
                    <select class="form-control" style="width: 100%" name="subject_id" id="subject_id" required >


                    </select>
                </div>
            </div>





            <div class="form-group">
                <label class="col-md-12">Chapter Name<span class="help"></span></label>
                <div class="col-md-12">
                    <input type="text" required class="form-control" name="chapter_name" id="chapter_name" placeholder="Enter Chapter Name"> </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="is_active" id="is_active" required>
                            <option value="Y">Active</option>
                            <option value="N">InActive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success" value="ADD Chapter" id="submit_btn"> </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.row -->

    <button type="button" id="model_open" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
      Open modal
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form" action="<?=base_url("/configuration/edit_chapter")?>">


              <div class="form-group">
                <label class="col-sm-12">Class</label>
                <div class="col-sm-12">
                    <select class="form-control" name="add_classID" id="add_classID1" required>
                        <option value="">--SELECT--</option>
                        <?php foreach ($classes as $c){ ?>
                            <option value="<?=$c->classID?>"><?=$c->class?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

           <!--  <div class="form-group">
                <label class="col-sm-12">Section (Select Multiple)</label>
                <div class="col-sm-12">
                    <select class="form-control" style="width: 100%" name="add_sectionID[]" id="add_sectionID" required multiple>


                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-12">Choose Subject<span class="help"></span></label>
                <div class="col-md-12">
                    <select class="form-control" style="width: 100%" name="subject_id" id="subject_id" required >


                    </select>
                </div>
            </div> -->



<input type="hidden" name="chapter_id" id="chapter_id_edit">

            <div class="form-group">
                <label class="col-md-12">Chapter Name<span class="help"></span></label>
                <div class="col-md-12">
                    <input type="text" required class="form-control" name="chapter_name" id="chapter_name1" placeholder="Enter Chapter Name"> </div>
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
                        <input type="submit" class="btn btn-success" value="Edit Chapter" id="submit_btn"> </div>
                    </div>
                </form>
           
        </div>

        <!-- Modal footer -->
      <!--   <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->

    </div>
</div>
</div>

<script>
    function viewChapter_new() {
        var classID = $('#classID').val();
        var sectionID = $('#sectionID').val();
        var subjectID = $('#subjectID').val();
        var data = "classID="+classID+"&sectionID="+sectionID+"&subjectID="+subjectID;
        if (classID == "" || sectionID == "" || subjectID == "")
        {
            alert("Please Select Class and Section and subject");
        }else {
            $.ajax({
                url: "<?= base_url("configuration/get_chapters")?>",
                method: "POST",
                data:data,
                success:function(res)
                {
                    var myObj = JSON.parse(res);
                    var i;
                    var chapters = '<thead><tr><th>#</th><th>Subject Name</th><th>Chapter Name</th><th>Status</th><th>Action</th></tr></thead><tfoot><tr><th>#</th><th>Subject Name</th><th>Chapter Name</th><th>Status</th><th>Action</th></tr></tfoot><tbody>';
                    var count = 0;
                    for (i in myObj)
                    {
                        
                        count++;
                        var subjectID = myObj[i]['subjectID'];
                        var chapter_name = myObj[i]['chapter_name'];

                        var chapterID = myObj[i]['chapterID'];

                        var status = myObj[i]['is_active'];


                        chapters += '<tr><td>'+count+'</td><td>'+subjectID+'</td><td>'+chapter_name+'</td><td>'+status+'</td><td><a class="btn btn-danger" onclick="c_edit('+chapterID+')" ><i class="fa fa-edit"></i></a></td></tr>';
// <a class="btn btn-danger" data-toggle="modal" data-target="#responsive-modal'+subjectID+'"><i class="fa fa-edit"></i></a>
                        chapters += '';





                    }
                    chapters += '</tbody>';
                    $("#chapter_table").html(chapters);
                    $("#chapter_table").DataTable().destroy();
                    $("#chapter_table").DataTable();

                }
            });
        }
    }
    function c_edit(chapterID){
        //alert(chapterID);
        var base_url = '<?= base_url()?>';
        $.ajax({ 
            type : "post",
            url  : base_url+'configuration/get_chapters_by_id/',
            dataType : "JSON",
            data : {'chapterID':chapterID},
            success: function(res){
              if (res.status) {
                //alert(res.data['schoolID']);
                $('#chapter_id_edit').val(res.data['chapterID']);
                $('#add_classID1').val(res.data['classID']);
                // $('#add_sectionID').val(res.data['sectionID']);
                // $('#subject_id').val(res.data['subjectID']);
                $('#chapter_name1').val(res.data['chapter_name']);
                $('#is_active1').val(res.data['is_active']);
             $('#model_open').click();


            }
        }
    });
    }
</script>



















<script>
    function viewSubject_new() {
        var classID = $('#classID').val();
        var sectionID = $('#sectionID').val();
        var data = "classID="+classID+"&sectionID="+sectionID;
        if (classID == "" || sectionID == "")
        {
            alert("Please Select Class and Section");
        }else {
            $.ajax({
                url: "<?= base_url("configuration/get_subjects")?>",
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
                        var subjectID = myObj[i]['subjectID'];
                        var subject_code = myObj[i]['subject_code'];
                        var subject = myObj[i]['subject_name'];
                        var type = myObj[i]['type'];
                        var syllabus = myObj[i]['syllabus'];
                        var status = myObj[i]['is_active'];
                        var link = "<?php echo base_url('uploads/subject/');?>";
                        var link2 = "<?php echo base_url('assets/syllabus.png');?>";
                        var link3 = "<?php echo base_url('configuration/update_subject/');?>";
                        subjects += '<tr><td>'+count+'</td><td>'+subject_code+'</td><td>'+subject+'</td><td>'+type+'</td><td>'+status+'</td><td><a href="'+link+syllabus+'" target="_blank"><img height="40px" src="'+link2+'"></a></td><td><a class="btn btn-danger" data-toggle="modal" data-target="#responsive-modal'+subjectID+'"><i class="fa fa-edit"></i></a><div id="responsive-modal'+subjectID+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Update Class</h4> </div><form id="update_form'+subjectID+'" enctype="multipart/form-data" action="<?php echo base_url("/configuration/update_subject/");?>'+subjectID+'" method="POST""><div class="modal-body"><div class="form-group"><label for="class" class="control-label">Subject Name<span class="help"></span></label><input type="text" required class="form-control" name="subject_name" id="subject_name'+subjectID+'" value = "'+subject+'"></div><div class="form-group"><label for="class" class="control-label">Subject Code<span class="help"></span></label><input type="text" required class="form-control" name="subject_code" id="subject_code'+subjectID+'" value = "'+subject_code+'"></div><div class="form-group"><label for="class" class="control-label">Type</label><select class="form-control" name="type" id="type'+subjectID+'" required>';
                        if(type == 'Mandatory')
                        {
                            subjects += '<option value="Mandatory" selected>Mandatory</option><option value="Optional">Optional</option>';
                        } else {
                            subjects += '<option value="Mandatory" >Mandatory</option><option value="Optional" selected>Optional</option>';
                        }


                        subjects += '</select></div><div class="form-group"><label for="class" class="control-label">Syllabus (only PDF File)</label><input type="file" name="syllabus" id="syllabus'+subjectID+'" class="form-control" accept="application/pdf"></div><div class="form-group"><label for="class" class="control-label">Status</label><select class="form-control" name="is_active" id="is_active'+subjectID+'" required>';
                        if (myObj[i]['is_active'] == 'Y') {
                            subjects += '<option selected value="Y">Active</option><option value="N">InActive</option>';
                        }else{
                            subjects += '<option value="Y">Active</option><option selected value="N">InActive</option>';
                        }
                        subjects +='</select></div></div><div class="modal-footer"><button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button><input class="update_subject btn btn-danger waves-effect waves-light" type="button" value="update" att="'+subjectID+'"></div></form></div></div></div></td></tr>';
                    }
                    subjects += '</tbody>';
                    $("#subject_table").html(subjects);
                    $("#subject_table").DataTable().destroy();
                    $("#subject_table").DataTable();

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
        //var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (subject_name != "" && subject_code != "" &&  type != "" && is_active != "") {
            e.preventDefault();
            // Create an FormData object
            var formData =$("#update_form"+id).submit(function(e){
                return ;
            });
            //formData[0] contain form data only
            // You can directly make object via using form id but it require all ajax operation inside $("form").submit(<!-- Ajax Here   -->)
            var formData = new FormData(formData[0]);
            $.ajax({
                url: $("#update_form"+id).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response){
                    alert(response);
                    
                    $("#responsive-modal"+id).modal('hide');
                    $(window).on('hidden.bs.modal', function() { 
                        $("#responsive-modal"+id).modal('hide');
                        viewSubject_new();
                    });
                    //$("#responsive-modal"+id).on("shown.bs.modal", function(e) {alert("modal working")});
                    //viewSubject_new();
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
<script>
    $('document').ready(function () {
        $('#classID').change(function () {
            var classID = $(this).val();
            var data = "classID="+classID;
            if (classID != ''){
                $.ajax({
                    url: "<?= base_url("configuration/get_sectionbyclass")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        x += "<option value=''>--select--</option>";
                        for (i in myObj) {

                            x += "<option value='" + myObj[i].sectionID + "'>" + myObj[i].section + "</option>";

                        }

                        document.getElementById("sectionID").innerHTML = x;
                    }
                });
            }
        });
    });
</script>

<script>
    $('document').ready(function () {
        $('#sectionID').change(function () {
            var sectionID = $(this).val();
            var classID = $('#classID').val();
            var data = "sectionID="+sectionID+"&classID="+classID;
            if (sectionID != ''){
                $.ajax({
                    url: "<?= base_url("configuration/get_subjectbysection")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        x += "<option value=''>--select--</option>";
                        for (i in myObj) {

                            x += "<option value='" + myObj[i].subjectID + "'>" + myObj[i].subject_name + "</option>";

                        }

                        document.getElementById("subjectID").innerHTML = x;
                    }
                });
            }
        });
    });
</script>




<script>
    $('document').ready(function () {
        $('#add_classID').change(function () {
            var classID = $(this).val();
            var data = "classID="+classID;
            if (classID != ''){
                $.ajax({
                    url: "<?= base_url("configuration/get_sectionbyclass")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        for (i in myObj) {

                            x += "<option value='" + myObj[i].sectionID + "'>" + myObj[i].section + "</option>";

                        }

                        document.getElementById("add_sectionID").innerHTML = x;
                    }
                });


                $.ajax({
                    url: "<?= base_url("configuration/get_subjectbyclass")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        for (i in myObj) {

                            x += "<option value='" + myObj[i].subjectID + "'>" + myObj[i].subject_name + "</option>";

                        }

                        document.getElementById("subject_id").innerHTML = x;
                    }
                });





            }
        });
    });
</script>


