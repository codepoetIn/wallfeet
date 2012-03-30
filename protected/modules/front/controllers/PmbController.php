<?php

class PmbController extends FrontController
{
	public function actionIndex()
	{

		Yii::beginProfile('messages');

		$total=0;
		$criteria = PmbApi::getInboxCriteria(Yii::app()->user->id);
		$total = PmbMessages::model()->count($criteria);

		$pages = new CPagination($total);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$messages = PmbMessages::model()->findAll($criteria);

		//$messages = PmbApi::getInbox(Yii::app()->user->id);

		$unread = PmbApi::getUnreadInboxCount(Yii::app()->user->id);
		$this->render('index',array('messages'=>$messages,'unread'=>$unread,'pages'=> $pages));

		Yii::endProfile('messages');
	}


	public function actionReply($userId)
	{
		Yii::beginProfile('messageReply');
		$pmbMessage=new PmbMessages;
		$user = UserApi::getUser($userId);
		if(!$user){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$pmbMessage->to_user_id = $userId;
		$pmbMessage->from_user_id = Yii::app()->user->id;
		$userName = UserApi::getNameByUserId($userId);
		if(isset($_POST['submit']))	{
			$pmbMessage->attributes=$_POST['PmbMessages'];
			if($pmbMessage->save()){
				$data = array();
				$user = UserApi::getUserById($pmbMessage->to_user_id);
				$user ? $data["user"] = $user->id : null;
				$data["message"] = $pmbMessage->id;
				EmailApi::sendEmail($user->email_id,"ACTIVITY.MESSAGE.NEW",$data);
				$this->redirect('/messages/sent');
			}
		}
		$this->render('reply',array('pmbMessage'=>$pmbMessage,'user'=>$user,'userName'=>$userName));

		Yii::endProfile('messageReply');

	}


	public function actionSent()
	{
		Yii::beginProfile('messages_sent');

		$total=0;
		$criteria = PmbApi::getSentCriteria(Yii::app()->user->id);
		$total = PmbApi::getSentItems(Yii::app()->user->id);
		if($total)
		$total=count($total);
		$pages = new CPagination($total);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$messages = PmbMessages::model()->findAll($criteria);

		//$messages = PmbApi::getInbox(Yii::app()->user->id);

		$unread = PmbApi::getUnreadInboxCount(Yii::app()->user->id);
		$this->render('sent',array('messages'=>$messages,'unread'=>$unread,'pages'=> $pages));

		Yii::endProfile('messages_sent');
	}

	public function actionView($id){

		Yii::beginProfile('message_view');

		$message = PmbApi::getMessageById($id);
		if(!$message){
			throw new CHttpException(404,'The requested page does not exist.');
		}

		if($message->from_user_id!=Yii::app()->user->id && $message->to_user_id!=Yii::app()->user->id){
			$this->redirect('/messages');
		}
		$read = PmbApi::markRead(array($id));
		$unread = PmbApi::getUnreadInboxCount(Yii::app()->user->id);
		$this->render('view',array('message'=>$message,'unread'=>$unread,'id'=>$id));

		Yii::endProfile('message_view');
	}
}