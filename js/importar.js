//Javascript

$("#btnUpload").click(function (e) {

    var file = $("#fileupload").val();  //Fetch the filename of the submitted file

    if (file == '') {    //Check if a file was selected
        //Place warning text below the upload control
        $(".errorDiv").html("Porfavor seleccione un archivo primero");
        e.preventDefault();
    }
    else {
        //Check file extension
        var ext = file.split('.').pop().toLowerCase();   //Check file extension if valid or expected
        if ($.inArray(ext, ['xls']) == -1) {
            $(".errorDiv").html("Seleccione el tipo de archivo indicado (XLS).");
            e.preventDefault(); //Prevent submission of form
        }
        else {
    //Do your logic here, file upload, stream. etc.. if file was successfully validated
    }
}
});