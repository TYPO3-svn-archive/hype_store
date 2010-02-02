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
 * Checkout controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
 
/*
	STEPS
	
	Things to consider somewhere:
		* Stock needs to be checked on availibility before confirming the order,
		  the user needs to be informed, if some product is out of stock when ordering. (optional)
		
		* After confirmation (last step) the order stored in the session, needs to be
		  persisted in the database, and the session object must be unset.
		
	0 Registration Process
		* Personal Details
		* Contact Details
		* Account Details
		
	1 Address Details
		* Delivery Address
		* Invoice Address
	
	2 Shipping Options
		* Shipping Type
	
	3 Payment Methods
		* CashOnDelivery
		* PrePayment
		* BankTransfer
		* DebitAdvice
		* CreditCard
		* PayPal
		* ...
	
	4 Order Overview
		* Ordered Products
		* Total Price
		* Provided Details
		* Terms
	
	5 Order Confirmation
*/

class Tx_HypeStore_Controller_CheckoutController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $steps;
	
	/**
	 * @var Tx_HypeStore_Controller_Checkout_AbstractStep
	 */
	protected $currentStep;
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		
		# initialize steps
		$this->steps = new Tx_Extbase_Persistence_ObjectStorage;
		
		# register all available steps
		$this->registerSteps();
		
		# order steps based on their dependencies
		$this->sortSteps();
		
		# determines the current step
		$this->determineCurrentStep();
		
		# prepares the current step
		//$this->prepareCurrentStep();
	}
	
	/**
	 * Initializes the view before invoking an action method.
	 *
	 * @param Tx_Extbase_View_ViewInterface $view The view to be initialized
	 * @return void
	 */
	public function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		
		# assign global settings
		$this->view->assign('settings', $this->settings);
		
		# assign steps
		$this->view->assign('steps', $this->getSteps());
	}
	
	/**
	 * Registers all default steps.
	 *
	 * @return void
	 */
	protected function registerSteps() {
		
		$registrationStep = new Tx_HypeStore_Controller_Checkout_RegistrationStep;
		$addressStep = new Tx_HypeStore_Controller_Checkout_AddressStep;
		$shippingStep = new Tx_HypeStore_Controller_Checkout_ShippingStep;
		$paymentStep = new Tx_HypeStore_Controller_Checkout_PaymentStep;
		
		$paymentStep->addDependency($shippingStep);
		$shippingStep->addDependency($addressStep);
		$addressStep->addDependency($registrationStep);
		
		$this->addStep($paymentStep);
		$this->addStep($shippingStep);
		$this->addStep($addressStep);
		$this->addStep($registrationStep);
	}
	
	/**
	 * Sorts all registered steps (using topological sorting).
	 *
	 * @return void
	 */
	protected function sortSteps() {
		
		# define empty stack
		$steps = new Tx_Extbase_Persistence_ObjectStorage;
		
		$temp = $this->getSteps()->toArray();
		
		# loop through all steps
		while($step = array_pop($temp)) {
			
			if($step->hasDependencies()) {
				
				$isSatisfied = TRUE;
				
				foreach($step->getDependencies() as $dependency) {
					if(!$steps->contains($dependency)) {
						$isSatisfied = FALSE;
						break;
					}
				}
				
				if($isSatisfied) {
					$steps->attach($step);
				} else {
					$this->addStep($step);
				}
				
			} else {
				$steps->attach($step);
			}
		}
		
		# define new steps
		$this->setSteps($steps);
	}
	
	/**
	 * Determines the current step.
	 *
	 * @return void
	 */
	protected function determineCurrentStep() {
		foreach($this->getSteps() as $step) {
			if(!$step->isValid() && $step->needsValidation() && $step->isRequired()) {
				$this->currentStep = $step;
				break;
			}
		}
	}
	
	/**
	 * Prepares the current step.
	 *
	 * @return void
	 */
	protected function prepareCurrentStep() {
		$this->currentStep->injectPropertyMapper($this->propertyMapper);
		$this->currentStep->injectSettings($this->settings);
		$this->currentStep->injectFlashMessages($this->flashMessages);
		$this->currentStep->injectValidatorResolver($this->validatorResolver);
		$this->currentStep->injectReflectionService($this->reflectionService);
		$this->currentStep->injectObjectManager($this->objectManager);
	}
	
	/**
	 * Index action for this controller.
	 *
	 * @param string $step
	 * @return string
	 */
	public function indexAction($step = NULL) {
		
		if($step) {
			$stepsArray = $this->getSteps()->toArray();
			
			if(array_key_exists($step, $stepsArray)) {
				$this->currentStep = $stepsArray[$step];
			}
		}
		
		$this->prepareCurrentStep();
		
		$this->view->assign('section', $this->currentStep->processRequest($this->request, $this->response));
	}
	
	public function validateAction() {
		$this->prepareCurrentStep();
		$this->view->assign('section', $this->currentStep->processRequest($this->request, $this->response));
	}
	
	/**
	 * Sets all steps
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $steps
	 * @return void
	 */
	protected function setSteps(Tx_Extbase_Persistence_ObjectStorage $steps) {
		$this->steps = $steps;
	}
	
	/**
	 * Returns all registered steps.
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	protected function getSteps() {
		return $this->steps;
	}
	
	/**
	 * Adds a step to the checkout process.
	 *
	 * @param Tx_HypeStore_Controller_Checkout_AbstractStep $step
	 * @return void
	 */
	protected function addStep(Tx_HypeStore_Controller_Checkout_AbstractStep $step) {
		$this->steps->attach($step);
	}
	
	/**
	 * Removes a step to the checkout process.
	 *
	 * @param Tx_HypeStore_Controller_Checkout_AbstractStep $step
	 * @return void
	 */
	protected function removeStep(Tx_HypeStore_Controller_Checkout_AbstractStep $step) {
		$this->steps->detach($step);
	}
}
?>