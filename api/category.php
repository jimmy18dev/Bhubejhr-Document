<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$category 	= new Category();

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'get':
				$category_id = $_GET['category_id'];
				$dataset = $category->get($category_id);
				$returnObject['dataset'] = $dataset;
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	switch ($_POST['request']){
    		case 'create':
    			$name = $_POST['name'];
    			$category_id = $category->create($name,NULL);
    			$returnObject['message'] = 'New category #'.$category_id.' created.';
				break;
			case 'edit':
    			$category_id 	= $_POST['category_id'];
    			$category_name 	= $_POST['category_name'];

    			$category->edit($category_id,$category_name,NULL);
    			$returnObject['message'] = 'New category #'.$category_id.' edited.';
				break;
			case 'delete':
    			$category_id 	= $_POST['category_id'];
    			$category->delete($category_id);
    			$returnObject['message'] = 'Category deleted';
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