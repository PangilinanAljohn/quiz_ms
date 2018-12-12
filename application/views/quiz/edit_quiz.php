<!-- Default Media -->
<div class="row clearfix edit_quiz">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="col-sm-8">
                    <div class="form-group form-group-lg">
                        <div class="form-line">
                            <input id="edit_name" onkeyup="edit_quiz_title('<?=$quiz_info->id?>')" type="text" class="form-control" placeholder="Quiz Title" value="<?=$quiz_info->quiz_name?>"/>
                        </div>
                    </div>
                </div><br><br><br><br>
                <div class="col-sm-8">
                    <div class="form-group form-group-sm">
                        <div class="form-line">
                            <input id="edit_info" onkeyup="edit_quiz_info('<?=$quiz_info->id?>')" type="text" class="form-control" placeholder="Quiz Title" value="<?=$quiz_info->quiz_info?>"/>
                        </div>
                    </div>
                </div>
                <br><br>
                <ul class="header-dropdown m-r--5">
                    <a href="#" id="close_add"><i class="material-icons">clear</i></a>
                </ul>
            </div>
            <div class="body">
              <?php foreach($quiz_question as $question):?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                          <div class="col-sm-10">
                              <div class="form-group form-group-lg" >
                                  <div class="form-line">
                                    <button type="button" onclick="delete_question('<?=$question->id?>');" class="btn bg-red btn-circle waves-effect waves-circle waves-float pull-right" style="margin-bottom:-40px;">
                                        <i class="material-icons">delete_forever</i>
                                    </button>
                                    <input onkeyup="edit_quiz_question('<?=$question->id?>', this.value)" type="text" class="form-control" placeholder="Question" value="<?=$question->questions_details?>"/>

                                  </div>
                              </div>
                          </div>
                        </h4><br><br><br><br><br>
                        <?php $choices = $this->quiz_model->get_choices($question->id);?>
                        <?php foreach($choices as $c):?>
                          <?php if($c->answer == 1){?>
                          <input onchange="set_correct_answer('<?=$c->id?>');" name="<?=$question->questions_details?>" type="radio" id="<?=$c->choices_details?>" class="radio-col-red" checked="">
                        <?php } else {?>
                          <input onchange="set_correct_answer('<?=$c->id?>');" name="<?=$question->questions_details?>" type="radio" id="<?=$c->choices_details?>" class="radio-col-red">
                        <?php }?>
                          <label for="<?=$c->choices_details?>">
                            <div class="col-md-12">
                                <div class="form-group form-group-sm">
                                    <div class="form-line">
                                        <input onkeyup="edit_quiz_choice('<?=$c->id?>', this.value)" type="text" class="form-control" placeholder="Choices" value="<?=$c->choices_details?>"/>
                                    </div>
                                </div>
                            </div>

                          </label><br>
                        <?php endforeach?>
                    </div>
                </div>
              <?php endforeach?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Default Media -->
<script>
  function set_correct_answer(id){
    $.ajax({
      url: '<?=site_url()?>quiz/set_correct_answer',
      type: "POST",
      data: { id:id },
    });
  }

  function edit_quiz_title(id){
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(edit(id), 500);
    $(this).data('timer', wait);
  };

  function edit(id) {
    var name = $('#edit_name').val();
    $.ajax({
      url: '<?=site_url()?>quiz/edit_quiz_title',
      type: "POST",
      data: { id:id , name:name},
    });
  }

  function edit_quiz_info(id){
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(edit_info(id), 500);
    $(this).data('timer', wait);
  };

  function edit_info(id) {
    var info = $('#edit_info').val();
    $.ajax({
      url: '<?=site_url()?>quiz/edit_quiz_info',
      type: "POST",
      data: { id:id , info:info},
    });
  }

  function edit_quiz_question(id, val){
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(edit_question(id, val), 500);
    $(this).data('timer', wait);
  };

  function edit_question(id, val) {
    $.ajax({
      url: '<?=site_url()?>quiz/edit_quiz_question',
      type: "POST",
      data: { id:id , info:val},
    });
  }

  function edit_quiz_choice(id, val){
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(edit_choice(id, val), 500);
    $(this).data('timer', wait);
  };

  function edit_choice(id, val) {
    $.ajax({
      url: '<?=site_url()?>quiz/edit_quiz_choice',
      type: "POST",
      data: { id:id , info:val},
    });
  }

  function delete_question(id){
    $.ajax({
      url: '<?=site_url()?>quiz/delete_question',
      type: "POST",
      data: { id:id },
      success: function(data){
        swal("Question Successfully Deleted!", "", "success");
        $('.edit_quiz').remove();
      }
    });
  }
</script>
