<html>
    <head>
        <link href="<?=base_url();?>assets/alertifyjs/css/alertify.min.css" rel="stylesheet">
    </head>
    <body>
        <table id="TABLE1" language="javascript"  >
		<tr>
	<td colspan="2">
		<strong><button id="clickToAddEvent">Add Event Page</button></strong>
	</td>
</tr>
		<form id="eventManagement" class="eventManagement">
        <tr>
            <td>
                Event Title:
            </td>
            <td>
                <input name="title" id="title"/>
            </td>
        </tr>
            <tr>
                <td>
                    Start Date:   
                </td>
                <td>
                    <input name="start_date" id="start_date"/>
                </td>
            </tr>
            <tr>
                <td>
                    End Date:
                </td>
                <td>
                    <input name="end_date" id="end_date"/>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                   
                </td>
            </tr>
            <tr>
                <td>Recurrence: 
                </td>
                <td>
                    <input id="" name="recurrence" tabindex="9" type="radio" value="1" /><label
                        for="repeat"><span style="font-size: 10pt; font-family: Verdana">Repeat</span></label>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <select id="repeat_every_id" class="textbox-medium"
                        name="repeat_every_id" style="font-size: x-small; width: 100px; font-family: Verdana"
                        tabindex="10">
                        <?if(isset($all_repeat_every['total_row']) && !empty($all_repeat_every['total_row'])) {?>
                            <?for($i = 0;$i < $all_repeat_every['total_row'];$i++) {?>
                                <option value="<?if(isset($all_repeat_every[$i]['id']) && !empty($all_repeat_every[$i]['id'])) {
                                    echo $all_repeat_every[$i]['id'];}?>"><?if(isset($all_repeat_every[$i]['name']) && !empty($all_repeat_every[$i]['name'])) {
                                        echo $all_repeat_every[$i]['name'];}?></option>
                            <? } ?>
                        <? } ?>
                    </select>
                    <select id="repeat_day_id" class="textbox-medium" name="repeat_day_id" style="font-size: x-small;
                        width: 66px; font-family: Verdana" tabindex="10">
                        <?if(isset($all_repeat_every_day['total_row']) && !empty($all_repeat_every_day['total_row'])) {?>
                            <?for($i = 0;$i < $all_repeat_every_day['total_row'];$i++) {?>
                                <option value="<?if(isset($all_repeat_every_day[$i]['id']) && !empty($all_repeat_every_day[$i]['id'])) {
                                    echo $all_repeat_every_day[$i]['id'];}?>"><?if(isset($all_repeat_every_day[$i]['name']) &&
                                     !empty($all_repeat_every_day[$i]['name'])) {
                                        echo $all_repeat_every_day[$i]['name'];}?></option>
                            <? } ?>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                
                </td>
                <td>
                <INPUT id="" tabIndex=11 type=radio value="2" 
name="recurrence" /><span style="font-size: 10pt; font-family: Verdana">Repeat on the
    <select id="repeat_on_the_count_id" class="textbox-middle" name="repeat_on_the_count_id" style="font-size: x-small;
        width: 68px; font-family: Verdana" tabindex="12">
        <?if(isset($all_repeat_on_the_count['total_row']) && !empty($all_repeat_on_the_count['total_row'])) {?>
            <?for($i = 0;$i < $all_repeat_on_the_count['total_row'];$i++) {?>
                <option value="<?if(isset($all_repeat_on_the_count[$i]['id']) && !empty($all_repeat_on_the_count[$i]['id'])) {
                    echo $all_repeat_on_the_count[$i]['id'];}?>"><?if(isset($all_repeat_on_the_count[$i]['name']) &&
                        !empty($all_repeat_on_the_count[$i]['name'])) {
                        echo $all_repeat_on_the_count[$i]['name'];}?></option>
            <? } ?>
        <? } ?>
    </select>
</span>&nbsp;
<select id="repeat_on_the_week_id" class="textbox-middle" name="repeat_on_the_week_id"
    style="font-size: x-small; width: 56px; font-family: Verdana" tabindex="13">
    <?if(isset($all_repeat_on_the_week['total_row']) && !empty($all_repeat_on_the_week['total_row'])) {?>
        <?for($i = 0;$i < $all_repeat_on_the_week['total_row'];$i++) {?>
            <option value="<?if(isset($all_repeat_on_the_week[$i]['id']) && !empty($all_repeat_on_the_week[$i]['id'])) {
                echo $all_repeat_on_the_week[$i]['id'];}?>"><?if(isset($all_repeat_on_the_week[$i]['name']) &&
                    !empty($all_repeat_on_the_week[$i]['name'])) {
                    echo $all_repeat_on_the_week[$i]['name'];}?></option>
        <? } ?>
    <? } ?>
