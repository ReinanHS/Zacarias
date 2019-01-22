<?php 
/**
 *
 * @copyright     Copyright (c) ReinanHS, Inc. (https://reinanhs.github.io/)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Zacarias\Database\Database;
namespace Zacarias\Controller\Auth;
class AuthController
{
	public function getallheaders()
    {
    	$headers = [];
    	foreach ($_SERVER as $name => $value)
    	{
    		if (substr($name, 0, 5) == 'HTTP_')
    		{
    			$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
    		}
    	}
    	return $headers;
    }
    public function index($teste, $oi)
    {
        echo $teste.' '.$oi;
    }
    public function validToken()
    {
    	if (isset($this->getallheaders()['Authorization']) && !empty($this->getallheaders()['Authorization'])){


			$token = getallheaders()['Authorization'];
			$token = explode('.', $token);

			$header 	= json_decode(base64_decode($token[0]));
			$payload 	= json_decode(base64_decode($token[1]));
			$signature 	= $token[2];

		}

		return false;
    }
    public function gerarToken($data)
    {
    	$header = [
    		'alg' => 'HS256',
    		'typ' => 'JWT'
    	];
    	$header = json_encode($header);
    	$header = base64_encode($header);

    	$payload = $data;
    	$payload = json_encode($payload);
    	$payload = base64_encode($payload);

    	$signature = hash_hmac('sha256',"$header.$payload",'minha-senha',true);
    	$signature = base64_encode($signature);

    	return json_encode([
    		'token' => "$header.$payload.$signature",
    		'status' => true,
    		'msg' => 'Login realizado com sucesso!' 
    	]);
    }
    public function loginAPI($apiUser, $apiSenha)
    {
    	$url = 'http://portaldoaluno.prepara.com.br/login/';
    	$data = array('userdata[login]' => $apiUser, 'userdata[senha]' => $apiSenha);

    	$options = array(
    		'http' => array(
    			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    			'method'  => 'POST',
    			'content' => http_build_query($data)
    		)
    	);

    	$context  = stream_context_create($options);
    	$result = file_get_contents($url, false, $context);

    	$needle = '<script>alert("Combinação de login e senha invalida")</script>';

    	if (strpos($result, $needle) !== false){
    		return false;
    	}

    	return true;
    }
    public function validData()
    {
    	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']))
    	{
    		return $this->authUser($_POST['username'], $_POST['password']);
    	}

    	return false;
    }
    public function authUser($username, $password)
    {

    	if(Database::getUserByUser($username))
    	{
	    	$data = Database::getUserAuth($username, $password);

	    	if($data)
	    	{
	    		return $this->gerarToken($data);
	    	}

	    	return false;
    	}
    	else if($this->loginAPI($username, $password))
    	{
    		$data = $this->createUser([
    			'username' => $username,
    			'password' => $password,
    		]);

    		return $this->gerarToken($data);
    	}

    	return false;

    }
}