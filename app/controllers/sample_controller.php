<?php
	class SampleController extends AppController
	{
		
		public function index()	//function name must be the name of the receiving VIEW (page)
		{
			$messages = Sample::getVar();	//Calling the function from the model

			$this->set(get_defined_vars());	//sending the variable to the receiving VIEW (page)
		}
	}


?>