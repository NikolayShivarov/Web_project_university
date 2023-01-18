function sendRequest(url, options, successCallback, errorCallback) { 
    var request = new XMLHttpRequest();

    request.onload = function () {
        var response = JSON.parse(request.responseText);

        if (request.status === 200) {
            successCallback(response);
        } else {
            console.log('Not authorized')
            errorCallback(response);
        }
    }

    request.open(options.method, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(options.data);
}


//Hint: https://stackoverflow.com/questions/23980733/jquery-ajax-file-upload-php
// $('#upload').on('click', function() {
//     var file_data = $('#sortpicture').prop('files')[0];   
//     var form_data = new FormData();                  
//     form_data.append('file', file_data);
//     alert(form_data);                             
//     $.ajax({
//         url: 'upload.php', // <-- point to server-side PHP script 
//         dataType: 'text',  // <-- what to expect back from the PHP script, if anything
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form_data,                         
//         type: 'post',
//         success: function(php_script_response){
//             alert(php_script_response); // <-- display response from the PHP script, if any
//         }
//      });
// });