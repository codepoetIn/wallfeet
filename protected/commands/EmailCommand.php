<?php

class EmailCommand extends CConsoleCommand {

	public function actionSend($frequency=55){

		$endTime = time()+$frequency;
		// Check if a previous job has been running for the past 10 minutes.
		if(!DaemonUtils::checkForSync('EMAIL')){
			DaemonUtils::closeJobForSync('EMAIL');
			die();
		}

		$job = DaemonUtils::addJob('EMAIL');

		try{
			$count = 0;
			while(($emails = EmailQueue::model()->findAll('sent=:sent',array(':sent'=>'0'))) && !empty($emails) && time()<$endTime){
				foreach($emails as $email){
					if(time()<$endTime){
						if(!$email->sent){
							$result = EmailApi::sendSmtpEmail($email);
							if($result==1)
							$email->sent = 1;
							else
							$email->attempts++;
							$email->save();
							$count++;
						}
					} else {
						break;
					}
				}
			}
			
			/*while(!empty($emails) && time()<$endTime){
				$result = EmailApi::sendSmtpEmails($emails);
			}*/
			
			$message = "$count email(s) were processed.";
			// $message = count($emails) . " email(s) were processed.";
			DaemonUtils::endJob($job,$message);
		}catch(Exception $e){
			$message = $e->getMessage();
			DaemonUtils::endJob($job,$message,'ERROR');
		}
	}

}

?>