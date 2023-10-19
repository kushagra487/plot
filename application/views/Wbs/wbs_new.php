<table id="datatable-keytable_wrapper" class="table2 table-bordered nowrap" cellspacing="0" width="100%">
<thead>
<tr>
    <th>
    <textarea name="col[]" cols="30" rows="1">Mega Process (L1)</textarea><img src="http://localhost/plot/images/add-icon.png" id="show-hide1" class="icon">
    </th>
    <th>
    <textarea name="col[]" cols="10" rows="1">Process</textarea>
    </th>
    <th>
    <textarea name="col[]" cols="10" rows="1">Activity</textarea>
    </th>
	<th>
    <textarea name="col[]" cols="10" rows="1">Planned Quantity </textarea>
    </th>
	<th>
    <textarea name="col[]" cols="10" rows="1">Actual Quantity</textarea>
    </th>
    <th>
    <textarea name="col[]" cols="10" rows="1">Responsibility</textarea>
    </th>
    <th>
    	Start Date
    </th>
    <th>
    	Finish Date
    </th>
    <th>
    <textarea name="col[]" cols="10" rows="1">Resources</textarea>
    </th>
    <th>
    <textarea name="col[]" cols="10" rows="1">Department</textarea>
    <img class="icon1" id="show-hide11" src="<?php echo base_url();?>images/add-icon.png" />
    </th>
</tr>
</thead>
<tbody>
<tr id="firstrow">
    <td><textarea name="megaprocess[]"  cols="10" rows="1"></textarea>
    <img class="icono" src="<?php echo base_url();?>images/add-icon.png" alt=""/>
    </td>
    <td class="column1"><textarea name="activity1[]"  cols="10" rows="1"></textarea></td>
    <td><textarea name="process[]"  cols="10" rows="1"></textarea></td>
    <td><textarea name="activity[]"  cols="10" rows="1"></textarea></td>
    <td><select class="form-control" tabindex="-1" name="responsibilities[]">
    <option value="">Select </option>  
    <?php
    foreach($tm_details as $key => $value){
    ?>
    <option value="<?php echo $value['tm_list']; ?>"><?php echo $value['tm_list']; ?></option>
    <?php
    }
    ?>
    </select>
    </td>
    <td>
    <fieldset>
    <div class="control-group">
    <div class="controls">
    <input type="text"  name="start_date[]" class="form-control single_cal1" id="single_cal2" placeholder="" aria-describedby="inputSuccess2Status" readonly>
    <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
    </div>
    </fieldset>
    </td>
    <td>
    <fieldset>
    <div class="control-group">
    <div class="controls">
    <input type="text" name="end_date[]" class="form-control single_cal1" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status" readonly>
    <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
    </div>
    </fieldset>
    </td>
    <td><textarea name="resource[]"  cols="10" rows="1"></textarea></td>
    <td><textarea  name="department[]"  cols="10" rows="1"></textarea></td>
</tr>
</tbody>
</table>