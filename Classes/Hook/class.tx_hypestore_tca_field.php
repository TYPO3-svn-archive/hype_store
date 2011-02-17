<?php

class tx_hypestore_tca_field {

	public function categories(&$field, $obj) {
		return $obj->getSingleField_typeSelect($field['table'], $field['field'], $field['row'], $field);
	}
}

?>