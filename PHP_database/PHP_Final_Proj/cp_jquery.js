$(document).ready(function(){
	//disabling and enabling drop down
	$('#users').change(function(){
		if(this.value != ""){
			$('#coms').attr('disabled', false);
		}
		if(this.value == ""){
			$('#coms').attr('disabled', true);
			
		}
	});
	
	//populating subject drop down
	var list_target_id= 'coms';
	var list_select_id= 'users';
	
	$('#'+list_select_id).change(function(e){
			$('#com_row').hide();
			$('#com_row2').hide();
			$('#sub_head').hide();
			$('#disp_sub').hide();
			$('#view_txt').text("");	
		var selectValue=$(this).val();
		$('#' + list_target_id).html('<option value="">Loading...</option>');	
		if(selectValue ==""){
			alert("Select a username to view comments!");
		}
		else{
			$.ajax({url: 'fetch_data.php?svalue=' + selectValue,
				success: function(output){
					$('#'+list_target_id).html(output);
				},
				error: function(xhr, ajaxOptions, thrownError){
					alert(xhr.status + " " + thrownError);
				}});
		}
	});

	//displaying comments
	var disp_com='view_txt';
	
	$('#' + list_target_id).change(function(e){
		var selectValue=$(this).val();
		$('#view_txt').html("");
		if(selectValue==""){
			alert("Select a comment to view!");
		}
		$.ajax({url: 'fetch_data.php?nvalue=' + selectValue,
			success: function(output){
				$('#'+disp_com).html(output);
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status + " " + thrownError);
			}
	});

	});

	//displaying buttons
	var sub_but='sub_coms';
	var edit_but='edit';
	var del_but='delete';

	
	//hiding buttongs
	$('#' + sub_but).hide();
	$('#' + edit_but).hide();
	$('#' + del_but).hide();

	//hiding buttons when username is changed
	$('#' + list_select_id).change(function(){
		$('#' + sub_but).hide();
		$('#' + edit_but).hide();
		$('#' + del_but).hide();
	});
	
	//function to display comments button
	$('#' +list_target_id).change(function(e){
		var selectValue=$(this).val();
		
	
		$.ajax({url: 'fetch_data2.php?bvalue=' + selectValue,
		success: function(data){
			new_data=data.trim();
			if(new_data==='Comments'){
				$('#' + sub_but).show();
			}
			else{
				$('#' + sub_but).hide();
			}
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert(xhr.status + " " + thrownError);
		}
	});
	});

	//function to display delete and edit buttons
	$('#' + list_target_id).change(function(e){
		var selectValue=$('#usrnmH').val();
		var selVal=$('#coms').val();
		
	
		$.ajax({type:'POST',
		url: 'fetch_data3.php',
		data: {selectValue: selectValue, selVal: selVal}, 
		success: function(data){
			new_data=data.trim();
			if(new_data==='Owner'){
				$('#' + edit_but).show();
				$('#' + del_but).show();
			
			}
			else if(new_data==='Not Owner'){
				
				$('#' + edit_but).hide();
				$('#' + del_but).hide();
			}
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert(xhr.status + " " + thrownError);
		}
		});
	});
	//hiding textbox and button for comments
	$('#com_row').hide();
	$('#com_row2').hide();
	
	$('#' + list_target_id).change(function(){
		if($('#sub_coms').is(':visible')){
			$('#com_row').hide();
			$('#com_row2').hide();
		}
	});
			$('#sub_coms').click(function(){
				$('#com_row').show();	
				$('#com_row2').show();
			});

	//function to check if there is text in the comment box and store comments 
	$('#sub_submit').click(function(e){
		if (!$.trim($("#sub_text").val())) {
    			alert("You must enter a comment in the text box!");
		}
		else{
			var orig_id=$('#coms').val();
			var usr=$('#usrnmH').val();
			var comment=$('#sub_text').val();
		
			$.ajax({type: 'POST',
			url: 'fetch_data4.php',
			data: {orig_id: orig_id, usr: usr, comment: comment},
			success: function(data){
				new_data=data.trim();
				if(new_data==='Success'){
					alert("Your comment was successfully stored!");
					$('#com_row').hide();
					$('#com_row2').hide();
				}
				else{
					alert(data);
					alert("Oh no! There was an error storing your comment!");
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status + " " + thrownError);
			}
		});
	}	
	});
	
	$('#sub_head').hide();
	//displaying sub comments
	$('#' + list_target_id).change(function(e){
		var sub=$(this).val();
		
		$.ajax({type: 'POST',
		url: 'fetch_data5.php',
		data: {sub: sub},
		success: function(data){
			if(data!=""){
				$('#disp_sub').html(data);
				$('#sub_head').show();
				$('#disp_sub').show();
			}
			else{
				$('#sub_head').hide();
				$('#disp_sub').hide();
			}
				
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert(xhr.status + " " + thrownError);
		}
	});
	});	

	//edit comments (changing textarea and buttons
	$('#ed_sub').hide();
	$('#edit_txt').hide();
	$('#edit').click(function(){
		alert("Edit your comment in the text box!");
		$('#view_txt').removeAttr('readonly');
		$('#sub_coms').prop('disabled', true);
		$('#edit').prop('disabled', true);
		$('#delete').prop('disabled', true);
		$('#' + list_select_id).prop('disabled', true);
		$('#' + list_target_id).prop('disabled', true);
		$('#ed_sub').show();
		var com_txt=$('#view_txt').val();
		$('#view_txt').hide();
		$('#edit_txt').val(com_txt);
		$('#edit_txt').show();
	});

	//edit comments (sending to database)
	$('#ed_sub').click(function(){
			var new_com=$('#edit_txt').val();
			var sub=$('#'+list_target_id).val();
			
			$.ajax({type: 'POST',
			url: 'fetch_data6.php',
			data: {new_com: new_com, sub: sub},
			success: function(data){
					$('#view_txt').html(data);
					$('#edit_txt').hide();
					$('#view_txt').show();
					$('#view_txt').attr('readonly', true);
					alert("Your comment was saved successfully!");
					$('#ed_sub').hide();
					$('#sub_coms').prop('disabled', false);
					$('#edit').prop('disabled', false);
					$('#delete').prop('disabled', false);
					$('#' + list_select_id).prop('disabled', false);
					$('#' + list_target_id).prop('disabled', false);
			},
			error: function(xhr, ajaxOptions, thrownError){
				alert(xhr.status + " " + thrownError);
			}
			});
		
	});

	//deleting comments
	$('#delete').click(function(){
		var sub=$('#'+list_target_id).val();

		$.ajax({type: 'POST',
		url: 'fetch_data7.php',
		data: {sub: sub},
		success: function(data){
			if(data==="Success"){
				alert("Your comment was deleted successfully.");
				location.reload();
			}
			else{
				alert("We could not delete your comment.");
			}
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert(xhr.status + " " + thrownError);
		}
	});
	});
		
		

	
	
	
});
