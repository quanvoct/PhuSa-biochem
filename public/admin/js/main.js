function slideToggle(t, e, o) {
    0 === t.clientHeight ? j(t, e, o, !0) : j(t, e, o);
}
function slideUp(t, e, o) {
    j(t, e, o);
}
function slideDown(t, e, o) {
    j(t, e, o, !0);
}
function j(t, e, o, i) {
    void 0 === e && (e = 400),
        void 0 === i && (i = !1),
        (t.style.overflow = "hidden"),
        i && (t.style.display = "block");
    var p,
        l = window.getComputedStyle(t),
        n = parseFloat(l.getPropertyValue("height")),
        a = parseFloat(l.getPropertyValue("padding-top")),
        s = parseFloat(l.getPropertyValue("padding-bottom")),
        r = parseFloat(l.getPropertyValue("margin-top")),
        d = parseFloat(l.getPropertyValue("margin-bottom")),
        g = n / e,
        y = a / e,
        m = s / e,
        u = r / e,
        h = d / e;
    window.requestAnimationFrame(function l(x) {
        void 0 === p && (p = x);
        var f = x - p;
        i
            ? ((t.style.height = g * f + "px"),
                (t.style.paddingTop = y * f + "px"),
                (t.style.paddingBottom = m * f + "px"),
                (t.style.marginTop = u * f + "px"),
                (t.style.marginBottom = h * f + "px"))
            : ((t.style.height = n - g * f + "px"),
                (t.style.paddingTop = a - y * f + "px"),
                (t.style.paddingBottom = s - m * f + "px"),
                (t.style.marginTop = r - u * f + "px"),
                (t.style.marginBottom = d - h * f + "px")),
            f >= e
                ? ((t.style.height = ""),
                    (t.style.paddingTop = ""),
                    (t.style.paddingBottom = ""),
                    (t.style.marginTop = ""),
                    (t.style.marginBottom = ""),
                    (t.style.overflow = ""),
                    i || (t.style.display = "none"),
                    "function" == typeof o && o())
                : window.requestAnimationFrame(l);
    });
}
var sidebarItems = document.querySelectorAll(".sidebar-item.has-sub");
var _loop = function _loop() {
    var sidebarItem = sidebarItems[i];
    sidebarItems[i]
        .querySelector(".sidebar-link")
        .addEventListener("click", function (e) {
            e.preventDefault();
            var submenu = sidebarItem.querySelector(".submenu");
            if (submenu.classList.contains("active"))
                submenu.style.display = "block";
            if (submenu.style.display == "none")
                submenu.classList.add("active");
            else submenu.classList.remove("active");
            slideToggle(submenu, 300);
        });
};
for (var i = 0; i < sidebarItems.length; i++) {
    _loop();
}
window.addEventListener("DOMContentLoaded", function (event) {
    var w = window.innerWidth;
    if (w < 1200 || 1) {
        document.getElementById("sidebar").classList.remove("active");
    }
});
window.addEventListener("resize", function (event) {
    var w = window.innerWidth;
    if (w < 1200 || 1) {
        document.getElementById("sidebar").classList.remove("active");
    } else {
        document.getElementById("sidebar").classList.add("active");
    }
});
document.querySelector(".burger-btn").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("active");
});
document.querySelector(".sidebar-hide").addEventListener("click", function () {
    document.getElementById("sidebar").classList.toggle("active");
});

// Perfect Scrollbar Init
if (typeof PerfectScrollbar == "function") {
    var container = document.querySelector(".sidebar-wrapper");
    var ps = new PerfectScrollbar(container, {
        wheelPropagation: false,
    });
}
$(".submenu-item > a").each(function () {
    if ($(this).attr("href") === window.location.href) {
        $(this)
            .parents()
            .addClass("active")
            .parents(".submenu")
            .addClass("active")
            .parents(".sibdebar-item")
            .addClass("active");
    }
});

$(".sidebar-link").each(function () {
    if ($(this).attr("href") === window.location.href) {
        $(this).parent().addClass("active");
    }
});

$('body').on('hidden.bs.modal', '.modal', function () {
    $('.modal.show').find('.select2').select2(config.select2);
})

// Scroll into active sidebar
if ($('.sidebar-item.active').length) {
    document.querySelector('.sidebar-item.active').scrollIntoView(false);
}

/**
 * Nén và hiển thị hình ảnh
 */
