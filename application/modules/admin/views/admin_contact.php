<h1>Contact Requests</h1>
<div class="flashdata">
	<?php
		echo $this->session->flashdata('status_message');
	?>
</div>


<div class="action_sidebar">
    
</div>

<div id="action_form_wrapper">
    <div class="action_form">
    	<p>Your site will compile a database of every customer that submits a "contact us" form. You can download a tab-delimited text file of these contacts by date range which you can then import into Excel for use in follow-up and lead development.</p>
    
    <p>For help on importing this file into Excel, please visit <a href="http://office.microsoft.com/en-us/excel-help/import-or-export-text-files-HP010099725.aspx#BMimport_data_from_a_text_file_by_openi" target="_blank">this link</a>.</p>
    
    <?php
		echo  form_open('/admin/contact/run');
	?>
	<label for="start_date">Start Date</label>
	<input type="text" name="start_date" class="input_text" id="start_date" /><br /><br />
	
	<label for="end_date">End Date</label>
	<input type="text" name="end_date" class="input_text" id="end_date" /><br /><br />
	
	<div class="form_clear"> </div>
	<input type="submit" class="blue_button submit" value="Run Report" />
	</form>  
    
    </div>
    
</div>
