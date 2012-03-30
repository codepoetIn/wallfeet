<?php

class PropertyTransactionTypesApi {
	
	/**
	 * This method accepts transaction type and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $transactionType
	 * @return model || model with errors
	 */
	public static function create($transactionType) {
		$property_transactionTypes = new PropertyTransactionTypes ();
		$property_transactionTypes->transaction_type = $transactionType;
		$property_transactionTypes->save ();
		return $property_transactionTypes;
	
	}
	
	/**
	 * This method accepts transactiontype id and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $transactionTypeId
	 * @return true || false
	 */
	public static function delete($transactionTypeId) {
		return PropertyTransactionTypes::model ()->deleteAll ( ('id=:transaction_type_Id'), array (':transaction_type_Id' => $transactionTypeId ) );
	
	}
	
	/**
	 * This method accepts a transactionType id and transactionType and updates the model. 
	 * Returns true if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the question id is not found.
	 * 
	 * @param string $transactionTypeId
	 * @param string $transactionType
	 * @return model||model with errors
	 */
	public static function update($transactionTypeId, $transactionType) {
		$property_transactionTypes = PropertyTransactionTypes::model()->find ( 'id=:transaction_type_Id', array (':transaction_type_Id' => $transactionTypeId ) );
		if ($property_transactionTypes) {
			$property_transactionTypes->transaction_type = $transactionType;
			$property_transactionTypes->save();
			return $property_transactionTypes;
		
		} else {
			return false;
		}
	}
	public static function getTransactionTypeById($TransactionTypeId) 
	{
		$transactionType = PropertyTransactionTypes::model()->findByPk ($TransactionTypeId);
		if ($transactionType) 
		{
			return $transactionType->transaction_type;
		} else
			return false;
	}
	/**
	 * This method returns all the property transaction types.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getAll() {
		$property_transactionTypes = PropertyTransactionTypes::model ()->findAll ();
		if ($property_transactionTypes)
			return $property_transactionTypes;
		else
			return false;
	}

}

?>