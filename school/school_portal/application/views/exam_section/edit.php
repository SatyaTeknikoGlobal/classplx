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
            <h3 class="box-title m-b-0">Edit Exam</h3>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-md-12">Class <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <select class="form-control" name="class_id" disabled>
                            <option value="" selected disabled>Select Class</option>
                     
                         <?php if(!empty($classes)){
                            foreach($classes as $classnew){
                            ?>
                            <option value="<?=$classnew->classID?>" <?php if($classnew->classID == $exams->class_id) echo "selected";?>><?=$classnew->class?></option>

                        <?php }}?>
                           </select>
                    </div>
                </div>



                 <div class="form-group">
                    <label class="col-md-12">Section <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <select class="form-control select2" name="section_id[]" multiple disabled>
                            <?php if(!empty($sections)){
                            foreach($sections as $sectionnew){
                            ?>
                            <option value="<?=$sectionnew->sectionID?>" <?php if(in_array($sectionnew->sectionID,$examgroup_ids)) echo "selected";?>><?=$sectionnew->section?></option>

                        <?php }}?>
                           </select>
                    </div>
                </div>



                 <div class="form-group">
                    <label class="col-md-12">Subjects <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <select class="form-control" name="subject_id" disabled>
                            <option value="" selected disabled>Select Subjects</option>
                        <?php if(!empty($subjects)){
                            foreach($subjects as $subjectnew){
                            ?>
                            <option value="<?=$subjectnew->subjectID?>" <?php if($subjectnew->subjectID == $exams->subject_id) echo "selected";?>><?=$subjectnew->subject_name?></option>

                        <?php }}?>
                           </select>
                    </div>
                </div>






                <div class="form-group">
                    <label class="col-md-12">Exam Title <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="title" id="title" placeholder="e.g., Quarterly, Half Yearly, Yearly " value="<?=$exams->title?>"> </div>
                </div>



                <div class="form-group">
                    <label class="col-md-12">Exam Note or Description <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <textarea name="description" id="exam_desc" class="form-control" required placeholder="Exam Details" rows="4"><?=$exams->description?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-12">Exam Date <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group date" id="datepicker1">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" required class="form-control" name="start_date" id="start_date" value="<?=$exams->start_date?>" placeholder="e.g., 2018-01-20 ">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">Total Time (In Minutes)<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="time" id="time" placeholder="Total Time (In Minutes)" value="<?=$exams->time?>"> </div>
                </div>


                 <div class="form-group">
                    <label class="col-md-12">Total No of Questions<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="no_of_question" id="no_of_question" placeholder="Total No of Questions" value="<?=$exams->no_of_question?>"> </div>
                </div>



                  <div class="form-group">
                    <label class="col-md-12">Marks Per Question<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="marks" id="marks" placeholder="Marks Per Question" value="<?=$exams->marks?>"> </div>
                </div>


                  <div class="form-group">
                    <label class="col-md-12">Negetive Marks Per Questions<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="negetive_marks" id="negetive_marks" placeholder="Negetive Marks Per Questions" value="<?=$exams->negetive_marks?>"> </div>
                </div>



                  <div class="form-group">
                    <label class="col-md-12">Status<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <select class="form-control" name="status">
                           <option value="1" <?php if($exams->status == 1) echo "selected;"?>>Active</option>
                           <option value="0" <?php if($exams->status == 0) echo "selected;"?>>InActive</option>
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
</script>

