
    


 <div class="row">
    <div class="col-sm-812">
        <div class="white-box"> 
            <div class="row">
                <div class="col-6 col-md-6 col-lg-6">
                     <h3 class="box-title m-b-0"><?=$title?></h3>
                </div>
                <div class="col-6 col-md-6 col-lg-6">
                   <!--  <a href="<?=base_url('exam/add')?>">
                    <button class="btn btn-primary"  style="float: right;"><i class="fa fa-plus">  Add Exam </i></button>
                    </a> -->
                </div>
                
            </div>
            <div class="table-responsive">
                 <table id="example23" class="display nowrap table table-hover table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                           <th class="col-sm-1">#ID</th>
                            <th class="col-sm-2">Exam Name</th>
                            <th class="col-sm-2">Question Name</th>
                            <th class="col-sm-2">Options</th>
                            <th class="col-sm-2">Right Ans</th>
                            <th class="col-sm-1">Difficulty Level</th>
                            <th class="col-sm-1">Status</th>
                            <th class="col-sm-3">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach($questions as $q) { 
                    $exams = $this->db->get_where('exam_section',array('id'=>$q->exam_id))->row();

                    ?>
                      <tr>
                            <td><?=$q->id?></td>
                            <td><?=$exams->title?></td>
                            <td><?=$q->questionName?></td>
                            <td><?php if(!empty($q->optionA)) { ?>
                             <strong>Option A:  </strong> <?=$q->optionA?>
                            <?php }?><br>
                            <?php if(!empty($q->optionB)) { ?>
                             <strong>Option B:  </strong> <?=$q->optionB?>
                            <?php }?><br>
                            <?php if(!empty($q->optionC)) { ?>
                             <strong>Option C:  </strong> <?=$q->optionC?>
                            <?php }?><br>
                            <?php if(!empty($q->optionD)) { ?>
                             <strong>Option D:  </strong> <?=$q->optionD?>
                            <?php }?>
                       </td>
                            <td><?=$q->rightAnswer?></td>
                            <td><?=$q->difficultyLevel?></td>
                            <td><?php if($q->status == '1') {
                               echo "Active";
                            }else{
                                echo "Inactive";
                            }  ?></td>
                          
                            <td><a class = "btn btn-primary" title="Add Result" href ="<?=base_url('exam/edit_question/').$q->id ?>">Edit</a></td>

                      </tr>
                  <?php } ?>
                  </tbody>
                 
              </table>
          </div>
      </div>
  </div>

</div> 



