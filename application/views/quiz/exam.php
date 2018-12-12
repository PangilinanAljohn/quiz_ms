<?php $this->load->view('quiz/header_admin');?>

<div class="row clearfix edit_quiz">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h4><?=$quiz->quiz_name?></h4>
                <small><?=$quiz->quiz_info?></small>
            </div>
            <div class="body">
              <?php foreach($questions as $question):?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                          <?=$question->questions_details?>
                        </h4>
                        <?php $choices = $this->quiz_model->get_choices($question->id);?>
                        <?php foreach($choices as $c):?>
                          <input name="<?=$question->questions_details?>" type="radio" id="<?=$c->choices_details?>" class="radio-col-red">
                          <label for="<?=$c->choices_details?>">
                            <?=$c->choices_details?>
                          </label><br>
                        <?php endforeach?>
                    </div>
                </div>
              <?php endforeach?>
            </div>
            <?php echo $this->pagination->create_links();?>
        </div>
    </div>

</div>


<?php $this->load->view('quiz/footer');?>
