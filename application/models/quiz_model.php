<?php
class Quiz_model extends CI_Model{

  public function __construct() {
			parent::__construct();
	}

  public function get_all_quiz(){
    $this->db->select('A.*, COUNT(B.quiz_id) as questions');
    $this->db->join('questions B', 'A.id = B.quiz_id');
    $this->db->group_by('B.quiz_id');
    $query = $this->db->get('quiz A');

    return $query->result();
  }

  public function get_quiz_info($id){
    $this->db->where('id', $id);
    $query = $this->db->get('quiz');

    return $query->row();
  }

  public function get_quiz_question($id){
    $this->db->where('quiz_id', $id);
    $query = $this->db->get('questions');

    return $query->result();
  }

  public function get_choices($id){
    $this->db->where('question_id', $id);
    $query = $this->db->get('choices');

    return $query->result();
  }

  public function add_quiz($quiz){

    $quiz_data = array(
      'quiz_name' => $quiz['quiz_title'],
      'quiz_info' => $quiz['quiz_info'],
      'q_per_page' => 10,
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

  public function edit_quiz_title($id, $name){
    $this->db->where('id', $id);
    $this->db->set('quiz_name', $name);
    $this->db->update('quiz');
  }

  public function edit_quiz_info($id, $info){
    $this->db->where('id', $id);
    $this->db->set('quiz_info', $info);
    $this->db->update('quiz');
  }

  public function edit_quiz_no_page($id, $info){
    $this->db->where('id', $id);
    $this->db->set('q_per_page', $info);
    $this->db->update('quiz');
  }

  public function edit_quiz_question($id, $info){
    $this->db->where('id', $id);
    $this->db->set('questions_details', $info);
    $this->db->update('questions');
  }

  public function edit_quiz_choice($id, $info){
    $this->db->where('id', $id);
    $this->db->set('choices_details', $info);
    $this->db->update('choices');
  }

  public function set_correct_answer($id){
    $this->db->where('id', $id);
    $this->db->set('answer', 1);
    $this->db->update('choices');
  }

  public function delete_question($id){
    $this->db->where('question_id', $id);
    $this->db->delete('choices');

    $this->db->where('id', $id);
    $this->db->delete('questions');
  }

  public function activate_quiz($id){
    $this->db->where('id', $id);
    $this->db->set('InActive', 1);
    $this->db->update('quiz');
  }

  public function deactivate_quiz($id){
    $this->db->where('id', $id);
    $this->db->set('InActive', 0);
    $this->db->update('quiz');
  }

  public function get_questions($page, $segment){
    // $this->db->select("id");
    $this->db->limit($page, $segment);
    $query = $this->db->get('questions');

    return $query->result();
  }

  public function get_per_page(){
    $query = $this->db->get('quiz');

    return $query->row();
  }

  public function check_respondent($id, $last_name, $first_name, $middle_name){
    $this->db->where(array(
      'quiz_id' => $id,
      'last_name' => $last_name,
      'first_name' => $first_name,
      'middle_name' => $middle_name
    ));
    $query = $this->db->get('respondent');

    return $query->row();
  }

  public function add_respondent($id, $first_name, $last_name, $middle_name, $score){
    $data = array(
      'last_name' => $last_name,
      'first_name' => $first_name,
      'middle_name' => $middle_name,
      'email' => 'email@admin.com',
      'contact_no' => 1234567,
      'score' => $score,
      'quiz_id' => $id,
      'date_taken' => date('Y-m-d h:i:s')
    );
    $this->db->insert('respondent', $data);
  }

  public function get_respondents(){
    $this->db->join('quiz B', 'A.quiz_id = B.id');
    $query = $this->db->get('respondent A');

    return $query->result();
  }
}