</select>
                    of the
                    <select id="repeat_on_the_year_id" class="textbox-middle" language="javascript" name="repeat_on_the_year_id"
                        style="font-size: x-small; width: 80px;
                        font-family: Verdana" tabindex="14">
                        <?if(isset($all_repeat_on_the_year['total_row']) && !empty($all_repeat_on_the_year['total_row'])) {?>
                            <?for($i = 0;$i < $all_repeat_on_the_year['total_row'];$i++) {?>
                                <option value="<?if(isset($all_repeat_on_the_year[$i]['id']) && !empty($all_repeat_on_the_year[$i]['id'])) {
                                    echo $all_repeat_on_the_year[$i]['id'];}?>"><?if(isset($all_repeat_on_the_year[$i]['name']) &&
                                        !empty($all_repeat_on_the_year[$i]['name'])) {
                                        echo $all_repeat_on_the_year[$i]['name'];}?></option>
                            <? } ?>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                   
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <input type="hidden" id="event_id"  value="" />
                <input type="hidden" id="add_edit"  value="1" />
                <td><input type="submit" value="Submit" class="submitButton">                   
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                   
                </td>
            </tr>
        </form>
        <div id="success-error-messege">
            <div id="success-msg" style="display:none"></div>
            <div id="error-msg" style="display:none"></div>
        </div>
			<tr>
	<td colspan=2>
		<hr>
	</td>
</tr>
<tr>
	<td colspan="2">
		<strong>Event List Page</strong>
	</td>
</tr>
<tr>
	<td colspan="2">
		<table id="listTable">
		<thead>
			<td width="20">
				<strong>#</strong>
			</td>
			<td width="150">
				<strong>Title</strong>
			</td>
			<td width="250">
				<strong>Dates</strong>
			</td>
			<td width="250">
				<strong>Occurrence</strong>
			</td>
			<td width="200">
				<strong>Actions</strong>
			</td>
		</thead>
        <tbody>
            <?if(isset($all_data['total_row']) && !empty($all_data['total_row'])) {?>
                <?for($i = 0;$i < $all_data['total_row'];$i++) {?>
                    <tr>
                        <td>
                            <?=($i+1);?>
                        </td>
                        <td>
                            <?if(isset($all_data[$i]['title']) && !empty($all_data[$i]['title'])){echo $all_data[$i]['title'];}?>
                        </td>
                        <td>
                        <?if(isset($all_data[$i]['start_date']) && !empty($all_data[$i]['start_date'])){echo $all_data[$i]['start_date'];}?>
                            - <?if(isset($all_data[$i]['end_date']) && !empty($all_data[$i]['end_date'])){echo $all_data[$i]['end_date'];}?>
                        </td>
                        <td>
                            <?if(isset($all_data[$i]['recurrence']) && !empty($all_data[$i]['recurrence']) && ($all_data[$i]['recurrence'] == 1)){ ?>
                                <? echo $all_data[$i]['repeat_every_id']." ".$all_data[$i]['repeat_day_id']; ?>
                            <? } ?>
                            <?if(isset($all_data[$i]['recurrence']) && !empty($all_data[$i]['recurrence']) && ($all_data[$i]['recurrence'] == 2)){ ?>
                                <? echo $all_data[$i]['repeat_on_the_count_id']." ".$all_data[$i]['repeat_on_the_week_id']." ".$all_data[$i]['repeat_on_the_year_id']; ?>
                            <? } ?>
                        </td>
                        <td>
                            <button class="viewButton" value="<?if(isset($all_data[$i]['id']) && !empty($all_data[$i]['id'])){echo $all_data[$i]['id'];}?>">View</button>
                            <button class="editButton" value="<?if(isset($all_data[$i]['id']) && !empty($all_data[$i]['id'])){echo $all_data[$i]['id'];}?>">Edit</button>
                            <button class="deleteButton" value="<?if(isset($all_data[$i]['id']) && !empty($all_data[$i]['id'])){echo $all_data[$i]['id'];}?>">Delete</button>
                        </td>
                    </tr>
                <? } ?>
            <? } ?>
        <tbody>
		</table>
	</td>
</tr>
<tr>
	<td colspan=2>
		<hr>
	</td>
</tr>
<tr>
	<td colspan="2">
		<strong>Event View Page</strong>
	</td>
</tr>
			<tr>
                <td>
                    <span id="eventTitle"></span>
                </td>
			</tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <table border=1>
                        <tr>
                            <td>
                                Start Date
                            </td>
                            <td style="width: 100px">
                                <span id="eventStartDate"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                End Date
                            </td>
                            <td style="width: 100px">
                                <span id="eventEndDate"></span>
                            </td>
                        </tr>
                    </table>
                    </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                   Total Recurrence Event: <?if(isset($all_data['total_row']) && !empty($all_data['total_row'])) {echo $all_data['total_row'];}?>
                </td>
            </tr>
        </table>
        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.validate.js"></script>
        <script src="<?=base_url();?>assets/alertifyjs/alertify.min.js"></script>
        <script src="<?=base_url();?>assets/alertifyjs/alertify.js"></script>
        <script src="<?=base_url();?>assets/js/event_management.js"></script>
    </body>
</html>