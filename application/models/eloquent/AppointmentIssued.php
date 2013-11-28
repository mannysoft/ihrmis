<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');

class AppointmentIssued extends BaseModel {

	protected $table = "appointment_issued";
	
	protected $fillable = array(
						
						'employee_id',
						'position',
						'sg',
						'status',
						'nature',
						'item_no',
						'publication',
						'issuance',
						'received_csc',
						'kss',
						'pdf',
						'pds',
						'education',
						'eligibility',
						'nbi',
						'oath',
						'med_cert',
						'saln',
						'pes',
						'remarks',
						'year',
						//'med_cert',
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
}