$(document).on('change', 'input[type=file][name=image]', function (event) {
    const file = event.target.files[0], input = $(this)
    if (file) {
        new Compressor(file, {
            quality: 0.8,
            maxWidth: 600,
            maxHeight: 600,
            mimeType: 'image/webp',
            success(result) {
                const compressedFile = new File([result], file.name.replace(/\.\w+$/, '.webp'), {
                    type: 'image/webp',
                    lastModified: Date.now(),
                });
                // Tạo lại input với file đã nén
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(compressedFile);
                input[0].files = dataTransfer.files;
                // Hiển thị hình ảnh đã nén
                const previewURL = URL.createObjectURL(compressedFile);
                input.prev().find('img').attr('src', previewURL)
                input.next().find('[type=button]').removeClass('d-none');
            },
            error(err) {
                Toastify({
                    text: err.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "var(--bs-danger)",
                }).showToast();
            },
        });
    }
});

/**
 * Xử lý hình ảnh
 */

//Tạo nút Thêm hình ảnh cho summernote
var selectImage = function () {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: '<i class="note-icon-picture"></i>',
        // tooltip: 'Add Image',
        click: function () {
            $('#quick_images-modal').modal('show');
            $('.btn-insert-images').removeClass('d-none')
            $('.btn-select-images').addClass('d-none')
        }
    });
    return button.render();
}

//Chèn hình ảnh đã chọn vào summernote
$(document).on('click', '.btn-insert-images', function () {
    $('.quick_images-choice:checked').each(function () {
        $('.summernote').summernote('insertImage', config.routes.storage + '/' + $(this).attr('data-name'), function (image) {
            image.addClass('img-article rounded-4')
        });
    })
    $(this).addClass('d-none').parents('.modal').modal('hide')
    $('.quick_images-choice').prop('checked', false)
})
//END xử lý hình ảnh đưa vào thẻ summernote

//Chọn hình ảnh
$(document).on("click", ".btn-select-images", function () {
    let imagesName = [];
    if ($(this).attr("data-select") == "single") {
        imagesName.length = 0;
    } else {
        imagesName = $("#" + $(this).attr("data-target"))
            .val()
            .split("|");
    }
    $(".quick_images-choice:checked").each(function () {
        imagesName.push($(this).attr("data-name"));
    });
    $("#" + $(this).attr("data-target"))
        .val(imagesName.join("|"))
        .change();
    $(this)
        .addClass("d-none")
        .parents(".modal")
        .modal("hide")
        .find(".quick_images-choice")
        .attr("type", "checkbox")
        .prop("checked", false); //reset
});

//Xử lý hiển thị hình ảnh cho module gallery_images
function viewImage(input) {
    if (input.val() != "") {
        $(`label[for='${input.attr("id")}']`)
            .find("img")
            .attr("src", config.routes.storage + "/" + input.val());
        input.next().find('.btn-remove-image').removeClass("d-none");
    } else {
        $(`label[for='${input.attr("id")}']`)
            .find("img")
            .attr("src", config.routes.placeholder);
        input.next().find('.btn-remove-image').addClass("d-none");
    }
}

function openQuickImages(target, isSingle = true) {
    $("#quick_images-modal").modal("show");
    $(".quick_images-choice").attr("type", isSingle ? "radio" : "checkbox");
    $(".btn-select-images")
        .removeClass("d-none")
        .attr("data-target", target)
        .attr("data-select", isSingle ? "single" : "multiple");
    $(".btn-insert-images").addClass("d-none");
}
//END xử lý hình ảnh đưa vào thẻ input


// Xử lý hiển thị hình ảnh từ module feature_image
$(".hidden-image").each(function () {
    viewImage($(this));
});

$(document).on("change", ".hidden-image", function () {
    viewImage($(this));
});

$(document).on("click", "label.select-image", function () {
    openQuickImages($(this).attr("for"));
});

//Xoá ảnh nổi bật
$(document).on('click', '.btn-remove-image', function () {
    $(this).parent().prev().val('').change();
})

//Xoá gallery
$(document).on('click', '.btn-remove-images', function () {
    imagesName = $(this).parents('.gallery').prev().val().split('|')
    imagesName.splice($(this).attr('data-index'), 1)
    $(this).parents('.gallery').prev().val(imagesName.join('|')).change();
})
//END Xử lý hiển thị hình ảnh từ module feature_image

/**
 * Xử lý summernote editor
 */
