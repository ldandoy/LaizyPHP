<?php

	use system\Model;

	class Article extends Model {
		
		public $parent = array(
			"user" => "User"
		);
	}