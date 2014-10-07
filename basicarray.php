<?php
	class BasicArray implements Iterator
	{
		private $position = 0;
		private $array = ["first", "scond", "third"];
		
		public function __construct()
		{
			$this->position = 0;
		}
		
		public function rewind()
		{
			$this->position = 0;
		}
		
		public function current()
		{
			return $this->array[$this->position];
		}
		
		public function  key()
		{
			return $this->position;
		}
		
		public function next()
		{
			$this->position += 1;
		}
		
		public function valid()
		{
			return isset($this->array[$this->positin]);
		}
	}
	$basicArray = new BasicArray;
	foreach ($basicArray as $value)
	{
		echo "{$value}\n";
	}
	foreach ($basicArray as $key => $value)
	{
		echo "{$key} => {$value}\n";
	}
?>
