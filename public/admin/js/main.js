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

// Scroll into active sidebar
if ($('.sidebar-item.active').length) {
    document.querySelector('.sidebar-item.active').scrollIntoView(false);
}

//Input mask money
$(document).on('focus', '.money', function() {
    $('.money').mask("#,##0", {
        reverse: true
    });
});
$(document).on('blur', '.money', function() {
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
        console.log(id);
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

$("#all-choices").change(function (e) {
    e.preventDefault();
    $(".choice").prop("checked", $("#all-choices").prop("checked")).change();
});

$(document).on('change', '.choice', function (e) {
    e.preventDefault();
    if ($(".choice:checked").length) {
        $(".btn-removes").removeClass("d-none");
    } else {
        $(".btn-removes").addClass("d-none");
    }
});

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
    }, 3000);
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
                // updateOptions()
                $(".dataTable").each(function () {
                    $(this).DataTable().ajax.reload(null, false);
                });
            } else {
                Swal.fire(
                    "THẤT BẠI!",
                    "Lỗi không xác định. Vui lòng liên hệ nhà phát triển phần mềm để khắc phục.",
                    response.status
                );
                btn.prop("disabled", false).html(str);
            }
        },
        error: function error(errors) {
            clearTimeout(processing);
            Swal.close();
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
}