<?php


?>

<!-- .row -->

<!-- <div class="row">

    <div class="col-sm-12">

        <div class="white-box">

            <h3 class="box-title m-b-0">SELECT CLASS AND SUBJECT</h3>

            <p class="text-muted m-b-30 font-13"> SELECT CLASS  AND SUBJECT AND CLICK ON VIEW </p>

            <div class="form-inline">

                <div class="col-sm-4">

                    <label class="col-sm-4">Class : </label>

                    <div class="col-sm-7">

                        <select class="form-control" style="width: 100%" name="classID" id="classID2" required>

                            <option value="">--SELECT--</option>

                            <?php foreach ($classes as $c){ ?>

                                <option value="<?=$c->classid?>"><?=$c->class?></option>

                            <?php } ?>

                        </select>

                    </div>

                </div>

              

                <div class="col-sm-4">

                    <label class="col-sm-4">SUBJECT : </label>

                    <div class="col-sm-7">

                        <select class="form-control" style="width: 100%" name="subjectID" id="subjectID2" required>

                        </select>

                    </div>

                </div>
                <div class="col-sm-4">

                    <label class="col-sm-4">CHAPTER : </label>

                    <div class="col-sm-7">

                        <select class="form-control" style="width: 100%" name="chapterID" id="chapterID2" required>

                        </select>

                    </div>

                </div>


                <div class="col-sm-2">

                    <div class="col-md-10">

                        <button class="btn btn-success" onclick="viewcontent2()"> View </button>

                    </div>

                    <p id="demo"></p>

                </div>

            </div>

            <h3>&nbsp;</h3>

        </div>

    </div>



</div> -->

<!-- /.row -->

<!-- .row -->

