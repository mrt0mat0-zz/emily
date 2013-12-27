<?php

class Company extends Eloquent {
    protected $guarded = array();

    public static $rules = array();
	
	public function types(){
		return $this->hasMany('Type');
	}
}