$(document).ready(function(e) {
    $(document).trigger("enhance");
    // const checkWidth = function() {
    //     if ($(document).width() < 1196) {
    //         $('#btn_side_collapse').addClass('d-none');
    //         $("#sidebar .link-text").each(function() {
    //             $(this).addClass("d-none");
    //         });
    //         $("#sidebar .inner-link").each(function() {
    //             $(this).css("padding", "10px 0");
    //         });
    //         $("#admin .main-wrapper").css({
    //             width: "calc(100% - 65px)",
    //             "margin-left": "65px"
    //         });
    //         $("#sidebar").css("width", "65px");
    //         $("#sidebar .sidebar-link").each(function() {
    //             const title = $(this)
    //                 .children(".inner-link")
    //                 .text()
    //                 .trim();
    //             $(this).attr({
    //                 "data-toggle": "tooltip",
    //                 "data-placement": "right",
    //                 title: title,
    //                 "data-original-title": title
    //             });
    //         });
    //         $("#side-header")
    //             .addClass("d-none")
    //             .removeClass("mb-3");
    //         $("#btn_side_collapse_icon")
    //             .removeClass("fa-bars")
    //             .addClass("fa-ellipsis-v");
    //         $("#sidebar .inner-link.active").css({
    //             "background-color": "transparent",
    //             "border-radius": "0",
    //             "box-shadow": "none",
    //             color: "#7367F0"
    //         });
    //         $("#short-name").removeClass('d-none');
    //     } else {
    //         $('#btn_side_collapse').removeClass('d-none');
    //         setTimeout(function() {
    //             $("#sidebar .link-text").each(function() {
    //                 $(this).removeClass("d-none");
    //             });
    //         }, 200);
    //         $("#sidebar .inner-link").each(function() {
    //             $(this).css("padding", "");
    //         });
    //         $("#admin .main-wrapper").css({
    //             width: "calc(100% - 260px)",
    //             "margin-left": "260px"
    //         });
    //         $("#sidebar").css("width", "260px");
    //         setTimeout(function() {
    //             $("#side-header")
    //                 .addClass("mb-3")
    //                 .removeClass("d-none");
    //         }, 200);
    //         $("#sidebar .sidebar-link").each(function() {
    //             $(this).attr({
    //                 "data-toggle": "",
    //                 "data-placement": "",
    //                 title: "",
    //                 "data-original-title": ""
    //             });
    //         });
    //         $("#btn_side_collapse_icon")
    //             .removeClass("fa-ellipsis-v")
    //             .addClass("fa-bars");
    //         $("#sidebar .inner-link.active").css({
    //             "background-color": "",
    //             "border-radius": "",
    //             "box-shadow": "",
    //             color: ""
    //         });
    //     }
    // };


    const checkWidth = function() {
        $('#btn_side_collapse').addClass('d-none');
        $("#sidebar .link-text").each(function() {
            $(this).addClass("d-none");
        });
        $("#sidebar .inner-link").each(function() {
            $(this).css("padding", "10px 0");
        });
        $("#admin .main-wrapper").css({
            width: "calc(100% - 65px)",
            "margin-left": "65px"
        });
        $("#sidebar").css("width", "65px");
        $("#sidebar .sidebar-link").each(function() {
            const title = $(this)
                .children(".inner-link")
                .text()
                .trim();
            $(this).attr({
                "data-toggle": "tooltip",
                "data-placement": "right",
                title: title,
                "data-original-title": title
            });
        });
        $("#side-header")
            .addClass("d-none")
            .removeClass("mb-3");
        $("#btn_side_collapse_icon")
            .removeClass("fa-bars")
            .addClass("fa-ellipsis-v");
        $("#sidebar .inner-link.active").css({
            "background-color": "transparent",
            "border-radius": "0",
            "box-shadow": "none",
            color: "#7367F0"
        });
        $("#short-name").removeClass('d-none');
    };
    $(window).resize(checkWidth);

    checkWidth();

    setTimeout(function() {
        $("#sidebar .link-text").each(function(index) {
            $(this).addClass("d-none");
        });
        $("#sidebar .inner-link").each(function(index) {
            $(this).css("padding", "10px 0");
        });
        $("#admin .main-wrapper").css({
            width: "calc(100% - 65px)",
            "margin-left": "65px"
        });
        $("#sidebar").css("width", "65px");
        $("#side-header")
            .addClass("d-none")
            .removeClass("mb-3");
        $("#btn_side_collapse_icon")
            .removeClass("fa-bars")
            .addClass("fa-ellipsis-v");
        $("#sidebar .sidebar-link").each(function() {
            const title = $(this)
                .children(".inner-link")
                .text()
                .trim();
            $(this).attr({
                "data-toggle": "tooltip",
                "data-placement": "right",
                title: title,
                "data-original-title": title
            });
        });
        $("#sidebar .inner-link.active").css({
            "background-color": "transparent",
            "border-radius": "0",
            "box-shadow": "none",
            color: "#7367F0"
        });
        $("#loading_page").addClass("d-none");
        $("#admin").removeClass("d-none");
        // if (localStorage.getItem("toggle") === "true") {
        //     $("#sidebar .link-text").each(function(index) {
        //         $(this).addClass("d-none");
        //     });
        //     $("#sidebar .inner-link").each(function(index) {
        //         $(this).css("padding", "10px 0");
        //     });
        //     $("#admin .main-wrapper").css({
        //         width: "calc(100% - 65px)",
        //         "margin-left": "65px"
        //     });
        //     $("#sidebar").css("width", "65px");
        //     $("#side-header")
        //         .addClass("d-none")
        //         .removeClass("mb-3");
        //     $("#btn_side_collapse_icon")
        //         .removeClass("fa-bars")
        //         .addClass("fa-ellipsis-v");
        //     $("#sidebar .sidebar-link").each(function() {
        //         const title = $(this)
        //             .children(".inner-link")
        //             .text()
        //             .trim();
        //         $(this).attr({
        //             "data-toggle": "tooltip",
        //             "data-placement": "right",
        //             title: title,
        //             "data-original-title": title
        //         });
        //     });
        //     $("#sidebar .inner-link.active").css({
        //         "background-color": "transparent",
        //         "border-radius": "0",
        //         "box-shadow": "none",
        //         color: "#7367F0"
        //     });
        //     $("#loading_page").addClass("d-none");
        //     $("#admin").removeClass("d-none");
        // } else {
        //     setTimeout(function() {
        //         $("#sidebar .link-text").each(function(index) {
        //             $(this).removeClass("d-none");
        //         });
        //     }, 200);
        //     $("#sidebar .inner-link").each(function(index) {
        //         $(this).css("padding", "");
        //     });
        //     $("#admin .main-wrapper").css({
        //         width: "calc(100% - 260px)",
        //         "margin-left": "260px"
        //     });
        //     $("#sidebar").css("width", "260px");
        //     setTimeout(function() {
        //         $("#side-header")
        //             .addClass("mb-3")
        //             .removeClass("d-none");
        //     }, 200);
        //     $("#btn_side_collapse_icon")
        //         .removeClass("fa-ellipsis-v")
        //         .addClass("fa-bars");
        //     $("#sidebar .sidebar-link").each(function() {
        //         $(this).attr({
        //             "data-toggle": "",
        //             "data-placement": "",
        //             title: "",
        //             "data-original-title": ""
        //         });
        //     });
        //     $("#sidebar .inner-link.active").css({
        //         "background-color": "",
        //         "border-radius": "",
        //         "box-shadow": "",
        //         color: ""
        //     });
        //     $("#loading_page").addClass("d-none");
        //     $("#admin").removeClass("d-none");
        // }
        $('[data-toggle="tooltip"]').tooltip();
    }, 1500);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("#myToast").toast("show");

    $("#category_image").on("change", function(e) {
        let reader = new FileReader();
        reader.onload = e => {
            $("#category_img").css(
                "background-image",
                `url("${e.target.result}")`
            );
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#procate_submit").on("click", function(e) {
        const name = $("#cate_name").val();
        const desc = $("#cate_description").val();
        let formData = new FormData();
        formData.append("name", name);
        formData.append("description", desc);

        $.ajax({
            type: "POST",
            url: "/admin/product/category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                alert(data.success);
                const { name, id } = data.cate;
                $('#category').append(`<option value="${id}">${name}</option>`);
                $('#sub_cate_category').append(`<option value="${id}">${name}</option>`)
            }
        });
    });

    $('#category').on("change", function(e) {
        const cate = $('#category').val();
        let formData = new FormData();
        formData.append('category_id', cate);

        $.ajax({
            type: "POST",
            url: "/admin/product/get-sub-category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                console.log(data);
                $('#sub_cate')
                    .empty()
                    .append('<option value="0">Select any sub-category</option>');
                data.subCate.forEach(val => {
                    $('#sub_cate').append(`<option value="${val.id}">${val.name}</option>`);
                });
            }
        });
    });

    $("#pro_subcate_submit").on("click", function(e) {
        const name = $("#sub_cate_name").val();
        const categoryId = $('#sub_cate_category').val();
        const desc = $("#sub_cate_description").val();

        let formData = new FormData();
        formData.append("name", name);
        formData.append("category_id", categoryId);
        formData.append("description", desc);

        $.ajax({
            type: "POST",
            url: "/admin/product/sub-category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                alert(data.success);
                const { name, id } = data.subCate;
                $('#sub_cate').append(`<option value="${id}">${name}</option>`);
            }
        });
    });

    $("#upload_images").on("change", function(e) {
        const images = $("#upload_images").prop("files");
        let formData = new FormData();
        $.each(images, function(index, val) {
            formData.append('images[]', val)
        });
        $.ajax({
            type: "POST",
            url: "/admin/images/upload",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                const { images, success } = data;
                $('#btn_upload_images').after(
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${success}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`
                );
                $.each(images, function(index, val) {
                    $('#images-pick').prepend(`<option data-img-src="//localhost:3000/${val.path}" data-img-alt="${val.name}" value="${val.id}"></option>`);
                    $('.thumbnails.image_picker_selector').prepend(`
                        <li>
                            <div class="thumbnail">
                                <img class="image_picker_image" src="//localhost:3000/${val.path}" alt="${val.name}">
                            </div>
                        </li>
                    `);
                });
                imagePickerMethod();
            }
        });
    });

    $("#btn_side_collapse").on("click", function(e) {
        if ($("#btn_side_collapse_icon").hasClass("fa-bars")) {
            localStorage.setItem("toggle", true);
            $("#sidebar .link-text").each(function() {
                $(this).addClass("d-none");
            });
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "10px 0");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 65px)",
                "margin-left": "65px"
            });
            $("#sidebar").css("width", "65px");
            $("#sidebar .sidebar-link").each(function() {
                const title = $(this)
                    .children(".inner-link")
                    .text()
                    .trim();
                $(this).attr({
                    "data-toggle": "tooltip",
                    "data-placement": "right",
                    title: title,
                    "data-original-title": title
                });
            });
            $("#side-header")
                .addClass("d-none")
                .removeClass("mb-3");
            $("#btn_side_collapse_icon")
                .removeClass("fa-bars")
                .addClass("fa-ellipsis-v");
            $("#sidebar .inner-link.active").css({
                "background-color": "transparent",
                "border-radius": "0",
                "box-shadow": "none",
                color: "#7367F0"
            });
        } else {
            localStorage.setItem("toggle", false);
            setTimeout(function() {
                $("#sidebar .link-text").each(function() {
                    $(this).removeClass("d-none");
                });
            }, 200);
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 260px)",
                "margin-left": "260px"
            });
            $("#sidebar").css("width", "260px");
            setTimeout(function() {
                $("#side-header")
                    .addClass("mb-3")
                    .removeClass("d-none");
            }, 200);
            $("#sidebar .sidebar-link").each(function() {
                $(this).attr({
                    "data-toggle": "",
                    "data-placement": "",
                    title: "",
                    "data-original-title": ""
                });
            });
            $("#btn_side_collapse_icon")
                .removeClass("fa-ellipsis-v")
                .addClass("fa-bars");
            $("#sidebar .inner-link.active").css({
                "background-color": "",
                "border-radius": "",
                "box-shadow": "",
                color: ""
            });
        }
    });

    $('#btn_submit_pv').on('click', function(e) {
        const productId = $('#pv_product_id').val();
        const color = $('#pv_color').val();
        const size = $('#pv_size').val();
        const price = $('#pv_price').val();
        const discount = $('#pv_discount').val();
        const qty = $('#pv_quantity').val();

        let formData = new FormData();
        formData.append('product_id', productId);
        formData.append('color', color);
        formData.append('size', size);
        formData.append('price', price);
        formData.append('discount', discount);
        formData.append('quantity', qty);

        $.ajax({
            type: "POST",
            url: "/admin/product-variant/create",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                // $('#accordionExample')
                alert('Success: ', data);
            }
        });
    });

    $('#password_type').on('change', function(e) {
        const pass_type = $('#password_type').val();
        if (pass_type == 1) $('#password_expire_form_group').addClass('d-none');
        else {
            if ($('#password_expire_form_group').hasClass('d-none')) $('#password_expire_form_group').removeClass('d-none');
        }
    });

    if ($('#password_type').length) {
        const pass_type = $('#password_type').val();
        if (pass_type == 1) $('#password_expire_form_group').addClass('d-none');
        else
            if ($('#password_expire_form_group').hasClass('d-none')) $('#password_expire_form_group').removeClass('d-none');
    }

    $('#user_search').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "/admin/user/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#user_table').html(data);
            }
        });
    });

    $('#department_search').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        $.ajax({
            type: "POST",
            url: "/admin/department/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#department_table').html(data);
            }
        });
    });

    $('#unit_search').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        $.ajax({
            type: "POST",
            url: "/admin/unit/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#unit_table').html(data);
            }
        });
    });

    $('#group_search').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        $.ajax({
            type: "POST",
            url: "/admin/group/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#group_table').html(data);
            }
        });
    });

    $('#position_search').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        $.ajax({
            type: "POST",
            url: "/admin/position/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#position_table').html(data);
            }
        });
    });

    $('.category_link').on('click', function(e) {
        const id = $(this).attr('data-id');
        let formData = new FormData();
        formData.append('id', id);
        $.ajax({
            type: "POST",
            url: "/get-product-by-category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#product_wrap').html(data);
            }
        });
    });

    $('#search_products').on('keypress', function(e) {
        const value = this.value;
        if(e.which == 13) {
            window.location = `/search-product?search=${value}`;
        }
    });

    function getUnitByDepartment() {
        $('.department').on('change', function(e) {
            const id = this.value;
            $.ajax({
                type: "GET",
                url: `/admin/get-unit-by-department/${id}`,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data) {
                        const { units } = data;
                        $('.unit').removeAttr('disabled');
                        let output = '<option value="0">Please select a unit</option>';
                        if (units && units.length > 0)
                            $.each(units, function(key, value) {
                                output += `<option value="${value.id}" class="text-capitalize">${value.name}</option>`
                            });
                        else
                            $('.group').html('<option value="0">Please select a unit</option>');
                        $('.unit').html(output);
                    }
                }
            });
        });
    }

    function getGroupByUnit() {
        $('.unit').on('change', function(e) {
            const id = this.value;
            $.ajax({
                type: "GET",
                url: `/admin/get-group-by-unit/${id}`,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data) {
                        const { groups } = data;
                        $('.group').removeAttr('disabled');
                        let output = '<option value="0">Please select a unit</option>';
                        if (groups)
                            $.each(groups, function(key, value) {
                                output += `<option value="${value.id}" class="text-capitalize">${value.name}</option>`
                            });
                        $('.group').html(output);
                    }
                }
            });
        });
    }

    function profileImageEdit() {
        $("#profile_edit").on("change", function(e) {
            let reader = new FileReader();
            reader.onload = e => {
                $("#profile_bg_image_edit").css(
                    "background-image",
                    `url("${e.target.result}")`
                );
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#btn_profile_edit').on('click', function (e) {
            $('#profile_edit').click();
        });
    }

    function profileImageAdd() {
        $("#profile_add").on("change", function(e) {
            let reader = new FileReader();
            reader.onload = e => {
                $("#profile_bg_image_add").css(
                    "background-image",
                    `url("${e.target.result}")`
                );
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#btn_profile_add').on('click', function (e) {
            $('#profile_add').click();
        });
    }

    $('.user_edit').on('click', function (e) {
        const id = $(this).attr('data-id');
        const userEdit = $(this);
        userEdit.addClass('d-none');
        $(`#spinner_${id}`).removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/admin/user/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#user_edit_modal').html(data);
                $('#form_edit_user').modal('show');
                userEdit.removeClass('d-none');
                $(`#spinner_${id}`).addClass('d-none');
                getUnitByDepartment();
                getGroupByUnit();
                profileImageEdit();
            }
        });
    });

    $('.user_password').on('click', function (e) {
        const id = $(this).attr('data-id');
        const userEdit = $(this);
        userEdit.addClass('d-none');
        $(`#spinner_${id}`).removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/admin/user/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#user_password_modal').html(data);
                $('#form_edit_user').modal('show');
                userEdit.removeClass('d-none');
                $(`#spinner_${id}`).addClass('d-none');
            }
        });
    });

    $('.department_edit').on('click', function (e) {
        const id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `/admin/department/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#department_edit_modal').html(data);
                $('#form_edit_department').modal('show');
            }
        });
    });

    $('.unit_edit').on('click', function (e) {
        const id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `/admin/unit/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#unit_edit_modal').html(data);
                $('#form_edit_unit').modal('show');
            }
        });
    });

    $('.group_edit').on('click', function (e) {
        const id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `/admin/group/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#group_edit_modal').html(data);
                $('#form_edit_group').modal('show');
            }
        });
    });

    $('.position_edit').on('click', function (e) {
        const id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `/admin/position/edit/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#position_edit_modal').html(data);
                $('#form_edit_position').modal('show');
            }
        });
    });

    $('.view_user_detail').on('click', function (e) {
        const id = $(this).attr('data-id');
        const detail = $(this);
        detail.addClass('d-none');
        $(`#avatar_spinner_${id}`).removeClass('d-none');
        $.ajax({
            type: "GET",
            url: `/admin/user/detail/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#user_detail_dialog').html(data);
                $('#form_user_detail').modal('show');
                detail.removeClass('d-none');
                $(`#avatar_spinner_${id}`).addClass('d-none');
            }
        });
    });

    $('#leave_urgent').on('click', function (e) {
        const type = $(this).attr('data-type');
        $.ajax({
            type: "GET",
            url: `/admin/attendance/leave/${type}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#leave_dialog').html(data);
                $(`#form_${type}_leave`).modal('show');
            }
        });
    });

    $('#leave_plan').on('click', function (e) {
        const type = $(this).attr('data-type');
        $.ajax({
            type: "GET",
            url: `/admin/attendance/leave/${type}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#leave_dialog').html(data);
                $(`#form_${type}_leave`).modal('show');
            }
        });
    });

    $('#status_filter').on('change', function (e) {
        const status = $(this).val();
        $.ajax({
            type: "GET",
            url: `/admin/attendance/sort/leave/${status}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#leave_table').html(data);
            }
        });
    });

    $('.filter-fields').on('change', function(e) {
        let url = '/admin/staff/filter';

        $('.filter-fields').each(function(index, element) {
            url += `/${element.value}`;
        })

        $.ajax({
            type: "POST",
            url,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#staff_wrapper').html(data);
            }
        });
    });

    $('#filter_department').on('change', function(e) {
        const value = $(this).val();

        $.ajax({
            type: 'GET',
            url: `/admin/get-unit-by-department/${value}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data) {
                    const { units } = data;
                    $('#filter_unit').removeAttr('disabled');
                    let output = '<option value="0">Unit</option>';
                    if (units)
                        $.each(units, function(key, value) {
                            output += `<option value="${value.id}">${value.name}</option>`
                        });
                    $('#filter_unit').html(output);
                }
            }
        });
    });

    $('#filter_unit').on('change', function(e) {
        const value = $(this).val();

        $.ajax({
            type: 'GET',
            url: `/admin/get-group-by-unit/${value}`,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data) {
                    const { groups } = data;
                    $('#filter_group').removeAttr('disabled');
                    let output = '<option value="0">Group</option>';
                    if (groups)
                        $.each(groups, function(key, value) {
                            output += `<option value="${value.id}">${value.name}</option>`
                        });
                    $('#filter_group').html(output);
                }
            }
        });
    });

    $('#search_staff').on("input", function() {
        const value = this.value;
        let formData = new FormData();
        formData.append('search', value);
        $.ajax({
            type: "POST",
            url: "/admin/staff/search",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                $('#staff_wrapper').html(data);
            }
        });
    });

    $('.btn_hr_note').on('click', function() {
        $('#form_hr_note').modal('show');
    });

    $('.btn_work').on('click', function() {
        $($(this).attr('data-id')).removeClass('d-none');
    });

    // $('#first_app_comment').on('click', function (e) {
    //     const comment = $('#comment').val();
    //     if (!comment) $('#comment_message').text('Please insert comment!');
    // });

    // $('#second_app_comment').on('click', function (e) {
    //     const comment = $('#comment').val();
    //     if (!comment) $('#comment_message').text('Please insert comment!');
    // });

    // $('#disapproved').on('click', function (e) {
    //     const comment = $('#comment').val();
    //     if (!comment) {
    //         $('#comment_message').text('Please insert comment!');
    //         return false;
    //     }
    //     const id = $('#leave_id').val();
    //     const data = new FormData();
    //     data.append('comment', comment);
    //     $.ajax({
    //         type: "POST",
    //         url: `/admin/attendance/approval/0/${id}`,
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         data,
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     });
    // });

    profileImageAdd();
    getUnitByDepartment();
    getGroupByUnit();
});

