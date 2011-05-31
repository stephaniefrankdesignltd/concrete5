<?
	
	class Localization {
	
		public function init() {Localization::getTranslate();}
		
		public static function getAvailableInterfaceLanguages() {
			$languages = array();
			$fh = Loader::helper('file');
			
			if (file_exists(DIR_LANGUAGES)) {
				$languages = array_merge($languages, $fh->getDirectoryContents(DIR_LANGUAGES));
			}
			if (file_exists(DIR_LANGUAGES_CORE)) {
				$languages = array_merge($languages, $fh->getDirectoryContents(DIR_LANGUAGES_CORE));
			}
			
			return $languages;
		}

		public function getTranslate() {
			if (LOCALE != 'en_US') {
				static $translate;
				if (!isset($translate)) {
					Loader::library('3rdparty/Zend/Translate');
					$cache = Cache::getLibrary();
					if (is_object($cache)) {
						Zend_Translate::setCache($cache);
					}
					if (LOCALE != 'en_US') {
						if (is_dir(DIR_BASE . '/languages/' . LOCALE)) {
							$translate = new Zend_Translate('gettext', DIR_BASE . '/languages/' . LOCALE, LOCALE);
						}
					}
					
					if (!isset($translate)) {
						$translate = false;
					}
				}
				return $translate;
			}
		}
	}
	
	function t($text) {
		$zt = Localization::getTranslate();
		if (func_num_args() == 1) {
			if (is_object($zt)) {
				return $zt->_($text);
			} else {
				return $text;
			}
		}
		
		$arg = array();
	    for($i = 1 ; $i < func_num_args(); $i++) {
	        $arg[] = func_get_arg($i); 
	    }
		if (is_object($zt)) {
			return vsprintf($zt->_($text), $arg);
		} else {
			return vsprintf($text, $arg);
		}
	}

