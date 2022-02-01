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
            <h3 class="box-title m-b-0">Edit Class</h3>
            <p class="text-muted m-b-30 font-13"> ( e.g., Quarterly, Half Yearly, Yearly ) </p>
            <form class="form-horizontal" method="post">

                <input type="hidden" value="<?= $live_classes->id?>" name="id"?>

               
                
                <div class="form-group">
                    <label class="col-md-12">Title <span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                        <input type="text" required class="form-control" name="title" id="title"  value="<?=$live_classes->title?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Start Date<span class="red_text">*</span></label>
                    <div class="col-md-12 input-group">
                         <input type="date" required class="form-control" name="start_date" id="start_date"  value="<?=$live_classes->start_date?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Start Time <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group">
                        
                        <input type="time"  class="form-control" name="start_time" id="start_time"  value="<?=$live_classes->start_time?>">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-12">End Date <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group">
                        
                        <input type="date"  class="form-control" name="end_date" id="end_date"  value="<?=$live_classes->end_date?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12">End Time <span class="red_text">*</span></label>
                    <div class="col-sm-12 input-group">
                     
                       <input type="time"  class="form-control" name="end_time" id="end_time"  value="<?=$live_classes->end_time?>">
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

