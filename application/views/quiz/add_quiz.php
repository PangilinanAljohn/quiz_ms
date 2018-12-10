
                    <!-- Advanced Form Example With Validation -->
                      <div class="card add_quiz">
                          <div class="header">
                              <h2>ADD QUIZ</h2>
                              <ul class="header-dropdown m-r--5">
                                <a href="#" id="close_add"><i class="material-icons">clear</i></a>
                              </ul>
                          </div>
                          <div class="body">
                              <form id="wizard_with_validation" class="quiz123" method="POST">
                                  <h3>Quiz Information</h3>
                                  <fieldset>
                                      <div class="form-group form-float form-group-lg">
                                          <div class="form-line">
                                              <input type="text" class="form-control" id="quiz_title" required>
                                              <label class="form-label">Quiz Title*</label>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <h3>Quiz Questions and Answers</h3>
                                  <fieldset id="container">
                                      <div class="form-group form-float">
                                        <button id="add_question" type="button" class="btn btn-success waves-effect">
                                            <i class="material-icons">add</i>
                                            <span>Add Question</span>
                                        </button>
                                      </div>
                                    <div id='question_group'>
                                      <div id="question1" class="1">
                                        <div class="form-group form-float">
                                            <div class="form-line" style="margin-bottom: 5px">
                                                <input type="text" name="questions" class="form-control" placeholder="Question*" required>
                                            </div>
                                        </div>
                                        <div id="question1_choice_group"></div>
                                        <button type="button" id="add_choice" class="btn btn-success waves-effect">
                                            <i class="material-icons">add</i>
                                            <span>Add Choices</span>
                                        </button>
                                        <button type="button" id="remove_question" class="btn btn-danger waves-effect">
                                            <i class="material-icons">clear</i>
                                            <span>Remove Question</span>
                                        </button>
                                      </div>
                                    </div>


                                  </fieldset>
                              </form>
                          </div>
                      </div>
