<?php $this->load->view('quiz/header_admin');?>

<div class="row clearfix edit_quiz">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h4><?=$quiz->quiz_name?></h4>
                <small><?=$quiz->quiz_info?></small>
            </div>
            <div class="body">
              <?php echo $this->session->flashdata('message'); ?>
              <div class="col-md-4">
                  <div class="form-group">
                      <div class="form-line">
                          <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <div class="form-line">
                          <input type="text" class="form-control" id="first_name" placeholder="First Name">
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <div class="form-line">
                          <input type="text" class="form-control" id="middle_name" placeholder="Middle Name">
                      </div>
                  </div>
              </div><br><br><br><br>
              <?php foreach($questions as $question):?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                          <?=$question->questions_details?>
                        </h4>
                        <?php $choices = $this->quiz_model->get_choices($question->id);?>
                        <?php foreach($choices as $c):?>
                          <input name="<?=$question->questions_details?>" type="radio" id="<?=$c->choices_details?>" class="radio-col-red count" value="<?=$c->answer?>">
                          <label for="<?=$c->choices_details?>">
                            <?=$c->choices_details?>
                          </label><br>
                        <?php endforeach?>
                    </div>
                </div>
              <?php endforeach?>
              <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                <button id="submit_exam" type="button" class="btn bg-orange btn-block btn-lg waves-effect">Submit</button>
              </div><br><br><br>
            </div>

            <?php echo $this->pagination->create_links();?>
        </div>
    </div>

</div>


<?php $this->load->view('quiz/footer');?>

<script type="text/javascript">

  $( document ).ready(function() {

    $('#submit_exam').on('click', function(e){

      var sum = 0;
      $('.count:checked').map(function() {
         sum += Number($(this).val());
      });

      var score = sum;
      var last_name = $('#last_name').val();
      var middle_name = $('#middle_name').val();
      var first_name = $('#first_name').val();
      var id = '<?=$quiz->id?>';
      $.ajax({
        url: '<?=site_url()?>quiz/add_respondent',
        type: "POST",
        data: { id:id, last_name:last_name, first_name:first_name, middle_name:middle_name, score:score },
        success: function(){
          location.reload();
        }
      });

  });


  });
</script>
