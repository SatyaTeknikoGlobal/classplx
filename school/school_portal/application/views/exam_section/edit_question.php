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
            <h3 class="box-title m-b-0">Edit Question</h3>
            <form class="form-horizontal" method="post">
                

                 <div class="form-group">
                    <label class="col-md-12">Question <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <input type="text" class="form-control" style="width: 100%" name="questionName" value="<?=$questions->questionName?>" required>
                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Option A<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="optionA" value="<?=$questions->optionA?>" > </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Option B<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="optionB"  value="<?=$questions->optionB?>" > </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Option C<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control"name="optionC"  value="<?=$questions->optionC?>" > </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Option D<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="optionD"  value="<?=$questions->optionD?>" > </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Right Answer<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="rightAnswer"  value="<?=$questions->rightAnswer?>" > </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Difficulty Level<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control"  name="difficultyLevel"  value="<?=$questions->difficultyLevel?>"> </div>
                </div>

                  <div class="form-group">
                    <label class="col-md-12">Status<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <select class="form-control" name="status">
                           <option value="1" <?php if($questions->status == 1) echo "selected;"?>>Active</option>

                           <option value="0" <?php if($questions->status == 0) echo "selected;"?>>InActive</option>
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

