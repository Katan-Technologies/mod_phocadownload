<?php
/**
 * Helper class for Phoca Downloads module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_phocadownload is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

class ModPhocaDownloadHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getDownloads($params)
    {
		// Obtain a database connection
//		$db = JFactory::getDbo();
		// Retrieve the shout. Note that we are now retrieving the id not the lang field.
/*		$query = $db->getQuery(true)
					->select($db->quoteName(array('title','alias','id','catid','filename','publish_up','publish_down','access')))//should also get the category id and what ever fields are needed to associate with the pdf file (catid, filename,filename_preview)
					->from($db->quoteName('#__phocadownload'))
					->where ('catid = '.$db->Quote($params).' AND published=1')//were curdate() gets the current date ... could not get comparison between publish_up and publish_down to work in the same clause
					->order ('publish_up DESC');*/
//	    	$query
// 		->select($db->quoteName(array('a.title', 'a.alias', 'a.id', 'a.catid', 'a.filename', 'a.publish_up', 'a.publish_down', 'a.access', 'b.id', 'b.alias')))
// 		->from($db->quoteName('#__phocadownload', 'a'))
// 		->join('INNER', $db->quoteName('#__phocadow3nload_categories', 'b') . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('b.id') . ')')
// 		->where($db->quoteName('b.id') . ' LIKE \'z%\'')
// 		->order($db->quoteName('a.publish_up') . ' DESC');
 
		// Prepare the query
//		$db->setQuery($query);
		// Load the row.
		
//		$results = $db->loadRowList();
	    // Get a db connection.
$db = JFactory::getDbo();

// Create a new query object.
$query = $db->getQuery(true);

// Select all articles for users who have a username which starts with 'a'.
// Order it by the created date.
// Note by putting 'a' as a second parameter will generate `#__content` AS `a`
$query
    //->select(array('a.*', 'b.title', 'b.alias')/*,array('title', 'cattitle', 'catalias')*/)
	->select(array('a.title', 'a.alias','a.id', 'a.catid', 'a.filename', 'a.publish_up', 'a.publish_down', 'a.access', ))
	->select($db->quoteName(array('b.title','b.alias'), array('catTitle','catAlias')))
    ->from($db->quoteName('#__phocadownload', 'a'))
    ->join('INNER', $db->quoteName('#__phocadownload_categories', 'b') . ' ON ' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('b.id'))
    ->where($db->quoteName('b.id') . ' LIKE ' . $db->quoteName('a.catid'))
    ->order($db->quoteName('a.publish_up') . ' DESC');

// Reset the query using our newly populated query object.
$db->setQuery($query);

// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();
	    return $results;
//   return $results;
    }
}
