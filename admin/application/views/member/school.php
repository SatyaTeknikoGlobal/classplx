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
                <table id="school_table" class="display table table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="col-sm-1">IMAGE</th>
                        <th class="col-sm-1">School Code</th>
                        <th class="col-sm-2">School Name</th>
                        <th class="col-sm-2">Admin Name</th>
                        <th class="col-sm-1">Email</th>
                        <th class="col-sm-1">Phone</th>
                        <th class="col-sm-1">Is Approved</th>
                        <th class="col-sm-1">Registered On</th>
                        <!-- <th class="col-sm-1">Subs. Status</th> -->
                        <th class="col-sm-2">Action</th>
                    </tr>
                    </thead>
                    
                    <tfoot>
                    <tr>
                        <th>IMAGE</th>
                        <th>School Code</th>
                        <th>School Name</th>
                        <th>Admin Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                         <th>Is Approved</th>
                        <th>Registered On</th>
                        <!-- <th>Subs. Status</th> -->
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
<script>
    $('document').ready(function () {
        var t = $('#school_table').DataTable( {
            dom: 'lfrtip',
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "lengthMenu": [[10, 25, -1], [10, 25, "All"]],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url()?>school/list_school",
                "type": 'GET',
            }
        });
    });
</script>