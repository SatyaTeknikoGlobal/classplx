



 <div class="row">
    <div class="col-sm-812">
        <div class="white-box"> 
            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                     <h3 class="box-title m-b-0"><?=$title?></h3>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                    <a href="<?=base_url('exam/add')?>">
                    <button class="btn btn-primary"  style="float: right;"><i class="fa fa-plus">  Add Exam </i></button>
                    </a>
                </div>
                
            </div>
            <div class="table-responsive">
                <table id="user_data" class="display table table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                           <th class="col-sm-1">#ID</th>
                            <th class="col-sm-2">Class Name</th>
                            <th class="col-sm-2">Section Name</th>
                            <th class="col-sm-2">Subject Name</th>
                            <th class="col-sm-2">Exam Title</th>
                            <th class="col-sm-1">Exam Date</th>
                            <th class="col-sm-1">Status</th>
                            <th class="col-sm-3">Action</th>
                      </tr>
                  </thead>
              </table>
          </div>
      </div>
  </div>

</div> 




<script type="text/javascript" language="javascript" >  
   
  $(document).ready(function () {
        $("#user_data").DataTable().destroy();
        var t = $('#user_data').DataTable( {
            dom: 'lfrtip',
            "columnDefs": [
                {
                "searchable": false,
                "orderable": false,
                "targets": 0
                }
            ],
            "lengthMenu": [[10, 25, -1], [10, 25, "All"]],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=base_url()?>exam/list_exam_section",
                "type": 'GET',
            },
        });
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script> 