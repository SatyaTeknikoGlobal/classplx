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
            <h3 class="box-title m-b-0"><?=$title?></h3>
            <form class="form-horizontal" method="post" >
              
                <div class="form-group">
                   
                    
                    <div class="col-sm-2">
                         <label>Status : </label>
                     </div>
                         <div class="col-sm-4">
                        <select class="form-control" style="font-weight: 500" name="is_approved" id="is_approved" required>
                            <option <?php if ($school->is_approved == "Y") echo "selected" ;?> value="Y">Active</option>
                            <option <?php if ($school->is_approved == "N") echo "selected" ;?> value="N">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success" value="UPDATE"> </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- /.row -->

