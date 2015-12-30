<?php
class coinbase
{
	private $status = 0;

	public function __construct()
	{
		$this->status = 3;
	}
	public function test()
	{
		return $this->status;
	}
}
?>
