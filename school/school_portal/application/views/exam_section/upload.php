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
            <h3 class="box-title m-b-0">Upload Exam</h3>

            <a class="btn btn-primary" href="<?=base_url('uploads/questions/mentorquestionformat.csv')?>">Sample Question</a>

            <form class="form-horizontal" method="post" enctype='multipart/form-data'>

                <input type="hidden" name="upload_id" value="<?=$upload_id?>">
                <div class="form-group">
                    <label class="col-md-12">Class <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                       <input type="file" name="file" class="form-control">
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
