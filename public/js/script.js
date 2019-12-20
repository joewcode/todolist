

$( document ).ready(function() {
	$('#infoBox').hide();
	
	$('#submitNewTask').click(function(e) {
		e.preventDefault();
		checkCreateTask(); 
	});
	
	
	//
    console.log('ready!');
});

function showMess(t, m) {
	let e = $('#infoBox');
	e.removeClass('alert-primary').removeClass('alert-danger');;
	e.addClass((t?'alert-primary':'alert-danger'));
	e.html(m).show();
}


function deleteTask(id) {
	if ( !confirm('Do you want to delete this task?') ) return false;
	// is not abort?
	location = '/task/delete/'+id;
	console.log('delete!');
}

function confirmTask(id) {
	if ( !confirm('Do you want to confirm this task?') ) return false;
	// is not abort?
	location = '/task/confirm/'+id;
	console.log('confirm!');
}

function checkCreateTask() {
	let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	let data = $('#newTaskForm').serializeArray();
	let obj = [];
	for (let k in data) {
		obj[data[k]['name']] = data[k]['value'];
	}
	//
	if ( obj['inputTaskName'] == '' ) {
		showMess(false, 'Name incorrect');
		return false;
	}
	if ( reg.test(obj['inputTaskMail'] ) == false) {
		showMess(false, 'Email incorrect');
		return false;
	}
	if ( obj['inputTaskText'] == '' ) {
		showMess(false, 'Text incorrect');
		return false;
	}
	$("#newTaskForm").attr('action', '/task/new').submit();
}



