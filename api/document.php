<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$document = new Document();

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
    		case 'update_download':
    			$file_id = $_POST['file_id'];
    			$document->updateDownload($file_id);
    			break;
    		case 'edit':
    			$file_id = $_POST['file_id'];
    			$category_id = $_POST['category_id'];
    			$title = $_POST['title'];
    			$description = $_POST['description'];
    			$privacy = $_POST['privacy'];
    			$document->edit($file_id,$category_id,$title,$description,$privacy);
    			break;
    		case 'change_privacy':
    			$file_id = $_POST['file_id'];
    			$privacy = $_POST['privacy'];
    			$document->changePrivacy($file_id,$privacy);
    			break;
    		case 'delete':
    		
				$file_id = $_POST['file_id'];
				$document->get($file_id);
				$file_location = '../document/'.$document->file_name;
				$qrcode_location = '../image/qrcode/'.$document->file_name.'.png';

				if(file_exists($file_location)){
					unlink($file_location);
				}

				if(file_exists($qrcode_location)){
					unlink($qrcode_location);
				}

				$document->delete($document->id);

				$returnObject['message'] 	= 'Document file deleted';

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