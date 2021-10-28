<?php
	/**
	 * Singleton class
	 *
	 **/
	final class SessionManager implements ISessionManager{
		
		private function __CONSTRUCT(){
			session_start();
		}
		
		 /**
		 * Call this method to get singleton
		 *
		 * @return SessionManager
		 */
		public static function GetSessionManager(){
			static $inst = null;
			if ($inst === null) {
				$inst = new SessionManager();
			}
			return $inst;
		}
		
		function StartSession($Key, $Value){
			if(empty($Key) || empty($Value)){
				Debug::Show("Either Key or Value is empty.");
				return false;
			}else{
                $_SESSION[$Key] = $Value;
				Debug::Show("Session created againts <b>$Key</b>.");
				return true;
			}
		}
		
		function SessionExists($Key){
			return isset($_SESSION[$Key]);
		}

        static function GetSessionValue($key){
		    return $_SESSION[$key];
        }

		function EndSession($Key){
            Debug::Show("Checking sess exists?");
			if($this->SessionExists($Key)){
                unset($_SESSION[$Key]);
                return True;
//				if()){
//					Debug::Show("Session destroyed successfully against $Key.");
//					return true;
//				}else{
//					Debug::Show("Could not destroy successfully against $Key.");
//					return false;
//				}
			}else{
				return true;
			}
		}
		
	}
?>