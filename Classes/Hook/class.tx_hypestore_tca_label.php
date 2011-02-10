<?php

class tx_hypestore_tca_label {

	public function getCategory(&$parameters, $plugin) {
		//print_r($parameters);

		$id = $parameters['row']['uid'];
		$title = $parameters['row']['title'];

		$parameters['title'] = $title;
	}

	public function getPrice(&$parameters, $plugin) {
		$title = $parameters['row']['value'] . ', ' . $parameters['row']['quantity'];
		$parameters['title'] = $title;
	}
}

?>