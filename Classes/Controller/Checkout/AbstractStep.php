<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Abstract step
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
abstract class Tx_HypeStore_Controller_Checkout_AbstractStep extends Tx_Extbase_MVC_Controller_ActionController implements Tx_HypeStore_Controller_Checkout_StepInterface {
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $dependencies;
	
	public function __construct() {
		parent::__construct();
		$this->dependencies = new Tx_Extbase_Persistence_ObjectStorage;
	}
	
	public function processRequest(Tx_Extbase_MVC_Request $request, Tx_Extbase_MVC_Response $response) {
		parent::processRequest($request, $response);
		
		$content = $this->response->getContent();
		$this->response->setContent('');
		
		return $content;
	}
	
	public function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		
		$extbaseFrameworkConfiguration = Tx_Extbase_Dispatcher::getExtbaseFrameworkConfiguration();
		
		if (isset($extbaseFrameworkConfiguration['view']['templateRootPath']) && strlen($extbaseFrameworkConfiguration['view']['templateRootPath']) > 0) {
			$view->setTemplatePathAndFilename(t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath'] . 'Checkout/' .ucfirst($this->getName()) . '/' . strtolower($this->request->getControllerActionName())) . '.html');
		} else {
			$view->setTemplatePathAndFilename(t3lib_div::getFileAbsFileName('typo3conf/ext/hype_store/Resources/Private/Templates/Checkout/' .ucfirst($this->getName())  . '/' . strtolower($this->request->getControllerActionName())) . '.html');
		}
	}
	
	/* Validation */
	abstract public function isValid();
	abstract public function needsValidation();
	
	public function isRequired() {
		return TRUE;
	}
	
	public function isAccessible() {
		return $this->isValid() || !$this->needsValidation();
	}
	
	/* Dependencies */
	public function setDependencies(Tx_Extbase_Persistence_ObjectStorage $dependencies) {
		$this->dependencies = $dependencies;
	}
	
	public function getDependencies() {
		return $this->dependencies;
	}
	
	public function addDependency(Tx_HypeStore_Controller_Checkout_AbstractStep $dependency) {
		$this->dependencies->attach($dependency);
	}
	
	public function removeDependency(Tx_HypeStore_Controller_Checkout_AbstractStep $dependency) {
		$this->dependencies->detach($dependency);
	}
	
	public function removeDependencies() {
		$this->dependencies = new Tx_Extbase_Persistence_ObjectStorage;
	}
	
	public function hasDependencies() {
		return count($this->dependencies) > 0;
	}
	
	/* Utilities */
	public function getName() {
		return strtolower(substr(get_class($this), 33, strlen(get_class($this)) - 37));
	}
	
	public function getIdentifier() {
		return spl_object_hash($this);
	}
	
	/* Magic */
	public function __call($name, $arguments) {
		if(preg_match('~^get~', $name)) {
			$methodName = substr($name, 3);
			
			if(method_exists($this, $methodName)) {
				return $this->{$methodName}();
			}
		}
	}
}
?>