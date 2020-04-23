$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
let uploadedDocumentMap = [];
let indexFile = 0;
Dropzone.options.myDropzone = {
    url: $("div#my-dropzone").attr("route-upload"),
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 5,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    dictFileTooBig: "Dung lượng ảnh không được vượt quá 5MB",
    dictInvalidFileType: "Ảnh không đúng định dạng",
    dictMaxFilesExceeded: "Bạn chỉ có thể chọn tối đa 5 ảnh",
    addRemoveLinks: true,
    init: function() {
        const myDropzone = this;
        $.ajax({
            url: $("div#my-dropzone").attr("route-get-images"),
            type: "get",
            data: {},
            dataType: "json",
            success: function(response) {
                console.log(response);
                const data = response.data;
                $.each(data, function(key, value) {
                    var mockFile = { name: value.name, serverId: value.id };

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, value.url);
                    myDropzone.emit("complete", mockFile);
                });
            }
        });
    },
    success: function(file, response) {
        const { data } = response;
        if (response.status === "success") {
            const { data } = response;
            for (let img of data) {
                if (!uploadedDocumentMap.includes(img.id)) {
                    uploadedDocumentMap.push(img.id);
                    $("#form").append(
                        '<input type="hidden" name="images[]" value="' +
                            img.id +
                            '">'
                    );
                }
            }
            file.serverId = uploadedDocumentMap[indexFile++];
        }
    },
    removedfile: function(file) {
        const imageId = file.serverId;
        $.ajax({
            type: "POST",
            url: '{{ url("admin/file/delete") }}',
            data: "id=" + imageId,
            dataType: "html",
            success: function(data) {
                $('input[name="images[]"]').each(function() {
                    if ($(this).val() == imageId) {
                        $(this).remove();
                    }
                });
            }
        });
        var _ref;
        if (file.previewElement) {
            if ((_ref = file.previewElement) != null) {
                _ref.parentNode.removeChild(file.previewElement);
            }
        }
        return this._updateMaxFilesReachedClass();
    },
    previewsContainer: null,
    hiddenInputContainer: "body"
};

$(".btnAddInput").click(function(e) {
    e.preventDefault();
    const inputName = $(this).attr("data-input-name");
    let input = $(`<div class="wrapper-input">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3" style="margin-bottom: 10px;">
            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="${inputName}">
        </div>
        <div class="col-md-1 com-sm-1 col-xs-12">
            <button class="btn btn-danger btnRemoveInput" onClick="removeInput(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
    `);
    const divParent = $(this).parent();
    $(divParent.parent()).append(input);
});

function removeInput(e) {
    const divParent = e.parentNode;
    $(divParent.parentNode).remove();
    return false;
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $("#previewImage").attr("src", e.target.result);
            $("#previewImage").show();
        };
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    } else {
        $("#previewImage").attr("src", "#");
        $("#previewImage").hide();
    }
}

$("#image").change(function() {
    previewImage(this);
});
