<?php

/**
 *
 */
class tx_hypestore_tcemain {

	/**
	 *
	 */
	public function __construct() {
		//$LOCAL_LANG = t3lib_div::readLLfile(, $langKey);
		$GLOBALS['LANG']->includeLLfile(t3lib_extMgm::extPath('hype_store') . 'Resources/Private/Language/locallang_db.php');
	}

	/**
	 *
	 */
	function processDatamap_postProcessFieldArray($status, $table, $id, &$fields, &$contentObject) {
		switch($table) {

			# Order
			case 'tx_hypestore_domain_model_order':

				break;

			# Cart item
			case 'tx_hypestore_domain_model_cart_item':

				# get whole record
				$record = t3lib_BEfunc::getRecord($table, $id);

				# merge changes
				$record = ($record) ? array_merge($record, $fields) : $fields;

				# get the product
				$product = t3lib_BEfunc::getRecord('tx_hypestore_domain_model_product', $record['product']);

				if($record['quantity'] < $product['minimum_order_quantity']) {

					# reset quantity to the minimum order quantity if appropriate
					$fields['quantity'] = $product['minimum_order_quantity'];

					# set flash message
					$messageTitle = sprintf($GLOBALS['LANG']->getLL('tx_hypestore.message.cart_item-updated.title'), $product['title']);
					$messageBody = sprintf($GLOBALS['LANG']->getLL('tx_hypestore.message.cart_item-updated.body'), $product['minimum_order_quantity']);

					$message = t3lib_div::makeInstance('t3lib_FlashMessage', $messageBody, $messageTitle, t3lib_FlashMessage::INFO);
					t3lib_FlashMessageQueue::addMessage($message);
				}

				break;
		}
	}
}

?>