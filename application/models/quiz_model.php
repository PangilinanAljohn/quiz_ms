<?php
class Quiz_model extends CI_Model{

  public function __construct() {
			parent::__construct();
	}

  public function add_quiz($title){
    $data = array(
      'quiz_name' => $title,
      'date_added' => date('Y-m-d h:i:s')
    );

    $this->db->insert('quiz', $data);
  }

  public function add_question($title){
    $this->db->select_max('id');
    $query = $this->db->get('quiz');

    $quiz_id = $query->row('id');

    $data = array(
      'quiz_id' => $quiz_id,
      'questions_details' => $title,
      'date_added' => date('Y-m-d h:i:s')
    );

    $this->db->insert('questions', $data);
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
