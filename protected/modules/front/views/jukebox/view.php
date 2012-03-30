<div id="property_search">
      <h1 class="heading">Question & Answer<span></span></h1>
      <div class="inner-column">
      <?php $this->widget('JukeboxSearchCriteria',array('modelJukeboxQuestions'=>$modelJukeboxQuestions)); ?>
        <div class="right cols2">
       	<?php
		$owner = $jukeboxQuestion->user_id==Yii::app()->user->id;
		if($owner) { ?>
		<div style="float:right;padding-right:5px">
		<?php echo CHtml::link(
		    'Delete Question',
		     array('/jukebox/delete','id'=>$jukeboxQuestion->id),
		     array('confirm' => 'Are you sure you want to remove this question ?','class'=>'red-txt right')
		 );
		}
		?>	
        
          <div class="search-jukebox-answer-part">
            <h2 class="question">Questions</h2>
            <div class="search-jukebox-answer">
            <div class="search-juckebox-question-rating">
           		<div class="left question-description"> 
              <h3><?php echo $jukeboxQuestion->question?></h3> 
              <p class="space"><?php echo $jukeboxQuestion->description?></p>
              </div>
              <div class="right">
              <?php if((Yii::app()->user->checkAccess('front-jukeboxRating'))&&($jukeboxQuestion->id)) 
              { 
              	$url= 'front/jukebox/starRatingAjax/userid/'.Yii::app()->user->id.'/question_id/'.$jukeboxQuestion->id;
                $this->widget('StarRating',array('rating'=>$jukeboxRating,'url'=>$url,'ratingReadOnly'=>$juckboxRatingReadOnly)); 
			  }?>
					
              </div>
              </div>
               <?php 
               if(isset($geocity))
              		 $city=$geoCity->city;
               else
               		$city='';
                if($userProfile)
                {
              echo '<div class="posted-part">
                <div class="left">
               
                  <h5>Posted By <span>'.$userProfile->first_name.','.$city.'.</span></h5>
                
                </div>
                <div class="right">
                  <a href="#answer"><input type="image" src="'.Yii::app()->theme->baseUrl.'/images/answer-now.png" alt="" /></a>
                </div>
             	 </div>';
              ?>
           		 </div>
        		  </div><?php
            
				          if($jukeboxAnswers)
				          {
					          foreach ($jukeboxAnswers as $i=>$answers)
					          {
					          	$correctUndo='';
					          	$wrongUndo='';
					          	$correctText='display:none';
					          	$wrongText='display:none';
					          	$imgcorrect='<img src="'.Yii::app()->theme->baseUrl.'/images/icon-success.png" alt="" class="left correctimg'.$i.'" />';
					          	$imgWrong='<img src="'.Yii::app()->theme->baseUrl.'/images/deletered.png" alt="" class="left wrongimg'.$i.'" />';
					          	$answerCorrectCount=JukeboxAnswersApi::getCorrectAnswerCount($answers->id);
					          	$answerWrongCount=JukeboxAnswersApi::getWrongAnswerCount($answers->id);
						         $userAnswers=JukeboxAnswersApi::userCorrectAnswers($answers->id);
						         if($userAnswers && $userAnswers->status==1)
							         {
							         $correctUndo=CHtml::link(' undo',array('/jukebox/'.$jukeboxQuestion->id.'?attributeidC='.$userAnswers->id.''),array('class'=>'red'));
							         $imgWrong='';
							         $correctText='display:block';
							         }
						         else if($userAnswers && $userAnswers->status==0)
							         {
							         	$wrongUndo=CHtml::link(' undo',array('/jukebox/'.$jukeboxQuestion->id.'?attributeidW='.$userAnswers->id.''),array('class'=>'red'));
							         	$imgcorrect='';
							         	$wrongText='display:block';
							         }
					          echo '<div class="search-jukebox-answer-part">
					            <h2 class="question">Answer '.($i+1).'</h2>
					            <div class="search-jukebox-answer">
					              <p>'.$answers->answer.'</p>
					              <div class="posted-part">
					                <div class="left">
					                  <h5>Posted By <span>'.$userdata[$answers->user_id].'</span>  at <span>'.date("d M,Y H:i:s",strtotime($answers->created_time)).'</span></h5>
					                </div>
					                <div class="right tick-answer-part">
     								<div class="left tick-answer green-bg">';
					          		echo CHtml::ajaxLink($imgcorrect,array('Jukebox/AnswerCorrectRating/answerid/'.$answers->id.'/questionId/'.$jukeboxQuestion->id.''),array('update'=>'#correct'.$i.''),array('onclick'=>'$(".wrongimg'.$i.'").hide();$(".correct'.$i.'").show();'));
   									 echo '<span class="green left" id="correct'.$i.'">'.$answerCorrectCount.''.$correctUndo.'</span></div>
    								 <div class="left tick-answer red-bg" id="target">';
    								 echo CHtml::ajaxLink($imgWrong,array('Jukebox/AnswerWrongRating/answerid/'.$answers->id.'/questionId/'.$jukeboxQuestion->id.''),array('update'=>'#wrong'.$i.''),array('onclick'=>'$(".correctimg'.$i.'").hide();'));
    								 echo '<span class="red left" id="wrong'.$i.'">'.$answerWrongCount.''.$wrongUndo.'</span></div><br>
    								 <div class="correct'.$i.'" style="'.$correctText.'">Voted  as Correct</div>
    								 <div class="wrong'.$i.'" style="'.$wrongText.'">Voted  as wrong</div>
 										</div>
 										
					               </div>
					            </div>
					          </div>';
   									 
					           }
					          
				           }
				           else
				           echo "No Answers";
           
			            $form=$this->beginWidget('CActiveForm', array(
						'enableAjaxValidation'=>false,
			             'action'=>'',
						'htmlOptions'=>array('name'=>'jukebox'),
						)); ?> 
			          <a name="answer"></a>
			          <div class="search-jukebox-answer-part">
			            <h2 class="youranswer">Your Answer</h2>
			            <div class="search-jukebox-answer">
			            <?php echo $form->textArea($jukeboxNewAnswers,'answer',array('class'=>'answer-textarea'))?>
			             
			              <?php echo $form->textField($jukeboxNewAnswers,'reference_url',array("onfocus"=>"if(this.value =='Reference URL (optional)' ) this.value=''","onblur"=>"if(this.value=='') this.value='Reference URL (optional)'","value"=>"Reference URL (optional)","class"=>"answer-ref_mail") )?>
			             
			              <div class="answer-checkbox-part">
			              <div align="center">
			                <input type="submit" value="" alt="" class="submit-btn" name="submit" />
			                <input type="reset" value="" class="cancle-btn" alt="" />
			              </div>
			            </div>
			          </div>
			          </div>
			          
			          <?php $this->endWidget();
                	}
                else
                {
                	echo '</div></div>';
                }
                  ?>  
        </div>
        <br class="clear"  />
      </div>
    </div>