<!--?q1=<?php echo $question1;?>&q2=<?php echo $question2; ?>&q3=<?php echo $question3; ?>&q4=<?php echo $question4; ?>&q5=<?php echo $question5; ?>&q6=<?php #echo $question6; ?>&q7=<?php echo $question7; ?>&q8=<?php echo $question8; ?>&q9=<?php echo $question9; ?>&q10=<?php echo $question10; ?>-->


<?= '1'.'.'.' '.$dq1; ?>
						</li>
						<li><input class="w3-input" type="text" name="question2" value="<?= '2'.'.'.' '.$dq2; ?>"></li>
						<li><input class="w3-input" type="text" name="question3" value="<?= '3'.'.'.' '.$dq3; ?>"></li>
						

						<?php

							if (empty($dq4)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question4" value="<?= '4'.'.'.' '.$dq4; ?>"></li>

								<?php
							}


							if (empty($dq5)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question5" value="<?= '5'.'.'.' '.$dq5; ?>"></li>

								<?php
							}


							if (empty($dq6)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question6" value="<?= '6'.'.'.' '.$dq6; ?>"></li>

								<?php
							}


							if (empty($dq7)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question7" value="<?= '7'.'.'.' '.$dq7; ?>"></li>

								<?php
							}



							if (empty($dq8)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question8" value="<?= '8'.'.'.' '.$dq8; ?>"></li>

								<?php
							}


							if (empty($dq9)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question9" value="<?= '9'.'.'.' '.$dq9; ?>"></li>
								<?php
							}


							if (empty($dq10)) {

								?>


								<?php

							}else {

								?>
								<li><input class="w3-input" type="text" name="question10" value="<?= '10'.'.'.' '.$dq10; ?>"></li>

								<?php
							}
							
						?>
					
					</ul>
				

		    		
			    	<div class=" w3-padding w3-large">
			    		<input type="submit" name="submit" value="Post" class="w3-button w3-teal w3-padding">

			    	</div>

					</form>



<button>View List</button>
<div class="viewItem" style="display:none;">
	<?php
	echo "<h4>Your lists:</h4>";
	echo $item_1;
	echo "<br>";
	echo $item_2;
	?>
</div>
<script type="text/javascript">
	const view = document.querySelector('.viewItem');
	const btn = document.querySelector('button');
	btn.addEventListener('click', () => view.style.display = 'block')
</script>