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
    <div class="col-sm-8 col-sm-offset-2">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Exam</h3>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-md-12">Class <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <select class="form-control" style="width: 100%" name="class_id" id="class_id" required>
                            <option value="">--SELECT--</option>
                            <?php foreach ($classes as $c){ ?>
                                <option value="<?=$c->classID?>"><?=$c->class?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>



                 <div class="form-group">
                    <label class="col-md-12">Section (Select Multiple)<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <select class="form-control" style="width: 100%" name="section_id[]" id="section_id" required multiple>
                    </select>

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-12">Subjects <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <select class="form-control" style="width: 100%" name="subject_id" id="subject_id" required>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Exam Title <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="title" id="title" placeholder="e.g., Quarterly, Half Yearly, Yearly " > </div>
                </div>



                <div class="form-group">
                    <label class="col-md-12">Exam Note or Description <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <textarea name="description" id="exam_desc" class="form-control" required placeholder="Exam Details" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">Start Date <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group date" id="datepicker2">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" required class="form-control" name="start_date" id="start_date" placeholder="e.g., 2018-01-20 ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">End Date <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group date" id="datepicker1">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" required class="form-control" name="end_date" id="end_date" placeholder="e.g., 2018-01-20 ">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Total Time (In Minutes)<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="time" id="time" placeholder="Total Time (In Minutes)"> </div>
                </div>


                 <div class="form-group">
                    <label class="col-md-12">Total No of Questions<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="no_of_question" id="no_of_question" placeholder="Total No of Questions"> </div>
                </div>



                  <div class="form-group">
                    <label class="col-md-12">Marks Per Question<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="marks" id="marks" placeholder="Marks Per Question" > </div>
                </div>


                  <div class="form-group">
                    <label class="col-md-12">Negetive Marks Per Questions<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="negetive_marks" id="negetive_marks" placeholder="Negetive Marks Per Questions" > </div>
                </div>



                  <div class="form-group">
                    <label class="col-md-12">Status<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <select class="form-control" name="status">
                           <option value="1">Active</option>
                           <option value="0">InActive</option>
                       </select>
                </div>


                <br>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->
<script>
    $(document).ready(function () {
        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    });
    $(document).ready(function () {
        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    });
</script>
<script>

    $('document').ready(function () {
        $('#class_id').change(function () {
            var class_id = $(this).val();
            var data = "class_id="+class_id;
            if (class_id != ''){
                $.ajax({
                    url: "<?= base_url("exam/get_sectionbyclass")?>",
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
                        document.getElementById("section_id").innerHTML = x;

                    }

                });

            }

        });

    });

</script>
<script>

    $('document').ready(function () {
        $('#section_id').change(function () {
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var data = "section_id="+section_id+"&class_id="+class_id;
            if (section_id != ''){
                $.ajax({
                    url: "<?= base_url("exam/get_subjectbysection")?>",
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
                        document.getElementById("subject_id").innerHTML = x;
                    }
                });
            }
        });
    });

</script>

