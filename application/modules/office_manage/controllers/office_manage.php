<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function add_office()
	{
		$data['page_name'] = '<b>Add Office</b>';
		
		$data['msg'] = '';
		
		if($this->input->post('op'))
		{
			$this->form_validation->set_rules('office_name', 'Office Name', 'required|callback_office_check');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			else
			{
				//Add the office
				$data = array(
								'office_code' 		=> $this->input->post('office_code'),
								'office_name' 		=> $this->input->post('office_name'),
								'office_address' 	=> $this->input->post('office_address'),
								'salary_grade_type' => $this->input->post('salary_grade_type'),
								'office_head' 		=> $this->input->post('office_head'),
								'employee_id' 		=> $this->input->post('employee_id'),
								'position'	  		=> $this->input->post('position')
							);
							
				$this->Office->add_office($data);
				
				$this->session->set_flashdata('msg', 'Office added!');
				
				redirect(base_url().'office_manage/view_offices', 'refresh');
			}
		}
				
		$data['main_content'] = 'add_office';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function edit_office($office_id = '')
	{
		$data['page_name'] = '<b>Edit Office</b>';
		
		$data['msg'] = '';
		
		$data['office'] = $this->Office->get_office_info($office_id);
		
		if($this->input->post('op'))
		{
			$this->form_validation->set_rules('office_name', 'Office Name', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			else
			{
				$data = array(
								'office_code' 		=> $this->input->post('office_code'),
								'office_name' 		=> $this->input->post('office_name'),
								'office_address' 	=> $this->input->post('office_address'),
								'salary_grade_type' => $this->input->post('salary_grade_type'),
								'office_head'		=> $this->input->post('office_head'),
								'employee_id' 		=> $this->input->post('employee_id'),
								'position'	  		=> $this->input->post('position')
							);
							
				$this->Office->update_office($data, $office_id);	
				
				$this->session->set_flashdata('msg', 'Office updated!');
				
				redirect(base_url().'office_manage/view_offices', 'refresh');
			}
		}
				
		$data['main_content'] = 'edit_office';
		
		$this->load->view('includes/template', $data);
	}
	
	
	// --------------------------------------------------------------------
	
	function delete_office($office_id = '')
	{
		$this->Office->delete_office($office_id);
		
		$this->session->set_flashdata('msg', 'Office deleted!');
		
		redirect(base_url().'office_manage/view_offices', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function office_check($office_name)
	{
		$is_office_exists = $this->Office->is_office_exists($office_name);
		
		if ($is_office_exists == TRUE)
		{
			$this->form_validation->set_message('office_check', 'The Office exists!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------
	
	function view_offices()
	{
		$data['page_name'] = '<b>Office Management</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$data['rows'] = $this->Office->get_offices();
		
		$config['base_url'] = base_url().'office_manage/view_offices';
		$config['total_rows'] = $this->Office->num_rows;
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		$data['rows'] = $this->Office->get_offices( $config['per_page'], $this->uri->segment(3));
		
		//echo $this->db->last_query();
		
		$this->pagination->initialize($config);
				
		$data['main_content'] = 'view_offices';
		
		$this->load->view('includes/template', $data);
		
	}
}	

/* End of file office_manage.php */
/* Location: ./system/application/modules/office_manage/controllers/office_manage.php */