if (document.getElementById("side-header") && document.getElementById("side-header").length > 0) {
    const stringVal = document.getElementById("side-header").innerHTML;
    const newString = stringVal
        .replace(/([A-Z]+)/g, " $1")
        .replace(/([A-Z][a-z])/g, " $1");
    document.getElementById("side-header").innerHTML = newString;
}

// const btnProfileEdit = document.getElementById("btn_profile_edit");
// const inpProfileEdit = document.getElementById("profile_edit");

// if (btnProfileEdit)
//     btnProfileEdit.addEventListener("click", () => {
//         inpProfileEdit.click();
//     });

const btnImgsUpload = document.getElementById("btn_upload_images");
const inpImgsUpload = document.getElementById("upload_images");

if (btnImgsUpload)
    btnImgsUpload.addEventListener("click", () => {
        inpImgsUpload.click();
    });

const btnCateImg = document.getElementById("btn_category_image");
const inpCateImg = document.getElementById("category_image");
const asdsad = document.getElementById('asdsad');

if (btnCateImg)
    btnCateImg.addEventListener("click", () => {
        inpCateImg.click();
    });

const footerYear = document.getElementById('cpyr_year');
if (footerYear) {
    const current_date = new Date()
    const cmm = current_date.getFullYear()
    footerYear.innerText = cmm;
}
