<?php

class User{

	private $_apiRoot = 'http://localhost:8000/api';

	public function __construct(){}

	private function _json2array($json){
		$jsonDecode = json_decode($json, true);
		return $jsonDecode;
	}


	public function getUsers(){
		$_apiUrl = $this->_apiRoot.'/user';
		$jsonData = file_get_contents($_apiUrl);
		$result = $this->_json2array($jsonData);
		return $result;
	}

	public function getUserByUid($id){
		$_apiUrl = $this->_apiRoot.'/user/'.$id;
		$jsonData = file_get_contents($_apiUrl);
		$result = $this->_json2array($jsonData);
		if(!$result){
			return 'Msg:Can not found User.';
		}
		return $result;
	}

	public function renderHtml($array){
		$html='';
		foreach($array as $id => $value){
			$html.='<li>UID:'.$value['uid'].'</li>';
			$html.='<li>Name:'.$value['name'].'</li>';
			$html.='<li>Email:'.$value['email'].'</li>';
			$html.='<li>Created_at:'.$value['created_at'].'</li>';
			$html.='<hr>';
		}
		return $html;
	}

}

$User= new User();
$r = $User->getUsers();
$res = $User->renderHtml($r);
?>

<html>
<?php echo $res; ?>
</html>