<div class="row">

    <div class="col-sm-8">

        <div class="white-box">

            <h3 class="box-title m-b-0"><?=$title?></h3>





            <div class="table-responsive">

                <table id="content_table2" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">

                        <?php //print_r($contents);?>
                        <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Section</th>
                         <th>Subject</th>
                         <th>Chapter</th>
                         <th>Content Type</th>
                        <th>Content Title</th>
                        <th>Link</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                         <th>Section</th>
                          <th>Subject</th>
                          <th>Chapter</th>
                           <th>Content Type</th>
                            <th>Content Title</th>
                            <th>Link</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                    //print_r($sections);

                    $count = 0;
                    foreach ($contents as $content)
                    {
                        $chapter_id = $content->classID;
                        $section_id = $content->section_id;
                        $subjectID = $content->subjectID;
                        $chapterID = $content->chapterID;

                        $class = $this->db->get_where('admin_class',['classid'=>$chapter_id])->row();
                        $section = $this->db->get_where('admin_section',['id'=>$section_id])->row();
                        $subject = $this->db->get_where('admin_subject',['subID '=>$subjectID])->row();
                        $chapter = $this->db->get_where('admin_chapter',['chapterID  '=>$chapterID])->row();

                        $count++;
                        ?>
                        <tr>
                            <td><?=$count?></td>
                            <td><?=$class->class?></td>
                            <td><?=$section->name?></td>
                            <td><?=$subject->subject?></td>
                            <td><?=$chapter->chapter_name?></td>
                            <td><?=$content->type?></td>
                            <td><?=$content->title?></td>
                             <td><?=$content->hls?></td>
                            <td><?php if ($subject->is_active == 'Y' ) {
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

    </div>

    <div class="col-sm-4">

        <div class="white-box">

            <h3 class="box-title m-b-0">Add Content</h3>

            <p class="text-muted m-b-30 font-13"> Add Subject Wise Content </p>

            <form class="form-horizontal" method="post" enctype="multipart/form-data"  action="<?=base_url("/classes/submit_content")?>">

               <div class="form-group">

                <label class="col-sm-12">Class</label>

                <div class="col-sm-12">

                    <select class="form-control" name="classID" id="classID" required>

                        <option value="">--SELECT--</option>

                        <?php foreach ($classes as $c){ ?>

                            <option value="<?=$c->classid?>"><?=$c->class?></option>

                        <?php } ?>

                    </select>

                </div>

            </div>

             <div class="form-group">
                    <label class="col-sm-12">Section</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="section_id" id="section_id" required>
                            <option value="" selected disabled>Select Section</option>
                         
                        </select>
                    </div>
            </div>

           
            <div class="form-group">

                <label class="col-md-12">Subject Name<span class="help"></span></label>

                <div class="col-md-12">

                    <select class="form-control" style="width: 100%" name="subjectID" id="subjectID3" required>

                    </select>

                </div>
            </div>
            <div class="form-group">

                <label class="col-md-12">Chapter Name<span class="help"></span></label>

                <div class="col-md-12">
                    <select class="form-control" style="width: 100%" name="chapterID" id="chapterID3" required>
                    </select>

                </div>
            </div>
            <div class="form-group">

                <label class="col-md-12">title<span class="help"></span></label>

                <div class="col-md-12">


                    <input type="text" class="form-control" style="width: 100%" name="title">

                </div>
            </div>



            <div class="form-group">

                <label class="col-sm-12">Type</label>

                <div class="col-sm-12">

                    <select class="form-control" name="type" id="type" onchange="get_field(this.value)" required>

                        <option value="youtube">youtube</option>

                        <option value="pdf">pdf</option>

                    </select>

                </div>

            </div>





            <div class="form-group" id="pdf_fl">

                <label class="col-sm-12">Syllabus (only PDF File)</label>

                <div class="col-sm-12">

                    <input type="file"  name="syllabus" id="syllabus" class="form-control" accept="application/pdf">

                </div>

            </div>


            <div class="form-group" id="youtube_fl">

                <label class="col-sm-12">youtube</label>

                <div class="col-sm-12">

                    <input type="text"  name="youtube"  class="form-control" >

                </div>

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

          
                    <button type="submit" class="btn btn-success">Submit</button>

            </form>

        </div>

    </div>



</div>


<script type="text/javascript">
        $("#pdf_fl").hide();
      $("#youtube_fl").show();
</script>
<script type="text/javascript">
   function get_field(v){
    //alert(v);
    if (v == 'youtube') {
        $("#pdf_fl").hide();
        $("#youtube_fl").show();
    }else{
      $("#pdf_fl").show();
        $("#youtube_fl").hide();  
    }
}
</script>
<script>

$('document').ready(function () {


        $('#classID').change(function () {
           //  alert('dsfdsf');
            var classID = $(this).val();
            var data = "classID="+classID;
            if (classID != ''){
                $.ajax({
                    url: "<?= base_url("classes/get_sectionbyclass")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                             x += "<option value='' selected disabled>Select Section</option>";

                        for (i in myObj) {

                            x += "<option value='" + myObj[i].id + "'>" + myObj[i].name + "</option>";

                        }

                        document.getElementById("section_id").innerHTML = x;
                    }
                });


            }
        });
});










    $('#classID2').change(function () {
        var classID = $(this).val();
            var data = "classID2="+classID;
            if (classID != ''){
                 $.ajax({
                    url: "<?= base_url("classes/get_subjectbyclass")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                         x += "<option value=''>--select--</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].subID + "'>" + myObj[i].subject+ "</option>";
                        }
                        document.getElementById("subjectID2").innerHTML = x;
                    }
                });
            }
        });
        $('#section_id').change(function () {
        var section_id = $(this).val();
            var data = "section_id="+section_id;
            if (section_id != ''){
                 $.ajax({
                    url: "<?= base_url("classes/get_subjectbysection")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                         x += "<option value=''>--select--</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].subID + "'>" + myObj[i].subject + "</option>";
                        }
                        document.getElementById("subjectID3").innerHTML = x;
                    }
                });
            }
        });
     $('document').ready(function () {
        $('#subjectID2').change(function () {
            var subjectID = $(this).val();
            var classID = $('#classID2').val();
            var subjectID = $('#subjectID2').val();
            var data = "subjectID2="+subjectID+"&classID2="+classID;
            if (subjectID != ''){
                $.ajax({
                    url: "<?= base_url("classes/get_chapterbysubject_re11")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        x += "<option value=''>--select--</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].chapterID + "'>" + myObj[i].chapter_name + "</option>";
                        }
                        document.getElementById("chapterID2").innerHTML = x;
                    }
                });
            }
        });
        $('#subjectID3').change(function () {


            var subjectID = $(this).val();
            var classID = $('#classID').val();
            var section_id = $('#section_id').val();
            var subjectID = $('#subjectID3').val();
            var data = "subjectID3="+subjectID+"&classID="+classID+"&section_id="+section_id;

           
            if (subjectID != ''){
                $.ajax({
                    url: "<?= base_url("classes/get_chapterbysubject_re")?>",
                    method: "POST",
                    data:data,
                    success:function(res)
                    {
                       // console.log(res);
                        var i, x = "";
                        var myObj = JSON.parse(res);
                        x += "<option value=''>--select--</option>";
                        for (i in myObj) {
                            x += "<option value='" + myObj[i].chapterID + "'>" + myObj[i].chapter_name + "</option>";
                        }
                        document.getElementById("chapterID3").innerHTML = x;
                    }
                });
            }
        });
    });
     function viewcontent2() {

        var classID = $('#classID2').val();
        var subjectID = $('#subjectID2').val();
        var chapterID = $('#chapterID2').val();
        var data = "classID="+classID+"&subjectID="+subjectID+"&chapterID="+chapterID;
        if (classID == "" || subjectID == ""|| chapterID == "")
        {
            alert("Please Select Class and Section and subject");
        }else {
            $.ajax({
                url: "<?= base_url("classes/get_contents")?>",
                method: "POST",
                data:data,
                success:function(res)
                {
                    var myObj = JSON.parse(res);
                    var i;
                    var contents = '<thead><tr><th>#</th><th>Class</th><th>Subject</th><th>Chapter Name</th><th> Type</th><th> Title</th><th>File</th><th>Status</th></tr></thead><tfoot><tr><th>#</th><th>Class</th><th>Subject</th><th>Chapter Name</th><th> Title</th><th> Type</th><th>File</th><th>Status</th></tr></tfoot><tbody>';

                    var count = 0;

                    for (i in myObj)

                    {

                        count++;

                         var classID = myObj[i]['classID'];
                        var subjectID = myObj[i]['subjectID'];
                        var chapter_name = myObj[i]['chapterID'];
                        var type = myObj[i]['type'];
                        var title = myObj[i]['title'];
                        var hls = myObj[i]['hls'];
                        var status = myObj[i]['is_active'];
                        var contentID = myObj[i]['id'];
                        var baseurl = '<?=base_url()?>';
                        contents += '<tr><td>'+count+'</td><td>'+classID+'</td><td>'+subjectID+'</td><td>'+chapter_name+'</td><td>'+type+'</td><td>'+title+'</td><td>'+hls+'</td><td>'+status+'</td></tr>';

                        contents += '';
                    }

                    contents += '</tbody>';

                    $("#content_table2").html(contents);

                    $("#content_table2").DataTable().destroy();

                    $("#content_table2").DataTable();

                }

            });

        }

       

    }

</script>
