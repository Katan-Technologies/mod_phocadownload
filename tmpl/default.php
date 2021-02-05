<?php 
// No direct access
defined('_JEXEC') or die; ?>
<?php 
use Joomla\CMS\Router\Route;
$currentDateTime = date('Y-m-d H:i:s');
//echo 'The maximum number of entries to list are: '.$maxentries.'<br/>';
$count = 1;
//echo count($phocadownload).'<br/>';
foreach($phocadownload as $download){
//	echo ' Title: '.$download['0'].' Alias: '.$download['1'].' ID: '.$download['2'].' CatID: '.$download['3'].' PDF: '.$download['4'].' Pup: '.$download['5'].' PDown:'.$download['6'].' Access level: '.$download['7'].'<br/>';
//	echo 'current date / time is less than or equal to the publish down time: '.$currentDateTime<=$download['6'].'<br/>';
//	echo $download['6'];//==new DateTime('0000-00-00 00:00:00');
/*	if (strtotime($currentDateTime)<=strtotime($download['6'])){
		echo 'current date / time is less than or equal to the publish down time<br/>';
	}
	if (strtotime($download['6'])==strtotime('0000-00-00 00:00:00')){
		echo 'publish down time is not set<br/>';
	}*/
//	if (strtotime($currentDateTime)>=strtotime($download['5'])){echo 'it is greater!<br/>';}
	echo 'Category is '.$cat.'</br>';
	if(strtotime($currentDateTime)>=strtotime($download['5'])&&((strtotime($currentDateTime)<=strtotime($download['6']))||(strtotime($download['6'])==strtotime('0000-00-00 00:00:00')))){//since I could not do this in the sql statement I'm doing this here ... if current date is later than or equal to the publish_up date
		echo 'title: '.$download['0'].'<br/>';
//			echo 'count: '.$count.'<br/>';
		if($maxentries!=0 && $maxentries==$count){
			break;
		}
		$count++;
	}

//$count++;
	
//	echo '<br/>';
}
//use Joomla\CMS\Router\Route;
//$url = Route::_("index.php?option=com_example&view=showitem&id=14");
//$url = Route::_("index.php?option=com_phocadownload&view=file&id=3");
//echo $url;
?>
