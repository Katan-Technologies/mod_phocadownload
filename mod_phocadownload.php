<?php
/**
 * Phoca Downloads! Module Entry Point
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 * @link       http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * mod_phocadownload is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

//$phocadownload = modPhocaDownloadHelper::getDownloads($params);
$category = $params->get('title','1');
$phocadownload = modPhocaDownloadHelper::getDownloads($category);
/**
  * This retrieves the lang parameter we stored earlier. Note the second part
  * which assigns the default value of 1 if the parameter cannot be
  * retrieved for some reason.
**/
//$language = $params->get('lang', '1');
//$hello    = modPhocaDownloadHelper::getDownloads( $items );
require JModuleHelper::getLayoutPath('mod_phocadownload');
