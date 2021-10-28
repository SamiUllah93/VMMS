<?php
	class Debug{
		public static $Debug_Mode = true;
		public static $Debug_Count = 0;
		static function Show($Message,$Data = null){
			if(Debug::$Debug_Mode){
				echo "<br><b>DEBUG ".Debug::$Debug_Count."</b>: $Message <br>";
				if($Data!=null){
					echo "<pre>";
					print_r($Data);
					echo "</pre>";
				}
				Debug::$Debug_Count++;
			}
		}
	}
?>