$('.air').summernote({
    airMode: true,
    popover: {
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        table: [
            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
        ],
        air: [
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['insert', ['hr', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ]
    }
});

$('.summernote').summernote({
    tabsize: 2,
    height: 1500,
    disableDragAndDrop: true,
    codemirror: {
        theme: 'monokai'
    },
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],

        ['table', ['table']],
        ['insert', ['link', 'image', 'video']],
        ['view', ['fullscreen', 'codeview']],
    ],
    buttons: {
        image: selectImage
    },
    popover: {
        image: [
            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
        link: [
            ['link', ['linkDialogShow', 'unlink']]
        ],
        table: [
            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
        ]
    }
});
//END xử lý summernote editor

/**
 * Loại bỏ dấu tiếng Việt khỏi chuỗi
 */
function string_to_slug(str) {
    // remove accents
    var from = "àáãảạăằắẳẵặâầấẩẫậèéẻẽẹêềếểễệđùúủũụưừứửữựòóỏõọôồốổỗộơờớởỡợìíỉĩịäëïîöüûñçýỳỹỵỷ",
        to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeduuuuuuuuuuuoooooooooooooooooiiiiiaeiiouuncyyyyy";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(RegExp(from[i], "gi"), to[i]);
    }
    str = str.toLowerCase()
        .trim()
        .replace(/[^a-z0-9\-]/g, '-')
        .replace(/-+/g, '-');
    return str;
}

// Xử lý khi người dùng click vào hình ảnh bất kỳ
$(document).on("click", "img.thumb", function () {
    Swal.fire({
        imageUrl: $(this).attr("src"),
        padding: 0,
        showConfirmButton: false,
        background: "transparent",
    });
});

/**
 * Check choice
 */
$(document).on("change", ".all-choices", function (e) {
    $(".choice").prop("checked", $(this).prop("checked")).change();
});

$(document).on("change", ".choice", function (e) {
    e.preventDefault();
    if ($(".choice:checked").length) {
        $(".process-btns").removeClass("d-none");
    } else {
        $(".process-btns").addClass("d-none");
    }
});

/**
 * Sắp xếp dữ liệu
 */
$('body').on('click', '.btn-sort', function () {
    var form = $(this).closest('section').find('.batch-form');
    var checkedValues = JSON.stringify(form.find('input[name="choices[]"]:checked').map(function () {
        return $(this).val();
    }).get());
    sortOrder(config.routes.get + '/list?ids=' + checkedValues, config.routes.sort)
})

function sortOrder(routeGet, routeSort) {
    $.get(routeGet, function (objs) {
        $("#sortable").empty();
        $('#sort-modal').find('.alert').remove();
        $.each(objs, function (index, obj) {
            $('#sort-modal').find('#sortable').append(`
            <li class="list-group-item d-flex justify-content-start align-items-center border" data-name="${string_to_slug(obj.name)}" data-time="${new Date(obj.created_at).getTime()}" data-id="${obj.id}">
                <i class="bi bi-grip-vertical"></i> <span>${obj.name}</span>
            </li>`);
        })
        $('#sort-modal').modal('show');
        $("#sortable").sortable({
            update: function (event, ui) {
                var sortedIDs = $("#sortable").sortable("toArray", {
                    attribute: "data-id"
                });
                saveOrder(sortedIDs, routeSort);
            }
        });
        $("#sortable").disableSelection();
    })
}

$(document).on('change', '#sort-type', function (e) {
    e.preventDefault()
    var sortable = $("#sortable");
    var items = sortable.children("li").get();
    switch ($(this).val()) {
        case 'time-az':
            items.sort(function (a, b) {
                var timeA = $(a).attr('data-time');
                var timeB = $(b).attr('data-time');
                return timeA - timeB;
            });
            break;
        case 'time-za':
            items.sort(function (a, b) {
                var timeA = $(a).attr('data-time');
                var timeB = $(b).attr('data-time');
                return timeB - timeA;
            });
            break;
        case 'title-az':
            items.sort(function (a, b) {
                var textA = $(a).attr('data-name');
                var textB = $(b).attr('data-name');
                return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
            });
            break;
        case 'title-za':
            items.sort(function (a, b) {
                var textA = $(a).attr('data-name');
                var textB = $(b).attr('data-name');
                return (textA > textB) ? -1 : (textA < textB) ? 1 : 0;
            });
            break;

        default:
            break;
    }
    $.each(items, function (index, item) {
        sortable.append(item);
    });
    var sortedIDs = $("#sortable").sortable("toArray", {
        attribute: "data-id"
    });
    saveOrder(sortedIDs, config.routes.sort);
})

