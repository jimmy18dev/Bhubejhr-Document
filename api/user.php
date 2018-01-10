<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		// switch ($_GET['request']){
		// 	case 'list':
		// 		$dataset = $app->listAll();

		// 		$returnObject['items'] = $dataset;
		// 		$returnObject['message'] = 'list all apps';
		// 		break;
		// 	default:
		// 		$returnObject['message'] = 'GET API Not found!';
		// 	break;
		// }
    	break;
    case 'POST':
    	switch ($_POST['request']){
    		case 'facebook_login':
    			$fb_id 		= $_POST['fb_id'];
    			$fb_email 	= $_POST['fb_email'];
    			$fb_fname 	= $_POST['fb_fname'];
    			$fb_lname 	= $_POST['fb_lname'];
    			$fb_link 	= $_POST['fb_link'];
    			$fb_verified = $_POST['fb_verified'];
    			$gender 	= $_POST['gender'];

    			$user_id = $user->alreadyFacebookAccount($fb_id,$fb_email);

    			if($user_id == -1){
    				// Register new account.
    				if(!empty($fb_id) && !empty($fb_email)){
    					$user_id = $user->registerFacebook($fb_id,$fb_email,$fb_fname,$fb_lname,$fb_link,$fb_verified,$gender);
    					$returnObject['message'] 	= 'New Account Created from Facebook';
    				}else{
    					$returnObject['message'] 	= 'Facebook or Email Address invalid!';
    				}
    			}else{
    				$user->editFormFacebook($user_id,$fb_id,$fb_email,$fb_fname,$fb_lname,$fb_link,$fb_verified,$gender);
    				// Update to account.
    				$returnObject['message'] 	= 'Update account from Facebook';
    			}
    			$returnObject['user_id'] 	= floatval($user_id);

    			$user->facebookLogin($user_id);
    			break;

    		case 'register':
				$fullname 	= $_POST['fullname'];
				$phone 		= $_POST['phone'];
				$email 		= $_POST['email'];
				$password 	= $_POST['password'];

				$user_id = $user->registerForm($fullname,$phone,$email,$password);

				if(true){
					$state = $user->login($phone,$password);
				}

				$returnObject['message'] 	= 'New Account Created!';
				$returnObject['account_id'] = $user_id;

				break;
			case 'login':
				$username = $_POST['username'];
				$password = $_POST['password'];

				$state = $user->login($_POST['username'],$_POST['password']);

				if($state == 1) $message = 'login success';
				else if($state == 1) $message = 'Login fail';
				else if($state == -1) $message = 'Account Locked';
				else $message = 'n/a';

				$returnObject['message'] 	= $message;
				$returnObject['state'] 		= $state;
				
				break;
			case 'edit_profile':
				$username 	= $_POST['username'];
				$email 		= $_POST['email'];
				$name 		= $_POST['name'];
				$company 	= $_POST['company'];
				$position 	= $_POST['position'];

				$user->editProfile($user->id,$username,$email,$name,$company,$position);

				$returnObject['message'] 	= 'Profile edited.';
				break;
			case 'change_password':
				$newpassword = $_POST['newpassword'];

				$user->changePassword($user->id,$newpassword);

				$returnObject['message'] 	= 'Password changed.';
				break;
			case 'request_verify':
				$user_id 	= $_POST['user_id'];
				$bio 		= $_POST['bio'];

				$user->requestVerify($user->id,$bio);

				$returnObject['message'] 	= 'Verify request Send';
				break;
			default:
				$returnObject['message'] = 'POST API Not found!';
			break;
		}
    	break;
    default:
    	$returnObject['message'] = 'METHOD API Not found!';
    	break;
}

echo json_encode($returnObject);
exit();
?>