$(document).ready(function () {
    
    $("#addForm").validate({
    
        rules: {
            // parent_name: "required",
              parent_name: {
                required: true
            },
            inputChildName: {
                required: true
            }
          

        },
          messages: {
              parent_name: {
                  required: "Please Select Parent Name "
              },
              inputChildName: {
                  required:"Child name required"
              }

            }
    });

});