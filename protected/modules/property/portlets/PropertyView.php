<?php
class PropertyView extends CWidget
{
	public $property;
	public $propertyAddress;
	public $propertyType;
	public $propertyRating;
	public $propertyWishlist;
	public $propertyFeatures;
	public $propertyAmenities;
	public $propertyImages;
	public function run()
    {
    $this->render('propertyview',array(
   			'property'=>$this->property,
			'propertyAddress'=>$this->propertyAddress,
	  		'propertyType'=>$this->propertyType,
	  		'propertyRating'=>$this->propertyRating,
	  		'propertyWishlist'=>$this->propertyWishlist,
	  		'propertyFeatures'=>$this->propertyFeatures,
	  		'propertyAmenities'=>$this->propertyAmenities,
	  		'propertyImages'=>$this->propertyImages,
				));
    
    }

}
?>