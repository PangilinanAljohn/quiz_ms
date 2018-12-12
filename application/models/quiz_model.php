<?php
class Quiz_model extends CI_Model{

  public function __construct() {
			parent::__construct();
	}

  public function add_quiz($quiz){

    $quiz_data = array(
      'quiz_name' => $quiz['quiz_title'],
      'quiz_info' => $quiz['quiz_info'],
      'date_added' => date('Y-m-d h:i:s')
    );
    
    $this->db->insert('quiz', $quiz_data);

    $quiz_id = $this->db->insert_id();

    foreach($quiz['questions'] as $q){

        $quiz_question = array(
          'quiz_id' => $quiz_id,
          'questions_details' => $q['question'],
          'date_added' => date('Y-m-d h:i:s')
        );

        $this->db->insert('questions', $quiz_question);

        $question_id = $this->db->insert_id();

        foreach ($q['choices'] as $a) {
          $choice = array(
            'question_id' => $question_id,
            'choices_details' => $a,
            'date_added' => date('Y-m-d h:i:s')
          );

          $this->db->insert('choices', $choice);

        }
    }

  }

  public function add($quiz, $question, $choice){

    $quiz_data = array(
      'quiz_name' => $quiz,
      'date_added' => date('Y-m-d h:i:s')
    );

    $this->db->insert('quiz', $quiz_data);
    $quiz_id = $this->db->insert_id();

    foreach ($question as $q) {
        $data = array(
          'quiz_id' => $quiz_id,
          'questions_details' => $q,
          'choices_details' => $c,
          'answer' => 1,
          'date_added' => date('Y-m-d h:i:s')
        );

        $this->db->insert('questions', $data);

    }





  }

  public function edit($table, $data){
    $this->db->update($table);
  }

  public function delete(){

  }

}
