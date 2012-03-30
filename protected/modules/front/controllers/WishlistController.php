<?php

class WishlistController extends FrontController
{
	public function actionIndex(){
		Yii::beginProfile('wishlist');


		$criteria = PropertyWishlistApi::getCriteriaObjectForUser(Yii::app()->user->id);
		$count = Property::model()->count($criteria);

		$pages = new CPagination($count);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);

		$properties = PropertyWishlistApi::searchWithCriteria($criteria);

		//	$projects = ProjectWishlistApi::getWishlistProjectsByUserId(Yii::app()->user->id);
		$this->render('index',
		array('properties'=>$properties/*,'projects'=>$projects*/,
			  'count'=>$count,
			  'pages'=>$pages
		));
		Yii::endProfile('wishlist');
	}


	public function actionDelete($id){

		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		$wishlist = PropertyWishlistApi::getWishlistUserOnProperty($id,Yii::app()->user->id);

		if($wishlist) {
			if($wishlist->user_id!==Yii::app()->user->id)
			throw new CHttpException(403,'You are not authorized.');

			if(PropertyWishlist::model()->deleteByPk($wishlist->id)){
				Yii::app()->user->setFlash('success','The property was removed from your wishlist.');
			}else {
				Yii::app()->user->setFlash('error','The property could not be removed from your wishlist. Please contact the admin.');
			}
		}
		else {
			Yii::app()->user->setFlash('error','The property could not be removed from your wishlist. Please contact the admin.');
		}
		$this->redirect('/wishlists');

	}

}