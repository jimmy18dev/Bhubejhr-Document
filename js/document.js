var api_document = 'api/document.php';

$(document).ready(function(){

    autosize($('textarea'));

    $btnPrivacySave = $('#btnPrivacySave');
    $btnSave        = $('#btnSave');
    $btnDelete      = $('#btnDelete');

    // Privacy
    var default_privacy = $('#privacy').val();

    console.log(default_privacy);

    $('#privacy-'+default_privacy).addClass('active');
    $('.privacy-items').click(function(){
        var privacy = $(this).attr('data-v');
        $('.privacy-items').removeClass('active');
        $(this).addClass('active');
        $('#privacy').val(privacy);
    });

    $btnSave.click(function(){
        var title           = $('#title').val();
        var category_id     = $('#category_id').val();
        var description     = $('#description').val();
        var privacy         = $('#privacy').val();
        var file_id         = $('#file_id').val();

        console.log('Saved');

        if(!title || !category_id || !privacy || !file_id) return false;

        $progressbar.fadeIn(300);
        $progressbar.width('0%');

        $btnSave.prop('disabled', true);
        $btnSave.addClass('loading');
        $btnSave.html('รอสักครู่<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

        $('#title').prop('disabled', true);

        $.get({
            url         :api_document,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit',
                file_id     :file_id,
                category_id :category_id,
                title       :title,
                description :description,
                privacy     :privacy
            },
            error: function (request, status, error) {
                console.log("Request Error",request.responseText);
            }
        }).done(function(data){
            $progressbar.animate({width:'100%'},500);
            setTimeout(function(){
                window.location = 'document/'+file_id;
            },2000);
        });
    });

    $btnPrivacySave.click(function(){
        var privacy = $('#privacy').val();
        var file_id = $('#file_id').val();

        $btnPrivacySave.addClass('loading');
        $btnPrivacySave.prop('disabled', false);
        $btnPrivacySave.html('รอสักครู่<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

        $progressbar.fadeIn(300);
        $progressbar.width('0%');

        $.get({
            url         :api_document,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'change_privacy',
                file_id     :file_id,
                privacy     :privacy
            },
            error: function (request, status, error) {
                console.log("Request Error",request.responseText);
            }
        }).done(function(data){
            $progressbar.animate({width:'100%'},500);
            setTimeout(function(){
                window.location = 'document/'+file_id+'#qrcode';
            },2000);
        });
    });

    $btnDelete.click(function(){
        var fileid      = $('#file_id').val();
        var filename    = $('#title').val();

        if(!fileid || !filename) return false;

        if(!confirm('คุณต้องการลบไฟล์ "'+filename+'"ใช่หรือไม่ ?')){ return false; }

        $btnDelete.addClass('loading');
        $btnDelete.prop('disabled', false);
        $btnDelete.html('กำลังลบไฟล์<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

        $progressbar.fadeIn(300);
        $progressbar.width('0%');

        $.get({
            url         :api_document,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'delete',
                file_id     :fileid
            },
            error: function (request, status, error) {
                console.log("Request Error",request.responseText);
            }
        }).done(function(data){
            $progressbar.animate({width:'100%'},500);
            setTimeout(function(){
                window.location = 'index.php';
            },2000);
        });
    });
});