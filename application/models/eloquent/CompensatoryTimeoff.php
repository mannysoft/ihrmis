<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');

class CompensatoryTimeoff extends BaseModel {

	protected $table = "compensatory_timeoffs";
	
	protected $fillable = array(
						
						'employee_id',
						'office_id',
						'month',
						'year',
						'days',
						'dates',
						'date_file',
						'type',
						'status',
						
						);
						
	protected static $rules = array(
						//'user_id' 	=> 'required',
						//'name' 		=> 'required',
	);
	
	protected static $messages = array(
			//'lname.required' => 'The Last Name field is required.',
			//'fname.required' 	=> 'required|max:50',
			//'email' 	=> 'required|email|unique:users,email,:id:',
			//'password' 	=> 'required',
	);					
	
	// --------------------------------------------------------------------
	
	public function employee()
    {
		return self::belongsTo('Employee');
    }
	
	// --------------------------------------------------------------------
	
	public function office()
    {
		return self::belongsTo('Office');
    }
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all leave applications
	 *
	 * @param int $approved
	 * @return array
	 */
	public function getApps($per_page = "", $off_set = "", $approved = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		if ( $approved != '')
		{
			$this->db->where('approved', $approved);
		}
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		$this->db->where('type', 'spent');
		
		$this->db->order_by('id', 'desc');
		
		if ( $per_page != '' or $off_set != '' )
		{
			$this->db->limit($per_page, $off_set);
		}
		
		$q = $this->db->get('compensatory_timeoffs');
		
		$this->num_rows = $q->num_rows();
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;	
			}
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Search leave applications
	 *
	 * @param int $tracking_no
	 * @return array
	 */
	public function search_cto_apps($tracking_no = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		if ($tracking_no != '')
		{
			 $this->db->where('id', $tracking_no);
		}	 
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		$this->db->where('type', 'spent');
		
		//$this->db->order_by('date_encode');
		
		$q = $this->db->get('compensatory_timeoffs');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;	
			}
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	
	public function get_cto_apps_info($tracking_no)
	{
		$this->db->select($this->fields);
		
		$data = array();
		
		$this->db->where('id', $tracking_no);
		$q = $this->db->get('compensatory_timeoffs');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;	
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	public static function getEarnedSpent($employee_id, $earn = 'earn')
	{
		
		
		$days = CompensatoryTimeoff::where('employee_id', '=', $employee_id)
				->where('type', '=', $earn)
				->where('status', '=', 'active')
				->sum('days');
				//->first();
				
				//var_dump($days);
				
		if ($days == null)
		{
			return 0;
		}
		
		return $days;
		
		
		
	}
	
	public static function getBalance($employee_id)
	{
		$days = CompensatoryTimeoff::where('employee_id', '=', $employee_id)
				->where('type', '=', 'balance')->first();	
				
		if ($days == null)
		{
			return 0;
		}
		
		return $days->days;			
	}
	
	public static function getId($employee_id)
	{
		return CompensatoryTimeoff::where('employee_id', '=', $employee_id)
				->where('type', '=', 'balance')->first();
				
				
	}
	
	public static function setApproved($id = '')
	{
		$c = CompensatoryTimeoff::find($id);
		$c->status = 'active';
		$c->save();
	}
}