function saveOrder(sortedIDs, routeSort) {
    $.ajax({
        type: "POST",
        url: routeSort,
        data: {
            sort: sortedIDs
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name = "csrf-token"]').attr("content"),
        },
        success: function (response) {
            Toastify({
                text: response.msg,
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: 'var(--bs-success)',
            }).showToast();
            $('.dataTable').DataTable().clear().draw();
        },
        error: function (xhr, status, error) {
            Swal.fire(
                'Thất bại!',
                'Đã có lỗi xảy ra, vui lòng reload trang và thử lại!',
                'error'
            )
        }
    });
}
//END Sắp xếp dữ liệu

// Bật tắt nút XÓA khi thay đổi trạng thái checkbox
$(document).on("change", ".quick_images-choice", function (e) {
    if ($("#grid-view").find(".quick_images-choice:checked").length) {
        $(".btn-delete-images").removeClass("d-none");
    } else {
        $(".btn-delete-images").addClass("d-none");
    }
});
// END bật tắt nút xóa khi thay đổi trạng thái checkbox

function datatableAjaxError(errors) {
    console.log(errors.status);
    if (errors.status == 401 || errors.status == 419) {
        console.warn(errors.responseJSON.errors);
        window.location.href = config.routes.login;
    } else {
        console.log('Error:', errors);
        Swal.fire(`ĐÃ CÓ LỖI XẢY RA!`, errors.responseJSON.$message, 'error');
    }
}

//Bật modal sửa thông tin ảnh
$(document).on("click", ".btn-update-image", function () {
    const id = $(this).attr("data-id"),
        form = $("#quick_images-update-form");
    $.get(config.routes.getImage + '/' + id, function (image) {
        form.find("[name=name]").val(image.name.split(".")[0]);
        form.find("[name=alt]").val(image.alt);
        form.find("[name=caption]").val(image.caption);
        form.find("[name=id]").val(image.id);
        form.find(".card-img").attr("src", image.link);
        form.find(".btn-delete-image").attr("data-id", image.id);
        form.find(".modal").modal("show");
    });
});
//END Bật modal sửa thông tin ảnh

//Xoá ảnh đơn lẻ
$(document).on("click", ".btn-delete-image", function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Xác nhận?",
        text: "Vui lòng xác nhận trước khi tiếp tục!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "var(--bs-danger)",
        cancelButtonColor: "var(--bs-primary)",
        confirmButtonText: "OK, xoá đi!",
        cancelButtonText: "Quay lại",
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm($(this).parents("form"));
        }
    });
});

//Xoá hàng loạt ảnh
$(".btn-delete-images").click(function () {
    $("#quick_images-form").attr("action", config.routes.deleteImage);
    Swal.fire({
        title: "Xác nhận?",
        text: "Vui lòng xác nhận trước khi tiếp tục!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "var(--bs-danger)",
        cancelButtonColor: "var(--bs-primary)",
        confirmButtonText: "OK, xoá đi!",
        cancelButtonText: "Quay lại",
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm($("#quick_images-form")).done(function () {
                $(".btn-delete-images").addClass("d-none");
            });
        }
    });
});
// END Xóa hàng loạt ảnh

/**
 * Xử lý tooltip cho toàn trang
 */
$(document).on("mouseenter", '[data-bs-toggle="tooltip"]', function () {
    $(this).tooltip("show");
});

$(document).on("mouseleave", '[data-bs-toggle="tooltip"]', function () {
    // $("[data-toggle='tooltip']").tooltip("destroy");
    $(".tooltip").remove();
});

//Input mask money
$(document).on('focus', '.money', function () {
    $('.money').mask("#,##0", {
        reverse: true
    });
});
$(document).on('blur', '.money', function () {
    $('.money').unmask();
})

moment.locale("vi");

