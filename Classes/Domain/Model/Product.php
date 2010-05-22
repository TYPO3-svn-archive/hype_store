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
 * Product
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Product extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 255)
	 */
	protected $subtitle;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $identifier;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 255)
	 */
	protected $gtin;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $type;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $introduction;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $description;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Category>
	 * @lazy
	 */
	protected $categories;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 * @lazy
	 */
	protected $relatedProducts;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $images;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $files;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Article>
	 * @lazy
	 */
	protected $articles;
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Manufacturer
	 * @lazy
	 */
	protected $manufacturer;
	
	/**
	 * @var float
	 */
	protected $flatPrice;

	/**
	 * @var Tx_HypeStore_Domain_Model_TaxGroup
	 */
	protected $taxGroup;

	/**
	 * @var integer
	 * validate Integer
	 */
	protected $minimumOrderQuantity;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductPrice>
	 * @lazy
	 * @cascade remove
	 */
	protected $scaledPrices;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductAttribute>
	 * @lazy
	 * @cascade remove
	 */
	protected $attributes;
	
	/**
	 * @var integer
	 * validate Integer
	 */
	protected $stockThreshold;
	
	/**
	 * @var integer
	 * validate Integer
	 */
	protected $stockUnit;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductStock>
	 * @lazy
	 * @cascade remove
	 */
	protected $stocks;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		$this->categories		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedProducts	= new Tx_Extbase_Persistence_ObjectStorage();
		$this->scaledPrices		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->attributes		= new Tx_Extbase_Persistence_ObjectStorage();
		$this->stocks			= new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {
		
		# initialize the product service
		$this->productService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_ProductService');
	}
	
	/**
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Setter for subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}
	
	/**
	 * Getter for subtitle
	 *
	 * @return string
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}
	
	/**
	 * Setter for identifier
	 *
	 * @param string $identifier
	 * @return void
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}
	
	/**
	 * Getter for identifier
	 *
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}
	
	/**
	 * Setter for gtin
	 *
	 * @param string $gtin
	 * @return void
	 */
	public function setGtin($gtin) {
		$this->gtin = $gtin;
	}
	
	/**
	 * Getter for gtin
	 *
	 * @return string
	 */
	public function getGtin() {
		return $this->gtin;
	}
	
	/**
	 * Setter for type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * Getter for type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Setter for introduction
	 *
	 * @param string $introduction
	 * @return void
	 */
	public function setIntroduction($introduction) {
		$this->introduction = $introduction;
	}
	
	/**
	 * Getter for introduction
	 *
	 * @return string
	 */
	public function getIntroduction() {
		return $this->introduction;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $categories
	 * @return void
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = clone $categories;
	}
	
	/**
	 * Adds a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}
	
	/**
	 * Removes a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function removeCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->detach($category);
	}
	
	/**
	 * Remove all categories
	 *
	 * @return void
	 */
	public function removeCategories() {
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getCategories() {
		if($this->categories instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->categories->_loadRealInstance();
		}
		
		return clone $this->categories;
	}
	
	/**
	 * Setter for related products
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $products
	 * @return void
	 */
	public function setRelatedProducts(Tx_Extbase_Persistence_ObjectStorage $products) {
		$this->relatedProducts = clone $products;
	}
	
	/**
	 * Adds a related product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function addRelatedProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->relatedProducts->attach($product);
	}
	
	/**
	 * Removes a related product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function removeRelatedProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->relatedProducts->detach($product);
	}
	
	/**
	 * Remove all related products
	 *
	 * @return void
	 */
	public function removeRelatedProducts() {
		$this->relatedProducts = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for related products
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getRelatedProducts() {
		if($this->relatedProducts instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->relatedProducts->_loadRealInstance();
		}
		
		return clone $this->relatedProducts;
	}
	
	/**
	 * Setter for images
	 *
	 * @param array $images
	 * @return void
	 */
	public function setImages(array $images) {
		$this->images = implode(',', $images);
	}
	
	/**
	 * Adds an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function addImage($image) {
		$this->images = implode(',', array_push(explode(',', $this->images), $image));
	}
	
	/**
	 * Removes an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function removeImage($image) {
		//$this->images = explode(',', $this->images);
	}
	
	/**
	 * Removes all images
	 *
	 * @return void
	 */
	public function removeImages() {
		$this->images = '';
	}
	
	/**
	 * Getter for images
	 *
	 * @return array
	 */
	public function getImages() {
		if(!$this->images) {
			return NULL;
		}
		
		return explode(',', $this->images);
	}
	
	/**
	 * Setter for files
	 *
	 * @param array $images
	 * @return void
	 */
	public function setFiles(array $files) {
		$this->files = implode(',', $files);
	}
	
	/**
	 * Adds a file
	 *
	 * @param string $file
	 * @return void
	 */
	public function addFile($file) {
		$this->files = implode(',', array_push(explode(',', $this->files), $file));
	}
	
	/**
	 * Removes a file
	 *
	 * @param string $file
	 * @return void
	 */
	public function removeFile($file) {
		//$this->images = explode(',', $this->images);
	}
	
	/**
	 * Removes all files
	 *
	 * @return void
	 */
	public function removeFiles() {
		$this->files = '';
	}
	
	/**
	 * Getter for images
	 *
	 * @return array
	 */
	public function getFiles() {
		if(!$this->files) {
			return NULL;
		}
		
		return explode(',', $this->files);
	}
	
	/**
	 * Setter for manufacturer
	 *
	 * @param Tx_HypeStore_Domain_Model_Manufacturer $manufacturer
	 * @return void
	 */
	public function setManufacturer(Tx_HypeStore_Domain_Model_Manufacturer $manufacturer) {
		$this->manufacturer = $manufacturer;
	}
	
	/**
	 * Getter for manufacturer
	 *
	 * @return Tx_HypeStore_Domain_Model_Manufacturer
	 */
	public function getManufacturer() {
		if($this->manufacturer instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->manufacturer->_loadRealInstance();
		}
		
		return $this->manufacturer;
	}
	
	/**
	 * Setter for articles
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $articles
	 * @return void
	 */
	public function setArticles(Tx_Extbase_Persistence_ObjectStorage $articles) {
		$this->articles = clone $articles;
	}
	
	/**
	 * Adds an article
	 *
	 * @param Tx_HypeStore_Domain_Model_Article $category
	 * @return void
	 */
	public function addArticle(Tx_HypeStore_Domain_Model_Category $article) {
		$this->articles->attach($category);
	}
	
	/**
	 * Removes an article
	 *
	 * @param Tx_HypeStore_Domain_Model_Article $article
	 * @return void
	 */
	public function removeArticle(Tx_HypeStore_Domain_Model_Category $article) {
		$this->articles->detach($article);
	}
	
	/**
	 * Remove all articles
	 *
	 * @return void
	 */
	public function removeArticles() {
		$this->articles = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for articles
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getArticles() {
		if($this->articles instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->articles->_loadRealInstance();
		}
		
		return clone $this->articles;
	}
	
	/**
	 * Setter for flat price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setFlatPrice($price) {
		$this->flatPrice = $price;
	}
	
	/**
	 * Getter for flat price
	 *
	 * @return string
	 */
	public function getFlatPrice() {
		return $this->flatPrice;
	}

	/**
	 * Setter for tax
	 *
	 * @param int $tax
	 * @return void
	 */
	public function setTax($tax) {
		$this->tax = $tax;
	}

	/**
	 * Getter for tax
	 *
	 * @return int
	 */
	public function getTax() {
		return $this->tax;
	}
	
	/**
	 * Setter for minimum order quantity
	 *
	 * @param float $quantity
	 * @return void
	 */
	public function setMinimumOrderQuantity($quantity) {
		$this->minimumOrderQuantity = $quantity;
	}
	
	/**
	 * Getter for minimum order quantity
	 *
	 * @return string
	 */
	public function getMinimumOrderQuantity() {
		return $this->minimumOrderQuantity;
	}
	
	/**
	 * Setter for scaled prices
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $prices
	 * @return void
	 */
	public function setScaledPrices(Tx_Extbase_Persistence_ObjectStorage $prices) {
		$this->scaledPrices = clone $prices;
	}
	
	/**
	 * Adds a scaled price
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductPrice $price
	 * @return void
	 */
	public function addScaledPrice(Tx_HypeStore_Domain_Model_ProductPrice $price) {
		$this->scaledPrices->attach($price);
	}
	
	/**
	 * Removes a scaled price
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductPrice $price
	 * @return void
	 */
	public function removeScaledPrice(Tx_HypeStore_Domain_Model_ProductPrice $price) {
		$this->scaledPrices->detach($price);
	}
	
	/**
	 * Remove all scaled prices
	 *
	 * @return void
	 */
	public function removeScaledPrices() {
		$this->scaledPrices = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for scaled prices
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getScaledPrices() {
		if($this->scaledPrices instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->scaledPrices->_loadRealInstance();
		}
		
		return clone $this->scaledPrices;
	}
	
	/**
	 * Setter for attributes
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $attributes
	 * @return void
	 */
	public function setAttributes(Tx_Extbase_Persistence_ObjectStorage $attributes) {
		$this->attributes = clone $attributes;
	}
	
	/**
	 * Adds an attribute
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductAttribute $price
	 * @return void
	 */
	public function addAttribute(Tx_HypeStore_Domain_Model_ProductAttribute $attribute) {
		$this->attributes->attach($attribute);
	}
	
	/**
	 * Removes an attribute
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductAttribute $attribute
	 * @return void
	 */
	public function removeAttribute(Tx_HypeStore_Domain_Model_ProductAttribute $attribute) {
		$this->attributes->detach($attribute);
	}
	
	/**
	 * Remove all attributes
	 *
	 * @return void
	 */
	public function removeAttributes() {
		$this->attributes = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for attributes
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getAttributes() {
		if($this->attributes instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->attributes->_loadRealInstance();
		}
		
		return clone $this->attributes;
	}
	
	/**
	 * Setter for stock threshold
	 *
	 * @param integer $threshold
	 * @return void
	 */
	public function setStockThreshold($threshold) {
		$this->stockThreshold = $threshold;
	}
	
	/**
	 * Getter for stock threshold
	 *
	 * @return integer
	 */
	public function getStockThreshold() {
		return $this->stockThreshold;
	}
	
	/**
	 * Setter for stock unit
	 *
	 * @param integer $unit
	 * @return void
	 */
	public function setStockUnit($unit) {
		$this->stockUnit = $unit;
	}
	
	/**
	 * Getter for stock unit
	 *
	 * @return integer
	 */
	public function getStockUnit() {
		return $this->stockUnit;
	}
	
	/**
	 * Setter for stocks
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $stocks
	 * @return void
	 */
	public function setStocks(Tx_Extbase_Persistence_ObjectStorage $stocks) {
		$this->stocks = clone $stocks;
	}
	
	/**
	 * Adds a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_DepotStock $stock
	 * @return void
	 */
	public function addStock(Tx_HypeStore_Domain_Model_DepotStock $stock) {
		$this->stocks->attach($stock);
	}
	
	/**
	 * Removes a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_DepotStock $stock
	 * @return void
	 */
	public function removeStock(Tx_HypeStore_Domain_Model_DepotStock $stock) {
		$this->stocks->detach($stock);
	}
	
	/**
	 * Remove all stocks
	 *
	 * @return void
	 */
	public function removeStocks() {
		$this->stocks = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for stocks
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStocks() {
		if($this->stocks instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->stocks->_loadRealInstance();
		}
		
		return clone $this->stocks;
	}
	
	
	
	/* Service methods */

	/**
	 * Gets the calculated gross price
	 *
	 * @return double
	 */
	public function getGrossPrice() {
		return $this->productService->getPrice($this);
	}
	
	/**
	 * Gets the calculated stock quantity
	 *
	 * @return int
	 */
	public function getStock() {
		return $this->productService->getStock($this);
	}
	
	
	
	/* Service methods */

	/**
	 * Returns all rootlines for this product
	 *
	 * @return array
	 */
	public function getRootlines() {
		return $this->productService->getRootlines($this);
	}
	
	/**
	 * Returns the first rootline of this product
	 *
	 * @return array
	 */
	public function getRootline() {
		if(count($this->getRootlines()) > 0) {
			return array_shift($this->getRootlines())->__toString();
		}
		
		return NULL;
	}
	
	
	
	/* Magic methods */
	
	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getTitle();
	}
}
?>