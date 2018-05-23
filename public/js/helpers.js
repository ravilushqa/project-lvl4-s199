$(document).ready(function(){

    //delete tag and remove it from list
    $('.delete-tag').click(function(){
        var tag_id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },

            type: "DELETE",
            url: '/tags' + '/' + tag_id,
            success: function (data) {
                console.log(data);

                $("#tag" + tag_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //delete tag and remove it from list
    $('.delete-taskStatus').click(function(){
        var taskStatus_id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },

            type: "DELETE",
            url: '/task-statuses' + '/' + taskStatus_id,
            success: function (data) {
                console.log(data);

                $("#taskStatus" + taskStatus_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    //additional
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('select').select2();
});
