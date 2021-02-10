<?php 
// No direct access
defined('_JEXEC') or die; ?>
<?php 
//use Joomla\CMS\Router\Route;
$currentDateTime = date('Y-m-d H:i:s');
$count = 1;
foreach($phocadownload as $download){
	if(strtotime($currentDateTime)>=strtotime($download['5'])&&((strtotime($currentDateTime)<=strtotime($download['6']))||(strtotime($download['6'])==strtotime('0000-00-00 00:00:00')))){//since I could not do this in the sql statement I'm doing this here ... if current date is later than or equal to the publish_up date
	$url = JURI::root().'index.php?option=com_phocadownload&view=category&download='.$download['2'].':'.$download['1'].'&id='.$download['3'].':'.$download['9'].'&Itemid=367&lang=en';
		echo '<a href="'.$url.'">'.$download['0'].'</a><br/>';
		if($maxentries!=0 && $maxentries==$count){
			break;
		}
		$count++;
	}
?>
