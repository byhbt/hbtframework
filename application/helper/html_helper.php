<?php
/**
 * Generates Date Combobox
 *
 * @param	int	$selected	default value for combo box
 * @return	string			html content for echo out
 */
function displayDateCmb($selected = null) {
	for($i = 1; $i < 32; $i++) {
		if(isset($selected) && $i == $selected) {
			echo '<option selected value='.$i.'>'.$i.'</option>';
		} else {
			echo '<option value='.$i.'>'.$i.'</option>';
		}
	}
}


/**
 * Generates Year Combobox
 *
 * @param	int	$selected	default value for combo box
 * @return	string			html content for echo out
 */
function displayYearCmb($min, $max, $selected = null) {
	$years = range($max, $min);

	foreach ($years as $year) {
		if(isset($selected) && $year == $selected) {
			echo '<option selected value="'.$year.'">'.$year.'</option>\n';
		} else {
			echo '<option value="'.$year.'">'.$year.'</option>\n';
		}
	}
}

/**
 * Generates Month Combobox
 *
 * @param	int	$selected	default value for combo box
 * @return	string			html content for echo out
 */
function displayMonthCmb($selected = null) {
	//<option title="January" value="1">January</option>
	$months = array ('January', 'February', 'March', 'April', 'May', 'June', 'July',
			         'August', 'September', 'October', 'November', 'December');

	$i = 1;
	foreach($months as $month) {
		if(isset($selected) && $i == $selected) {
			echo "<option selected title='".$month."' value=".$i.">".$month."</option>";
		} else {
			echo "<option title='".$month."' value=".$i.">".$month."</option>";
		}

		$i++;
	}
}

/**
 * Generates html string for display error message
 *
 * @param	array	$errors Array of errors
 * @return	string			html content for echo out
 */
function displayError($errors)
{
	if(!empty($errors)) {
		if(is_array($errors)) {
			foreach ($errors as $key => $value) {
				echo '<div class="notice error"><i class="icon-remove-sign icon-large"></i> '. $value.'</div>';
			}
		} else {
			echo '<div class="notice error"><i class="icon-remove-sign icon-large"></i> '. $errors .'</div>';
		}

	}

	return;
}

/**
 * Generates html string for display information message
 *
 * @param	string	$msg	message for echo out
 * @return	string			html content for echo out
 */
function displayMessage($msg) {
	return '';
}