function number_format(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

/**
 * Reset form
 */
function resetForm(frm) {
    frm.trigger("reset").find(".modal").modal("hide")
        .end().find("input").add("select").add('textarea').removeClass("is-invalid").prop('disabled', false).next().remove("span")
        .end().find("[type=hidden]").val("").end().find("[type=checkbox]").prop("checked", false)
}

$('.save-form').on('submit', function (e) {
    e.preventDefault();
    form = $(this);
    submitForm(form).done(function (response) {
        form.find("[type=submit]").prop("disabled", false).html("Lưu");
    });
});

$(document).on('click', '.btn-remove', function (e) {
    e.preventDefault();
    submitForm($(this).parents("form"));
});

$(document).on('click', '.btn-removes', function () {
    var form = $('#batch-form');
    $(".btn-removes").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" id="spinner-form" role="status"></span>');
    form.attr('action', config.routes.remove);
    submitForm(form).done(function () {
        $(".btn-removes").prop("disabled", false).html('<i class="bi bi-trash"></i> Xóa').addClass("d-none");
    });
});

$(document).on('click', '.btn-remove-detail', function (e) {
    e.preventDefault()
    const btn = $(this),
        id = btn.prev().val()
    if (id != '') {
        Swal.fire({
            title: "Xác nhận?",
            text: "Vui lòng xác nhận trước khi tiếp tục!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý!",
            cancelButtonText: "Quay lại",
        }).then((result) => {
            if (result.isConfirmed) {
                submitForm(btn.closest('form')).done(function () {
                    btn.parents('tr').remove()
                })
            }
        });
    } else {
        btn.parents('tr').remove()
    }
})

// setInterval(function () {
//     if (!$(".choice").length) {
//         $("#data-table").DataTable().ajax.reload(null, false);
//     }
// }, 10000);

$(document).on('click', '.permissions', function () {
    $(this).parents('fieldset').find('[type=checkbox]').prop('checked', $(this).prop('checked'));
});

function submitForm(frm) {
    var btn = frm.find("[type=submit]:last");
    frm.find("input")
        .add("select")
        .add('textarea')
        .removeClass("is-invalid")
        .prop('disabled', false)
        .next()
        .remove("span");
    let str = `<span class="${(btn.text() == '') ? '' : 'text-white'}"><i class="bi bi-exclamation-circle-fill mt-1"></i>${(btn.text() == '') ? '' : ' Thử lại'}</span>`
    btn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm" id="spinner-form" role="status"></span>');
    const processing = setTimeout(() => {
        Swal.fire({
            title: 'Vẫn đang hoạt động...',
            text: 'Thao tác của bạn cần nhiều thời gian hơn để xử lý. Xin hãy kiên nhẫn!',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    }, 5000);
    return $.ajax({
        data: new FormData(frm[0]),
        url: frm.attr("action"),
        method: frm.attr("method"),
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name = "csrf-token"]').attr("content"),
        },
        success: function success(response) {
            clearTimeout(processing);
            Swal.close();
            if (response.status == "success") {
                Toastify({
                    text: response.msg,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "var(--bs-".concat(response.status, ")"),
                }).showToast();
                resetForm(frm);
                $(".dataTable").each(function () {
                    $(this).DataTable().ajax.reload(null, false);
                });
            } else {
                Swal.fire(
                    "THẤT BẠI!",
                    "Lỗi không xác định. Vui lòng liên hệ nhà phát triển phần mềm để khắc phục.",
                    response.status
                );
                frm.find(`.select2`).select2(config.select2);
                $('input.select2-search__field').removeAttr('style')
                btn.prop("disabled", false).html(str);
            }
        },
        error: function error(errors) {
            clearTimeout(processing);
            Swal.close();
            frm.find(`.select2`).select2(config.select2);
            btn.prop("disabled", false).html(str);
            if (errors.status == 419 || errors.status == 401) {
                window.location.href = config.routes.login;
            } else if (errors.status == 422) {
                frm.find(".is-invalid")
                    .removeClass("is-invalid")
                    .next()
                    .remove("span");
                $.each(errors.responseJSON.errors, function (i, error) {
                    var el = frm.find('[name="' + i + '"]');
                    if (el.length) {
                        el.addClass("is-invalid").next().remove("span");
                        el.after(
                            $('<span class="text-danger">' + error[0] + "</span>")
                        );
                    } else {
                        Swal.fire("Thông báo!", error[0], "info");
                    }
                });
            } else {
                Toastify({
                    text: "Lỗi không xác định. Vui lòng liên hệ nhà phát triển phần mềm để khắc phục.",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "var(--bs-danger)",
                }).showToast();
            }
        },
    });

    /**
     * Hàm xử lý lỗi ajax DataTables
     */
    function dataTableErrorProcess(err) {
        if (err.status == 401 || err.status == 419) {
            console.warn(err.responseJSON.errors);
            window.location.href = config.routes.login;
        } else {
            console.log("Error:", err);
            Swal.fire(
                "{{ __('\u0110\xC3 C\xD3 L\u1ED6I X\u1EA2Y RA!') }}",
                err.responseJSON.$message,
                "error"
            );
        }
    }
}