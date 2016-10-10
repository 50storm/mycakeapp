<?php
class Bookmark extends AppModel{
	public $belongsTo  = array('User');
	public $validate = array(
    'url' => array(
    	'rule' =>'notEmpty',
        'rule' => 'url'
    	)
	);
/*
	public function test(){
		debug($this->data);

	}
*/
}
