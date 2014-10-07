<?php
trait Logger
{
	public function log($logString)
	{
		$className = __CLASS__;
		echo date("Y-m-d h:i.s", time()). ": [{$className}] {$logString}";
	}
}
echo $user;
class  User
{
	use Logger;
	public $name;
	
	function __construct($name='')
	{
		$this->name = $name;
		$this->log("Created user '{$this->name}'");
	}
	
	function __toString()
	{
		return $this->name;
	}
}

class UserGroup
{
	use Logger;
	
	public $users = array();
	public function addUser(user $user)
	{
		if (!$this->includesUser($user))
		{
			$this->users[]=$user;
			echo ($this->log("Added user '{$user}' to group"));
		}
	}
}

$group = new UserGroup;
$group->addUser(new User("Franklin"));
?>