<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->model('quiz_model');
	}

	public function index(){
		$this->load->view('quiz/index');
	}

	public function respondents(){
		$this->data['respondent'] = $this->quiz_model->get_respondents();
		$this->load->view('quiz/respondents', $this->data);
	}

	public function get_all_quiz(){
		$m_data = $this->quiz_model->get_all_quiz();
		$data = array();

		foreach ($m_data as $value) {
				$row = array();
				$row[] = $value->id;
				$row[] = $value->quiz_name;
				$row[] = $value->quiz_info;
				$row[] = $value->questions;
				$row[] = $value->date_added;
				if($value->InActive == 0){
					$row[] = '<button type="button" id="edit" class="btn bg-yellow btn-circle waves-effect waves-circle waves-float">
												<i class="material-icons">mode_edit</i>
										</button>
										<button type="button" id="delete" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
												<i class="material-icons">delete_forever</i>
										</button>
										<button type="button" id="activate" class="btn bg-green btn-circle waves-effect waves-circle waves-float">
												<i class="material-icons">power_settings_newr</i>
										</button>';
				}else{
					$row[] = '<button type="button" id="deactivate" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
												<i class="material-icons">power_settings_newr</i>
										</button>';
				}
				$data[] = $row;
			}
			$result = array(
				"data" => $data,
			);

		echo json_encode($result);
	}

	public function manage_quiz(){
		$this->load->view('quiz/quizzes');
	}

	public function view_add_quiz(){
		$this->load->view('quiz/add_quiz');
	}

	public function add_quiz(){
		$quiz = json_decode($this->input->post('quiz'), true);
		$this->quiz_model->add_quiz($quiz);
	}

	public function view_edit_quiz(){
		$id = $this->input->post('id');
		$this->data['quiz_info'] = $this->quiz_model->get_quiz_info($id);
		$this->data['quiz_question'] = $this->quiz_model->get_quiz_question($id);

		$this->load->view('quiz/edit_quiz', $this->data);
	}

	public function edit_quiz_title(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$this->quiz_model->edit_quiz_title($id, $name);
	}

	public function edit_quiz_info(){
		$id = $this->input->post('id');
		$info = $this->input->post('info');
		$this->quiz_model->edit_quiz_info($id, $info);
	}

	public function edit_quiz_no_page(){
		$id = $this->input->post('id');
		$info = $this->input->post('info');
		$this->quiz_model->edit_quiz_no_page($id, $info);
	}

	public function edit_quiz_question(){
		$id = $this->input->post('id');
		$info = $this->input->post('info');
		$this->quiz_model->edit_quiz_question($id, $info);
	}

	public function edit_quiz_choice(){
		$id = $this->input->post('id');
		$info = $this->input->post('info');
		$this->quiz_model->edit_quiz_choice($id, $info);
	}

	public function set_correct_answer(){
		$id = $this->input->post('id');
		$this->quiz_model->set_correct_answer($id);
	}

	public function delete_question(){
		$id = $this->input->post('id');
		$this->quiz_model->delete_question($id);
	}

	public function activate_quiz(){
		$id = $this->input->post('id');
		$this->quiz_model->activate_quiz($id);
	}

	public function deactivate_quiz(){
		$id = $this->input->post('id');
		$this->quiz_model->deactivate_quiz($id);
	}

	public function exam(){
		$this->data['quiz'] = $this->quiz_model->get_per_page();
		$config ['base_url'] = base_url().'quiz/exam/';
    $config ['total_rows'] = $this->db->get('questions')->num_rows();
    $config ['uri_segment'] = 3;
    $config ['per_page'] = $this->data['quiz']->q_per_page;
    $config ['num_links'] = 10;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="waves-effect"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $page = $config ['per_page']; // how many number of records on page
    $segment = $this->uri->segment ( 3 ); // from which index I have to count $page number of records

    $this->data['questions']= $this->quiz_model->get_questions($page, $segment);

    $this->load->view('quiz/exam', $this->data);
	}

	public function add_respondent(){
		$id = $this->input->post('id');
		$last_name = $this->input->post('last_name');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$score = $this->input->post('score');

		$exist = $this->quiz_model->check_respondent($id, $last_name, $first_name, $middle_name);
		if($exist){

			$this->session->set_flashdata('message',"<div class='alert bg-pink alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
					You've been already taken the quiz. Your score is '.$exist->score.'
			</div>");

		} else {
			$this->quiz_model->add_respondent($id, $first_name, $last_name, $middle_name, $score);
		}
		redirect('quiz/exam', $this->data);
	}

}
