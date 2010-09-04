<?php

class tx_hypestore_realurl_autoconfgen {
	public function addRealURLConfig($parameters, $object) {
		
		# get realurl config
		$config = $parameters['config'];
		
		$postVars = array(
			'hype_store' => array(
				/*
				array(
					'GETvar' => 'tx_hypestore_category[controller]',
					'noMatch' => 'bypass'
				),
				array(
					'GETvar' => 'tx_hypestore_category[action]',
					'noMatch' => 'bypass'
				),
				array(
					'GETvar' => 'tx_hypestore_category[path]',
					'noMatch' => 'bypass'
				),
				*/
				array(
					'GETvar' => 'tx_hypestore_category[category]',
					'lookUpTable' => array(
						'table'               => 'tx_hypestore_domain_model_category',
						'id_field'            => 'uid',
						'alias_field'         => 'title',
						'addWhereClause'      => ' AND NOT deleted',
						'useUniqueCache'      => 1,
						'useUniqueCache_conf' => array(
							'strtolower'     => 1,
							'spaceCharacter' => '-',
						),
					),
				),
				/*
				array(
					'GETvar' => 'tx_hypestore_product[controller]',
					'noMatch' => 'bypass'
				),
				array(
					'GETvar' => 'tx_hypestore_product[action]',
					'noMatch' => 'bypass'
				),
				array(
					'GETvar' => 'tx_hypestore_product[path]',
					'noMatch' => 'bypass'
				),
				*/
				array(
					'GETvar' => 'tx_hypestore_product[product]',
					'lookUpTable' => array(
						'table'               => 'tx_hypestore_domain_model_product',
						'id_field'            => 'uid',
						'alias_field'         => 'title',
						'addWhereClause'      => ' AND NOT deleted',
						'useUniqueCache'      => 1,
						'useUniqueCache_conf' => array(
							'strtolower'     => 1,
							'spaceCharacter' => '-',
						),					
					),
				),
			),
		);
		
		if(!is_array($config['postVarSets']['_DEFAULT'])) {
			$config['postVarSets']['_DEFAULT'] = $postVars;
		} else {
			$config['postVarSets']['_DEFAULT'] = array_merge($config['postVarSets']['_DEFAULT'], $postVars);
		}
		
		return $config;
	}
}

?>