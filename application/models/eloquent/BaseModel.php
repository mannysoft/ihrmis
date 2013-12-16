<?php
// https://github.com/betawax/role-model/blob/master/src/Betawax/RoleModel/RoleModel.php#L86-L101

class BaseModel extends Eloquent{
	
	public $errors;	
	
	public static function boot()
	{
		parent::boot();
		
		static::saving(function($model)
		{
			//return $post->validate();	
			if ( ! $model->force) return $model->validate();
		});
	}
	
	public function validate()
	{
		$rules = self::processRules(static::$rules);
		
		$messages = static::$messages;
		
		$validation = Validator::make($this->attributes, $rules, $messages);
		
		if($validation->passes()) return true;
		
		//$this->errors = $validation->messages();
		$this->errors = $validation->messages()->all();
		
		return false;
	}
	
	/**
	 * Process validation rules.
	 *
	 * @param  array  $rules
	 * @return array  $rules
	 */
	protected function processRules($rules)
	{
		$id = $this->getKey();
		
		array_walk($rules, function(&$item) use ($id)
		{
			// Replace placeholders
			$item = stripos($item, ':id:') !== false ? str_ireplace(':id:', $id, $item) : $item;
		});
		
		if($id != NULL)
		{
			if (array_key_exists('password', $rules)) {
				unset($rules['password']);
			}
		}
		
		return $rules;
	}
}