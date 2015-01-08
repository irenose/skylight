<h1 class="clearfix">
    <div class="header_label">Contact Requests</div>
</h1>
<p>Your microsite will compile a database of every customer that submits a "contact us" form. You can download a tab-delimited text file of these contacts by date range which you can then import into Excel for use in follow-up and lead development.</p>
    
<p>For help on importing this file into Excel, please visit <a href="http://office.microsoft.com/en-us/excel-help/import-or-export-text-files-HP010099725.aspx#BMimport_data_from_a_text_file_by_openi" target="_blank">this link</a>.</p>
<div class="flashdata">
    <?php
        echo $this->session->flashdata('status_message');
    ?>
</div>
<?php
    echo  form_open('/installer-admin/contact/run');
?>
    <input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="start_date">Start Date</label>
            <input type="text" name="start_date" class="input_text" id="start_date" />

            <label for="end_date">End Date</label>
            <input type="text" name="end_date" class="input_text" id="end_date" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="run_report" rel="run_report" value="Generate Report" class="submit" /><a href="/installer-admin/home" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>  