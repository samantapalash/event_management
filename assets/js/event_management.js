$(document).ready(function(){
    jQuery.validator.addMethod("namevalidations", function (value, element, params) {
        result = true;
        if(value != ""){
            var re = /^[A-Za-z][A-Za-z0-9 ]*(?:_[A-Za-z0-9 ]+)*$/;
            result = re.test(value);
            return result;
        }else{
            return result;
        }
    }, jQuery.validator.messages.namevalidations);
	
	$('#eventManagement').validate({
		debug:false,
		errorElement:"span",
        errorClass:"errorMsgClass",
		rules:{
			title:{
				required: true,
				namevalidations: true,
				maxlength:255
			},
			start_date:{
				required: true,
				maxlength:10
			},
			end_date:{
				required: true,
				maxlength:10
			},
			recurrence:{
				required: true,
			},
		},
		messages:{
            title:{
				required: "Please enter title.",
				namevalidations: "Please enter characters first.",
				maxlength:"You can enter maximum of 255 characters."
			},
			start_date:{
				required: "Please enter start date.",
				maxlength: "Enter date with specific format."
			},
			end_date:{
				required: "Please enter end date.",
				maxlength: "Enter date with specific format."
			},
			recurrence:{
				required: "please select one option",
			},
        },
		submitHandler: function() {
			var form_data = new FormData();
			form_data.append("title", $('#title').val());
			form_data.append("start_date", $('#start_date').val());
			form_data.append("end_date", $('#end_date').val());
			form_data.append("recurrence", $('input[name="recurrence"]:checked').val());
			form_data.append("repeat_every_id", $('#repeat_every_id').val());
			form_data.append("repeat_day_id", $('#repeat_day_id').val());
			form_data.append("repeat_on_the_count_id", $('#repeat_on_the_count_id').val());
			form_data.append("repeat_on_the_week_id", $('#repeat_on_the_week_id').val());
			form_data.append("repeat_on_the_year_id", $('#repeat_on_the_year_id').val());
			form_data.append("event_id", $('#event_id').val());
			form_data.append("add_edit", $('#add_edit').val());
			$('.submitButton').prop('disabled', true);
			$.ajax({
				type: 'POST',
				url: "addEdit/event",
				data: form_data,
				processData: false,
				contentType: false,
				beforeSend:function(){
				},
				success: function(response){
                    $('.submitButton').prop('disabled', false);
					var obj = jQuery.parseJSON(response);
					var error_success = obj.status;
					if(error_success == 'success'){
                        location.reload();
						$('#success-msg').show();
						$('#success-msg').html(obj.message);
                        var html = formHtml(obj);
                        $('#listTable tbody').html(html);
						setTimeout(function(){ 
							$('#success-msg').fadeOut();
							$('#eventManagement')[0].reset();
							$('#event_id').val('');
                            $('.submitButton').prop('disabled', false);
							$('#add_edit').val('1');
							}, 5000);
					} else {
						$('#error-msg').show();
						$('#error-msg').html(obj.message);
						setTimeout(function(){ 
							$('#error-msg').fadeOut();
							$('.submitButton').prop('disabled', false);
							}, 5000);
					}
				}
			});
		}
    });
	$('#clickToAddEvent').click(function(){
        $('#eventManagement')[0].reset();
        $('.submitButton').prop('disabled', false);
        $('#event_id').val('');
        $('#add_edit').val('1');
    });
    $(document).on('click', '.deleteButton', function(){
        var id = this.value;
        alertify.confirm('Delete!!', 'Are you sure to delete the list(s)', function(){
            $.ajax({
                  type: 'POST',
                  url: "delete/event",
                  data: {id:id},
                  success: function(response){
                    var obj = jQuery.parseJSON(response);
                    var error_success = obj.status;
                    var html = formHtml(obj);
                    if(error_success == "success") {
                        var html = formHtml(obj);
                        $('#listTable tbody').html(html);
                          alertify.success('Successfully Deleted!!');
                    } else {
                        alertify.error('Something went wrong!!');
                    }
                  }
            }); 
        }, function(){
            alertify.error('Cancel');
        });
    });
    $(document).on('click', '.viewButton', function(){
        var id = this.value;
        $.ajax({
            type: 'POST',
            url: "view/event",
            data: {id:id},
            success: function(response){
              var obj = jQuery.parseJSON(response);
              var error_success = obj.status;
              if(error_success == "success") {
                  $('#eventTitle').html(obj['all_data'][0].title);
                  $('#eventStartDate').html(obj['all_data'][0].start_date);
                  $('#eventEndDate').html(obj['all_data'][0].end_date);
              } else {
              }
            }
        }); 
    });
    $(document).on('click', '.editButton', function(){
        var id = this.value;
        $.ajax({
            type: 'POST',
            url: "view/event",
            data: {id:id},
            success: function(response){
              var obj = jQuery.parseJSON(response);
              var error_success = obj.status;
              if(error_success == "success") {
                  $('#title').val(obj['all_data'][0].title);
                  $('#start_date').val(obj['all_data'][0].start_date);
                  $('#end_date').val(obj['all_data'][0].end_date);
                  $("input[name='recurrence'][value='"+obj['all_data'][0].recurrence+"']").prop("checked",true);
                  $('#repeat_every_id option[value="'+obj['all_data'][0].repeat_every_id+'"]');
                  $('#repeat_day_id option[value="'+obj['all_data'][0].repeat_day_id+'"]');
                  $('#repeat_on_the_count_id option[value="'+obj['all_data'][0].repeat_on_the_count_id+'"]');
                  $('#repeat_on_the_week_id option[value="'+obj['all_data'][0].repeat_on_the_week_id+'"]');
                  $('#repeat_on_the_year_id option[value="'+obj['all_data'][0].repeat_on_the_year_id+'"]');
                  $('#add_edit').val('2');
                  $('#event_id').val(obj['all_data'][0].id);
              } else {
              }
            }
        }); 
    });
    function formHtml(obj){
        var html = '';
        for(var i = 0;i < obj.total_row;i++) {
            html += '<tr><td>'+parseInt(i + 1)+'</td>';
            html += '<td>'+obj['all_data'][0].title +'</td>';
            html += '<td>'+obj['all_data'][0].start_date +' - '+obj['all_data'][0].end_date+'</td>';
            html += '<td>'+'</td>';
            html += '<td>'+'<button class="viewButton" value="'+obj['all_data'][0].id+'">View</button>'+'</td>';
            html += '<td>'+'<button class="editButton" value="'+obj['all_data'][0].id+'">Edit</button>'+'</td>';
            html += '<td>'+'<button class="deleteButton" value="'+obj['all_data'][0].id+'">Delete</button>'+'</td></tr>';
        }
        return html;
    }
});