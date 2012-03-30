
<?php if($questions){ ?>
		<div class="right cols2">
<?php 	echo '<div id="property_search_results">
		        	<h1 class="property_search_results_top">'.$jukeboxCount.' Questions Found <span class="right"></span> </h1>
		            ';
		foreach($questions as $question){
			$userdetails = UserApi::getUserProfileDetails($question->user_id);
			$answers = count(JukeboxAnswersApi::getJukeboxAnswers($question->id));
				?> 
			
			<div class="post jukebox" style="cursor:pointer;" onClick="location.href='<?php echo Yii::app()->createAbsoluteUrl('/jukebox/'.$question->id); ?>'">
                    <div>
                    	<h1><?php echo $question->question ?></h1>
                        <p><?php echo $question->description ?></p>
		                <div class="left bedrooms width_auto">Posted in <span><?php echo $question->category->category ?></span> at <span><?php echo date("d M, Y H:i:s",strtotime($question->created_time)) ?></span></div>     
		                <div class="right btn_answer">
			<?php if($answers)
				echo '<a href="/jukebox/'. $question->id .'" class="btn-answer-now"></a>';
			else
				echo '<a href="#" class="btn-first-to-answer"></a>';
			echo ' </div>
		                <div class="right answer_count"><h3>Answers : '.$answers.'</h3></div>
                   </div>
                    <br class="clear" />
                </div></a>';
		}
		echo ' 
        	</div>
    	</div>';
	}
	else{
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
		echo '<div style="padding-top:20px; font-size:24px" align="center"><b class="red">Oops...!</b></div>';
		echo '<div style="padding-top:10px" align="center"><b class="red">Result not found.</b></div>';
		echo '<div style="padding-top:8px" align="center"><b class="red">You can <a href="/jukebox/post"><b style="color:#035BA9;">create a question instead.</b></a></div>';		
	}
?>
<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#property_search_results',
    'itemSelector' => 'div.jukebox',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pages,
)); ?>
