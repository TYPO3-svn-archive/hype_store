<?php

//print_r('YES!');

class tx_hypestore_tca_field {

	public function categories(&$field, $obj) {
		//print_r($field);

		return $obj->getSingleField_typeSelect($field['table'],$field['field'],$field['row'],&$field);
		//return $obj->getSingleField_typeSelect_multiple($field['table'],$field['field'],$field['row'],&$field,$field['fieldConf']['config'],$field['itemFormElValue'],'');
	}
}

?>