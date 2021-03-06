<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$member = new Member();

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
    		case 'active':
    			$member_id = $_POST['member_id'];
    			$member->updateStatus($member_id,'active');
    			$returnObject['message'] = 'MemberID '.$member_id.' is update status to approved';
				break;
			case 'lock':
				$member_id = $_POST['member_id'];
    			$member->updateStatus($member_id,'locked');
    			$returnObject['message'] = 'MemberID '.$member_id.' is update status to Locked!';
				break;
			case 'verified':
				$member_id = $_POST['member_id'];
				$member->confirmEmployee($member_id);
				$returnObject['message'] = 'MemberID '.$member_id.' is employee confirm!';
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