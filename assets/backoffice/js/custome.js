// --------------------------- jquery validate ---------------------------  
    // $.validator.addMethod('filesize', function(value, element, param) {
    //     return this.optional(element) || (element.files[0].size <= param) 
    // });
// --------------------------- end jquery validate ---------------------------


// --------------------------- delete data multiple ---------------------------
    $('#delete-data-multiple').on('click', function() {
        $('#modal-delete').modal('show');
    });

    $(document).on("change", ".check-record", function() {
        create_url_delete();
    });

    $('input[name=check-all-record]').change(function() {
        var check_all = false;
        if ($(this).is(':checked')) {
            check_all = true;
        }

        $('#table-data > tbody > tr > td > label > input[name=check-record]').each(function() {
            $(this).prop('checked', check_all);
        });

        create_url_delete();
    });

    $('#table-data > tbody').bind("DOMSubtreeModified", function() {
        var checkall = $('#table-data > thead').children().find('input[name=check-all-record]');
        if (checkall.is(':checked')) {
            checkall.prop('checked', false);
        }
    });


    function create_url_delete() {
        var checkbox_checked = [];
        $('#table-data > tbody > tr > td > label > input[name=check-record]').each(function() {
            if ($(this).is(':checked')) {
                checkbox_checked.push($(this).val());
            }
        });
        var id_str = (JSON.stringify(checkbox_checked));

        if (checkbox_checked.length > 0) {
            $('#delete-data-multiple').removeClass('invisible');
            $('#id3').val(id_str);
            $('#method').val('multiple');
        } else {
            $('#delete-data-multiple').addClass('invisible', true);
            $('#id3').val(id_str);
            $('#method').val('multiple');
        }
    }
// --------------------------- end delete data multiple ---------------------------


    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })

        $('.image-magnific-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: true,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom',
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 400
            }
        });
            
        
        if ($(".select2").length) {
            $(".select2").select2();
        }

        if ($(".select2-multiple").length) {
            $(".select2-multiple").select2();
        }

        $('.dropify').dropify({
            messages: {
                'default': 'Drag dan drop file disini atau Klik',
                'replace': 'Drag and drop atau Klik untuk Mengganti',
                'remove':  'Hapus',
                'error':   'Ooops, sesuatu yang salah terjadi.'
            },
            error: {
                'fileFormat': 'Masukkan format File VIDEO (mp4 mpg mpeg mov avi flv wmv).'
            }
        });
    });


// loading button
$.fn.buttonLoader = function(action) {
    var self = $(this);

    if (action == 'start') {
        if ($(self).attr("disabled") == "disabled") {
            e.preventDefault();
        }
        $('.has-spinner').attr("disabled", "disabled");
        $(self).attr('data-btn-text', $(self).text());
        $(self).html('<span class="spinner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &nbsp;Loading</span>');
        $(self).addClass('active');
    }

    if (action == 'stop') {
        $(self).html($(self).attr('data-btn-text'));
        $(self).removeClass('active');
        $('.has-spinner').removeAttr("disabled");
    }
}