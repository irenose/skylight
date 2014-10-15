<h1>Downloads</h1>
<div class="flashdata">
	<?php
		echo $this->session->flashdata('status_message');
	?>
</div>


<div class="action_sidebar">
    
</div>

<div id="action_form_wrapper">
    <div class="action_form" style="width:700px;">
       
        <p>This will allow you to run a report of all downloads made on the media room for a specified time frame. Alternatively, you can run a report based on a particular user by inputting their last name or email into the search box. You can then download a tab-delimited text file of these results which you can then import into Excel.</p>
        
        <p>For help on importing this file into Excel, please visit <a href="http://office.microsoft.com/en-us/excel-help/import-or-export-text-files-HP010099725.aspx#BMimport_data_from_a_text_file_by_openi" target="_blank">this link</a>.</p>
        
        <div style="float:left;width:350px;">
			<?php
                echo  form_open('/admin/downloads/date');
            ?>

            
            <label for="start_date">Start Date</label>
            <input type="text" name="start_date" class="input_text" id="start_date" style="width:250px;" /><br /><br />
            
            <label for="end_date">End Date</label>
            <input type="text" name="end_date" class="input_text" id="end_date" style="width:250px;" />
            <div class="form_clear" style="height:5px;"> </div>
            <input type="submit" class="blue_button submit" value="Run Download Report" />
            </form>  
        </div>
        
        <div style="float:left;">
			<?php
                echo  form_open('/admin/downloads/user');
            ?>
            <label for="member">User Last Name or E-mail</label>
            <input type="text" name="user" class="input_text" id="user" style="width:250px;" />
            <div class="form_clear" style="height:5px;"> </div>
            <input type="submit" class="blue_button submit user_downloads" value="Search for User" />
            </form> 
            
            <div id="ajax_container" class="ajax_search_results">
        
        	</div> 
        </div>
        
    </div>
</div>	
