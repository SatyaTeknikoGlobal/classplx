<?php
   /*
   
   | -----------------------------------------------------
   
   | PRODUCT NAME:  MENTOR ERP
   
   | -----------------------------------------------------
   
   | AUTHOR:            Kshitij Kumar Singh
   
   | -----------------------------------------------------
   
   | EMAIL:         kshitij.singh@teknikoglobal.com
   
   | -----------------------------------------------------
   
   | COPYRIGHT:     RESERVED BY TEKNIKOGLOBAL
   
   | -----------------------------------------------------
   
   | WEBSITE:           https://www.teknikoglobal.com
   
   | -----------------------------------------------------
   
   */
   
   ?>
<!-- .row -->
<div class="row">
   <div class="col-sm-8 col-sm-offset-2">
      <div class="white-box">
         <h3 class="box-title m-b-0">Edit Content</h3>
         <form class="form-horizontal" method="post">
           <!--  <div class="form-group">
               <label class="col-md-12">Class <span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <select class="form-control" name="classID" readonly>
                     <option value="" selected>Select Class</option>
                     <?php  if(!empty($classes)){
                        foreach($classes as $classnew){ ?>
                     <option value="<?=$classnew->classID?>" <?php if ($classnew->classID == $content->classID){echo "selected";}?>><?=$classnew->class?></option>
                     <?php }}?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Subjects <span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <select class="form-control" name="subjectID" readonly>
                     <option value="" selected disabled>Select Subjects</option>
                     <?php if(!empty($subjects)){
                        foreach($subjects as $subjectnew){
                        
                            ?>
                     <option value="<?=$subjectnew->subjectID?>" <?php if($subjectnew->subjectID == $content->subjectID) echo "selected";?>><?=$subjectnew->subject_name?></option>
                     <?php }}?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Chapters <span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <select class="form-control" name="chapterID" readonly>
                     <option value="" selected disabled>Select Chapters</option>
                     <?php if(!empty($chapters)){
                        foreach($chapters as $ch){
                        
                            ?>
                     <option value="<?=$ch->subjectID?>" <?php if($ch->chapterID == $content->chapterID) echo "selected";?>><?=$ch->chapter_name?></option>
                     <?php }}?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Type<span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <select class="form-control" name="type">
                     <option value="pdf" <?php if($content->type == 'pdf') echo "selected;"?>>PDF</option>
                     <option value="youtube" <?php if($content->type == 'youtube') echo "selected;"?>>Youtube</option>
                  </select>
               </div>
            </div>
            
            <div class="form-group">
               <label class="col-md-12">HLS<span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <input class="form-control" type="text" name="hls" id="hls" value="<?=$content->hls?>">
               </div>
            </div>


             <div class="form-group">
               <label class="col-md-12"> Title <span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <input type="text" required class="form-control" name="title" id="title" value="<?=$content->title?>"> 
               </div>
            </div> -->
            <div class="form-group">
               <label class="col-md-12">Status<span class="red_text">*</span></label>
               <div class="col-md-12 input-group">
                  <select class="form-control" name="is_active">
                     <option value="Y" <?php if($content->is_active == 'Y') echo "selected;"?>>ACTIVE</option>
                     <option value="N" <?php if($content->is_active == 'N') echo "selected;"?>>INACTIVE</option>
                  </select>
               </div>
            </div>



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