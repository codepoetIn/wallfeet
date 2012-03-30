<?php
class FeedbackController extends FrontController
{
	public function actionindex()
	{
		$model= new Feedback;
		if(isset($_POST['Feedback']))
		{
			
			$model->attributes=$_POST['Feedback'];
			if($model->validate())
			{
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath)
				$model->image=FeedbackImagesApi::addImage($imagePath);
				if($model->save()){
					EmailApi::sendEmail($model->email_id,"FEEDBACK.SUCCESS");
					$this->redirect('/feedback/thanks');
				}
			}
			
		}
		
		
		$feedbackTopics=new FeedbackTopic;
		$this->renderPartial('index',array(
					'model'=>$model,
					'feedbackTopics'=>$feedbackTopics,
		));
		
	}
	public function actionThanks()
	{
		$this->renderPartial('thanks');
	}
}