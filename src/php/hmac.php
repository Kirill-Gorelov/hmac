<?php
namespace kirill\hmac;

define("E_UNSUPPORTED_HASH_ALGO",-1);
class Hmac{
	
	private $algo;
	
	function __construct($algo = "sha256"){
		$this->algo = $algo;
	}

	//создание подписи
	function make_data_hmac($data, $key){
		Hmac::ksort_recursive($data);
		
		$data_enc = $this->serialize_array($data);
		return $this->make_signature($data_enc, $key);
	}
	
	//проверки подписи
	function check_data_hmac($data, $key, $sign_param_name){		
        Hmac::ksort_recursive($data);
		$orig_hmap = $this->make_data_hmac($data, $key);
		if(strtolower($orig_hmap) != strtolower($sign_param_name)) return false;
		else return true;
	}
	
	
	function set_hash_algo($algo){
	
		$algo = strtolower($algo);
		if(in_array($algo, hash_algos()))
			$this->algo = $algo;
		else return 
			E_UNSUPPORTED_HASH_ALGO;
	}
	
	private function serialize_array($data){
		return http_build_query($data);
	}
	
	private function make_signature($data_enc, $key){
		$hmac = hash_hmac($this->algo, $data_enc, $key);
		return $hmac;
	}
	
	public static function ksort_recursive(&$array, $sort_flags = SORT_REGULAR) {
		if (!is_array($array)) return false;
    		ksort($array, $sort_flags);
    		foreach ($array as &$arr) {
				Hmac::ksort_recursive($arr, $sort_flags);
    		}
    	return true;
	}
}


?>