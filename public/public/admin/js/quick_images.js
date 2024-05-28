// Khi kéo và thả vào khu vực dropzone
$(document).on('dragenter', function (e) {
    e.preventDefault();
    $('#quick_images-dropzone').fadeIn();
    setTimeout(() => {
        $('#quick_images-dropzone').fadeOut();
    }, 3000);
});

$('#quick_images-dropzone').on('dragover', function (e) {
    e.preventDefault();
    $(this).addClass('dragover');
});

$('#quick_images-dropzone').on('dragleave', function (e) {
    e.preventDefault();
    $(this).removeClass('dragover');
    $('#quick_images-dropzone').fadeOut();
});

$('#quick_images-dropzone').on('drop', function (e) {
    e.preventDefault();
    $(this).removeClass('dragover');
    var files = e.originalEvent.dataTransfer.files;
    uploadImages(files);
    $('#quick_images-dropzone').fadeOut();
});

// Upload ảnh
function uploadImages(files) {
    var formData = new FormData();
    for (var i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }
    $.ajax({
        url: config.routes.uploadImage,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name = "csrf-token"]').attr("content"),
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total) * 100;
                    $('#progress-text').text(percentComplete.toFixed(2) + '%');
                }
            }, false);
            return xhr;
        },
        success: function (response) {
            $('#progress-text').text('0%');
            $('#quick_images-dropzone').fadeOut();
            if ($('#quick_images-table').length) {
                $('#quick_images-table').DataTable().clear().draw()
            } else {
                //load lại div hình ảnh
            }
        }
    });
}

function validateImagesSize(input) {
    for (let i = 0; i < input.files.length; i++) {
        files = []
        if ((input.files[i].size / 1024) < 700) {
            files.push(input.files[i])
        }
        uploadImages(files);
    }
}

function selectFile(obj) {
    obj.querySelector('input[type="file"]').click()
}

/**
 * Xử lý cho quick_images
 */
$(".btn-upload-images").click(function () {
    $("#quick_images-dropzone").trigger("click");
});