<?php

class  SdkRuntimeException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}

}

?>