<?php 
// No direct access
defined('_JEXEC') or die; ?>
<?php 
$currentDateTime = date('Y-m-d H:i:s');
foreach($phocadownload as $download){
	//echo ' Title: '.$download['0'].' CatID: '.$download['1'].' PDF: '.$download['2'].' Pup: '.$download['3'].' PDown:'.$download['4'].'<br/>';
	if($currentDateTime>=$download['3']){//since I could not do this in the sql statement I'm doing this here ... if current date is later than or equal to the publish_up date
		echo $download['0'].'<br/>';
	}
}
?>