<?php
	interface ISessionManager{
		
		public static function GetSessionManager();
		public function StartSession($Key, $Value);
		public function EndSession($Key);
		
	}
?>