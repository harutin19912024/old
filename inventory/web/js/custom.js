var url = window.location.pathname;
var spl_url = url.split("/"), controller = spl_url[1];

$(document).ready(function () {
    var $body = $('body');

    $body.on('submit', '#type-create, #vendor-create, #product-create', (function (e) {

        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: url,
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell
            success: function (res) {
                if (res.success) {
                    $('#admin-alerts div').html(res.message);
                    $('#admin-alerts').show();
                    $.pjax.reload({container: '#'+res.table_id});
                    //$.pjax.reload({container: '#brandPjaxForm'});
                }
            }
        });
    }));
});


var product_language;
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}

if (mm < 10) {
    mm = '0' + mm
}
var editor;
var table;
today = mm + '/' + dd + '/' + yyyy;
/* console.log(table)
 setInterval( function () {
 table.ajax.reload();
 }, 60000 ); */


function showUserPopUp(trainingId) {
    $('#share-to-client').modal('show');
}

function openSharePopup(training_id) {
    $.ajax({
        method: 'post',
        data: {training_id: training_id},
        url: '/' + language + '/site/open-share',
        success: function (res) {
            var obj = JSON.parse(res);
            if (obj['success']) {
                $('#share-to-client').html(obj['html']);
				$('#usertraining-user_id').select2();
                $('#share-to-client').modal('show');
            }
        }
    });
}

function shareToUsers() {
    var users = $('#usertraining-user_id').val();
    var training_id = $('#usertraining-training_id').val();
    $.ajax({
        method: 'post',
        data: {training_id: training_id, users: users},
        url: '/' + language + '/site/send-invitation',
        success: function (res) {
            var obj = JSON.parse(res);
			console.log(obj)
            if (obj['success']) {
                $('#show-invitation-url').modal('hide');
                $('#share-to-client').modal('hide');
                $('#admin-alerts div').html('Email was sent successfully');
                $('#admin-alerts').show();
            } else {
				$('#show-invitation-url').modal('hide');
                $('#share-to-client').modal('hide');
                $('#admin-error div').html(obj['message']);
                $('#admin-error').show();
			}
        }
    });
    return false;
}

function showInvitationPopup(clientId) {
    $.ajax({
        method: 'post',
        data: {clientId: clientId},
        url: '/' + language + '/site/show-invitation-popup',
        success: function (res) {
            var obj = JSON.parse(res);
            $('#show-invitation-url').html(obj['html']);
            $('#usertraining-user_id').val(clientId);
			$('#usertraining-training_id').select2();
            $('#show-invitation-url').modal('show');
        }
    });
}

function showUrl(element) {
    var clientId = $('#usertraining-user_id').val();
    var trainingId = $(element).val();
    $.ajax({
        method: 'post',
        data: {clientId: clientId, trainingId: trainingId},
        url: '/' + language + '/site/get-invitation-url',
        success: function (res) {
            var obj = JSON.parse(res);
            $('#invitatio-url').val(obj['url']);
            $('#invitatio-url-content').show();
        }
    });
}

function saveRemainedTime(trainingId) {
    var timer = $('#timer-countdown').text();
    $.ajax({
        method: 'post',
        data: {trainingId: trainingId,timer:timer},
        url: '/' + language + '/clients/update-time',
        success: function (res) {
            
        }
    });
}

function showMyImage(fileInput, W, isProductImage) {
    var files = fileInput.files;
    var selDiv_id = 'selectedFiles_' + W;
    var rb = document.getElementById('def_img_part_' + W);
    var selDiv = document.getElementById(selDiv_id);
    var filesArr = Array.prototype.slice.call(files);
    var label = fileInput.nextElementSibling;
    var s = '';
    var fileName = '';
    selDiv.innerHTML = '';
    rb.checked = false;
    if (W == '-1') {
	  s = 1;
    }
    if (filesArr && filesArr.length > 1) {
	  fileName = (fileInput.getAttribute('data-multiple-caption') || '').replace('{count}', filesArr.length);
    } else if (filesArr.length == 1) {
	  fileName = filesArr[0].name;
    } else {
	  fileName = ''
    }
    if (fileName != '') {
	  fileName = '<i class="glyphicon glyphicon-file"></i>' + fileName;
	  label.querySelector('span').innerHTML = fileName;
    } else {
	  label.querySelector('span').innerHTML = '';
    }

    filesArr.forEach(function (f, i) {
	  if (!f.type.match("image.*")) {
		return;
	  }
	  var reader = new FileReader();
	  reader.onload = function (e) {
		var selected = $('#game-letters').val();
		var selectedArray = selected.split(',')
		var select = "<select id='game-right_answer' name='Game[right_answer][]' multiple ><option>Please Select Right Answer</option>";
		for (i = 0; i < selectedArray.length; i++) {
		    select += "<option value='" + selectedArray[i] + "'>" + selectedArray[i] + "</option>";
		}
		var html = "<div class='col-md-3 image-preview" + s + "' data-id='" + (i + 1) + "'><img class='img-responsive' alt=" + f.name + " src=\"" + e.target.result + "\">";
		html += select;
		html += "</div>"
		selDiv.innerHTML += html;
		var list = selDiv.children[0].className;
		if (list.indexOf('default-img') == -1) {
		    selDiv.children[0].className += ' default-img';
		    selDiv.children[0].title = 'Default Image';
		    rb.value = 1;
		    rb.checked = true
		}
		$('#game-right_answer').select2({
		    'multiple': true
		})
		/* if(isProductImage){
		 $.ajax({
		 url: '/' + language + '/colors/get-colors-list',
		 method: 'post',
		 success: function (res) {
		 var html = "<div class='col-md-3 image-preview" + s + "' data-id='" + (i + 1) + "'><img class='img-responsive' src=\"" + e.target.result + "\">" + f.name + "</div>"
		 html+= '<div>'+res+'</div>';
		 selDiv.innerHTML += html;
		 var list = selDiv.children[0].className;
		 if (list.indexOf('default-img') == -1) {
		 selDiv.children[0].className += ' default-img';
		 selDiv.children[0].title = 'Default Image';
		 rb.value = 1;
		 rb.checked = true
		 }
		 }
		 });
		 }else{
		 var html = "<div class='col-md-3 image-preview" + s + "' data-id='" + (i + 1) + "'><img class='img-responsive' src=\"" + e.target.result + "\">" + f.name + "</div>";
		 selDiv.innerHTML += html;
		 var list = selDiv.children[0].className;
		 if (list.indexOf('default-img') == -1) {
		 selDiv.children[0].className += ' default-img';
		 selDiv.children[0].title = 'Default Image';
		 rb.value = 1;
		 rb.checked = true
		 }
		 } */

	  };
	  reader.readAsDataURL(f);
	  $('.tagsinputs').tagsinput();
    });
}

function generateCertificate() {
    var content = $('#certificate-content').val();
    var result = "<html><head></head><body>";
    result += content;
    result += "</body></html>";
    console.log(result)
    $('#generatedResult').html(result);
}

$(document).ready(function(){
	$('.linkAnnotation a').click(function(e){
		e.preventDefault();
		console.log($(this).attr('href'))
	})
})
