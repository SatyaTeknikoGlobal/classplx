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
                            <td><?=$c->is_active?></td>
                          
                        </tr>

                       

                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   

</div>
<!-- /.row -->
