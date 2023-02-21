<?php
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Script file of the PhocaDownload module
 */
class mod_phocaDownloadModuleInstallerScript
{
	/**
	 * Method to install the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function install($parent) 
	{
		echo '<p>The module has been installed.</p>';
	}

	/**
	 * Method to uninstall the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo '<p>The module has been uninstalled.</p>';
	}

	/**
	 * Method to update the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function update($parent) 
	{
		echo '<p>The module has been updated to version' . $parent->get('manifest')->version . '.</p>';
	}

	/**
	 * Method to run before an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	protected $minimumPHPVersion = '7.4.0';
	function preflight($type, $parent) 
	{
		$jversion = new JVersion();
		//installing manifest file version
		$this->release = $parent->get("manifest")->version;
		
		// Check the minimum PHP version
		if (!version_compare(PHP_VERSION, $this->minimumPHPVersion, 'ge'))
		{
			$msg = "<p>You need PHP $this->minimumPHPVersion or later to install this package</p>";
			JLog::add($msg, JLog::WARNING, 'jerror');

			return false;
		}
		
		//compare manifest file minimum Joomla version
		$this->minimum_joomla_release = $parent->get( "manifest" )->attributes()->version;
		
		//show essential information
		echo '<p>'.$type.'ing module manifest file version = ' . $this->release;
		echo '<br />Current manifest cache module version = ' . $this->getParam('version');
		echo '<br />'.$type.'ing module manifest file minimum Joomla version = ' . $this->minimum_joomla_release;
		echo '<br />Current Joomla version = ' . $jversion->getShortVersion();
		
		//abort if the current Joomla version is older
		if( version_compare( $jversion->getShortVersion(), $this->minimum_joomla_release, 'lt' ) ) {
			Jerror::raiseWarning(null, 'Cannot install com_democompupdate in a Joomla release prior to '.$this->minimum_joomla_release);
			return false;
		}
		
		//abort if the module version is not newer
		if ( $type == 'update' ) {
			$oldRelease = $this->getParam('version');
			$rel = $oldRelease . ' to ' . $this->release;
			if ( version_compare( $this->release, $oldRelease, 'le' ) ) {
				Jerror::raiseWarning(null, 'Incorrect version sequence. Cannot upgrade ' . $rel);
				return false;
			}
		}
		else { $rel = $this->release; }
		
		if($type === 'install')
        	{
				echo 'Get Component: '.JComponentHelper::getComponent('com_phocadownload', true)->enabled.'<br/>';
				/*echo 'Component Installed: '.JComponentHelper::isInstalled('com_phocadownload').'<br/>';
				echo 'Component Enabled: '.JComponentHelper::isEnabled('com_phocadownload').'<br/>';
				echo 'Get Component 2: '.JComponentHelper::getComponent('com_phocadownload', bool strict = false).'<br/>';*/
			//check if component Phoca Download is installed and enabled
			$db = JFactory:getDbo();
			$query = $db->getQuery(true);
			$query 
				->select(array('extension_id','name','type','element','client_id','enabled'))
				->from($db->quoteName('#__extensions'))
				->where($db->quoteName('name').'LIKE'.$db->quote('com_phocadownload'));
			$db->setQuery($query);
			$results = $db->loadObjectList();
			echo 'Checking database for phocadownload component ...<br/>';
			print_r($results);
			if (!JComponentHelper::getComponent('com_phocadownload', true)->enabled)
			{
				Jerror::raiseWarning(null, 'cannot install or update the module because the phocadownload component is either not installed or not enabled');
				//stop process and output error
				return false;	
			}
			return 'data returned if type install';
		}
	}

	/**
	 * Method to run after an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		//echo '<p>Anything here happens after the installation/update/uninstallation of the module.</p>';
	}
	/*
	 * get a variable from the manifest file (actually, from the manifest cache).
	 */
	function getParam( $name ) {
		//get params from database if necessary
	}
 
	/*
	 * sets parameter values in the component's row of the extension table
	 */
	function setParams($param_array) {
		//set params in database if necessary
	}
}
