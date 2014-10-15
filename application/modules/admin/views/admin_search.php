<h1>Search Queries</h1>
<div class="flashdata">
	<?php
		echo $this->session->flashdata('status_message');
	?>
</div>

<?php
	echo  form_open('/admin/search/run');
?>

<div class="action_sidebar">
    
</div>

<div id="action_form_wrapper">
    <div class="action_form">
		<p>This will allow you to run a report of all search queries made on your site for a specified time frame. You can download a tab-delimited text file of these results by date range which you can then import into Excel for use in follow-up and lead development.</p>
    
<p>For help on importing this file into Excel, please visit <a href="http://office.microsoft.com/en-us/excel-help/import-or-export-text-files-HP010099725.aspx#BMimport_data_from_a_text_file_by_openi" target="_blank">this link</a>.</p>
        <label for="start_date">Start Date</label><br />
        <input type="text" name="start_date" class="input_text" id="start_date" /><br /><br />
        
        <label for="end_date">End Date</label><br />
        <input type="text" name="end_date" class="input_text" id="end_date" /><br /><br />
		
        <input type="submit" name="action" id="run_report" rel="run_report" value="Run Report" class="" />
        
    </div>
</div>
</form>  
