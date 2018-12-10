<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('quiz_model');
	}

	public function index(){
		$this->load->view('quiz/index');
	}

	public function respondents(){
		$this->load->view('quiz/respondents');
	}

	public function manage_quiz(){
		$this->load->view('quiz/quizzes');
	}

	public function view_add_quiz(){
		$this->load->view('quiz/add_quiz');
	}

	public function add_quiz_title(){
		$quiz = $this->input->post('title');

		$this->quiz_model->add_quiz($quiz);
	}

	public function add_questions(){
		$quiz = $this->input->post('title');

		$this->quiz_model->add_question($quiz);
	}

	public function edit(){
		$data = $this->input->post();
		$table = $data['table_name'];
		$params = $data['params'];

		$this->quiz_model->edit($table, $params);
	}

	public function delete(){

	}

}
