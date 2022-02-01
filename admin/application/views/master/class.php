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

    <div class="col-sm-8">

        <div class="white-box">

            <h3 class="box-title m-b-0"><?=$title?></h3>

            <div class="table-responsive">

                <table id="example23" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                    $count = 0;
                    foreach ($classes as $c){
                        $count++;
                        ?>
                        <tr>
                            <td><?=$count?></td>
                            <td><?=$c->class?></td>
                            <td><?php if ($c->is_active == 'Y' ) {
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
            <h3 class="box-title m-b-0">Add Class</h3>
            <p class="text-muted m-b-30 font-13"> Add Class </p>
            <form class="form-horizontal" method="post" id="form" action="<?=base_url("/classes/add_class")?>">
                  
                <div class="form-group">
                    <label class="col-md-12">Class<span class="help"></span></label>
                    <div class="col-md-12">
                        <input type="text" required class="form-control" name="class" id="class" placeholder="Enter Class Name"> </div>
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
                        <input type="submit" class="btn btn-success" value="ADD CLASS" id="submit_btn"> </div>
                </div>
            </form>
        </div>
    </div>



   



</div>

<!-- /.row -->

