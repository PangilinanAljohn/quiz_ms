$(function () {

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function (value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    $('#add_quiz').on('click', function(){
      $.ajax({
        url: "view_add_quiz",
        success: function(data) {

          $('#add_edit').html(data);

          $('#close_add').on('click', function(e){
            e.preventDefault();
            $('.add_quiz').remove();
          });

          //Advanced form with validation
          var form = $('#wizard_with_validation').show();
          form.steps({
              headerTag: 'h3',
              bodyTag: 'fieldset',
              transitionEffect: 'slideLeft',
              onInit: function (event, currentIndex) {
                  $.AdminBSB.input.activate();

                  //Set tab width
                  var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
                  var tabCount = $tab.length;
                  $tab.css('width', (100 / tabCount) + '%');

                  //set button waves effect
                  setButtonWavesEffect(event);

                  var counter = 2;
                  $('#add_question').on('click', function(){

                    var question = '<div id="question'+ counter +'" class="'+ counter +'">'+
                      '<div class="form-group form-float">'+
                          '<div class="form-line" style="margin-bottom: 5px">'+
                              '<input type="text" name="questions['+ counter +'][question]" class="form-control" placeholder="Question*" required>'+
                          '</div>'+
                      '</div>'+
                      '<div id="question'+ counter +'_choice_group">'+
                      '</div>'+
                      '<button type="button" id="add_choice" class="btn btn-success waves-effect">'+
                          '<i class="material-icons">add</i>'+
                          '<span>Add Choices</span>'+
                      '</button>'+
                      '<button type="button" id="remove_question" class="btn btn-danger waves-effect">'+
                          '<i class="material-icons">clear</i>'+
                          '<span>Remove Question</span>'+
                      '</button>'+
                    '</div>';

                    counter++;

                    $('#question_group').append(question);
                  });

                  var counter2 = 1;
                  $(document).on('click','#add_choice', function(){
                    var id = $(this).parent().closest('div').attr('class').split(' ');

                    var choices = '<div class="form-group form-float" style="margin-bottom: 0px" id="question'+ id +'_choices'+ counter2 +'">'+
                      '<div class="input-group input-group-sm">'+
                          '<span class="input-group-addon">'+
                              '<input type="radio" class="with-gap" id=question'+ id +'_radio'+ counter2 +'">'+
                              '<label for=question'+ id +'_radio'+ counter2 +'">'+'</label>'+
                          '</span>'+
                          '<div class="col-md-8">'+
                            '<div class="form-line">'+
                                '<input type="text" name="questions['+id+'][choices]['+ counter2 +']" class="form-control" placeholder="Choices*" required>'+
                            '</div>'+
                          '</div>'+
                          '<button value="question'+ id +'_choices'+ counter2 +'" type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float remove_choice">'+
                              '<i class="material-icons">clear</i>'+
                          '</button>'+
                      '</div>'
                    '</div>'

                    counter2++;
                    $('#question'+ id +'_choice_group').append(choices);
                  });

                  $(document).on('click', '#remove_question', function(){
                    var id = $(this).parent().closest('div').attr('class').split(' ');
                    $('#question' +id).remove();
                  });

                  $(document).on('click', '.remove_choice', function(){
                    var val = $(this).attr('value');
                     $('#' +val).remove();
                  });

              },
              onStepChanging: function (event, currentIndex, newIndex) {
                  if (currentIndex > newIndex) { return true; }

                  if (currentIndex < newIndex) {
                      form.find('.body:eq(' + newIndex + ') label.error').remove();
                      form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                  }

                  form.validate().settings.ignore = ':disabled,:hidden';
                  return form.valid();

              },
              onStepChanged: function (event, currentIndex, priorIndex) {
                  setButtonWavesEffect(event);
              },
              onFinishing: function (event, currentIndex) {
                  form.validate().settings.ignore = ':disabled';
                  return form.valid();


              },
              onFinished: function (event, currentIndex) {

                var data = $('#wizard_with_validation').serializeJSON();
                var json = JSON.stringify(data);
                //console.log(data);
                $.ajax({
                  type:'POST',
                  url: 'add_quiz',
                  data: {quiz:json},
                  success: function(data){
                    swal("Quiz Successfully Added!", "", "success");
                    location.reload();
                  }
                });
              }
          });

          form.validate({
              highlight: function (input) {
                  $(input).parents('.form-line').addClass('error');
              },
              unhighlight: function (input) {
                  $(input).parents('.form-line').removeClass('error');
              },
              errorPlacement: function (error, element) {
                  $(element).parents('.form-group').append(error);
              },
              rules: {
                  'confirm': {
                      equalTo: '#password'
                  }
              }
          });


        }
      });
    });

        //
        // initRealTimeChart();
        // initDonutChart();
        // initSparkline();

});
