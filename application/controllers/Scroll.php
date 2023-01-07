<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scroll extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Scroll_model');
	}

	public function index()
	{
		$this->load->view('scroll_dynamic');
	}

	public function scroll_static()
	{
		$this->load->view('scroll_static');
	}

	function fetch()
	{
		$output = '';
		$data = $this->Scroll_model->fetch_data($this->input->post('limit'), $this->input->post('start'));
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$output .= '
				<div class="post_data">
					<h3 class="text-danger">' . $row->title . '</h3>
					<p>' . $row->description . '</p>
				</div>
				';
			}
		}
		echo $output;
	}
}
