// Allowed file size is less than 15 MB (15728640)
var max_filesize        = $('#maximumSize').val();
var api_document        = 'api/document.php';

$(document).ready(function(){
    $documentForm       = $('#documentForm');
    $filePreview        = $('#filePreview');
    $btnSubmit          = $('#btnSubmit');
    $fileName           = $('#fileName');
    $fileInput          = $('#file');
    $titleInput         = $('#title');
    $descriptionInput   = $('#description');
    $fileSizeInfo       = $('#fileSizeInfo');

    autosize($('textarea'));
    $fileSizeInfo.html('ขนาดไม่เกิน '+(max_filesize/1048576)+' MB');

    $filePreview.click(function(){
        $fileInput.focus().click();
    });

    $fileInput.change(function(){
        var files       = this.files;
        var file        = files[0];
        var size        = file.size;
        var filename    = file.name.substring(0,file.name.lastIndexOf('.'));
        var extension   = file.name.substring(file.name.lastIndexOf('.')+1);

        if(!FileType(extension)){
            alert('ระบบยังไม่รองรับไฟล์ประเภท .'+extension);
            location.reload();
            return false;
        }else if(!FileSize(size)){
            alert('ไฟล์ของคุณมีขนาด '+numeral(size).format('0.0 b')+' ซึ่งต้องไม่เกิน '+(max_filesize/1048576)+' MB');
            location.reload();
            return false;
        }else{
            $('.form-items').removeClass('hidden middle');
            
            $fileName.html(file.name);
            $fileSizeInfo.html('ขนาด '+numeral(size).format('0.0 b'));
            $('#title').val(filename);
            $('#title').focus();

            $btnSubmit.removeClass('loading');
            $btnSubmit.prop('disabled', false);
        }
    });

	$documentForm.ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            var filename        = formData[0].value.name;
            var filesize        = formData[0].value.size;
            var extension       = filename.substring(filename.lastIndexOf('.')+1);
            var title           = formData[1].value;
            var category_id     = formData[3].value;

            if(!FileSize(filesize)) return false;
            if(!FileType(extension)) return false;
            if(!title || !category_id || !filename) return false;

            $btnSubmit.addClass('loading');
            $btnSubmit.html('รอสักครู่<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');

            $btnSubmit.prop('disabled', true);
            $fileInput.prop('disabled', true);
            $titleInput.prop('disabled', true);
            $descriptionInput.prop('disabled', true);

            $progressbar.fadeIn(300);
            $progressbar.width('0%');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            $progressbar.animate({width:percent+'%'},100);
        },
        success: function() {
            $progressbar.animate({width:'100%'},300);
        },
        complete: function(xhr) {
            if(xhr.responseJSON){
                var file_id = xhr.responseJSON.file_id;
                setTimeout(function(){
                    window.location = 'document/privacy/'+file_id;
                },2000);
            }else{
                alert('ไฟล์ของคุณไม่สามารถอัพโหลดเข้าระบบได้ กรุณาติดต่อผู้ดูแลระบบ');
                location.reload();
            }
        }
    });
});

function FileSize(fsize){
    if(fsize > max_filesize)
        return false;
    else
        return true;
}
function FileType(extension){
    switch(extension){
        case 'pdf': case 'txt': case 'doc': case 'docx': case 'ppt': case 'pptx': case 'xls': case 'xlsx': case 'zip':
            break;
        default:
            return false
        }

    return true;
}