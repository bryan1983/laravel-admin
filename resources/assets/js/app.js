;
$(function () {
    /** Datatables **/
    if ( ! $.fn.DataTable.isDataTable( '.dataTable' ) ) {
        $('.dataTable').dataTable({
            language: {
                "url": GLOBALS.datablesLang
            }
        });
    }
    /** select bootstrap **/
    $('.selectBootstrap').selectpicker();
    /** SlugAble **/
    if ($('.slugable').length > 0) {
        var $target = $('.slugable').find('.slug-target');
        var $source = $('.slugable').find('.slug-source');
        $target.slugify($source);
    }
    /** Permissions modal **/
    $(document).on('click', '[data-action="AssignPermission"]', function () {
        var $this = $(this);
        /** get the permissions Model **/
        $.ajax({
            url: GLOBALS.site_url+'/'+GLOBALS.prefix+'/roles/permissions/get',
            type: 'GET',
            dataType: 'json',
            data: {
                type: $this.data('type'),
                model: $this.data('model')
            },
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (json) {
                $('#Modeltype').val($this.data('type'));
                $('#Modelid').val($this.data('model'));
                $.each(json, function (index, obj) {
                    $('#permissionsSelect').append(new Option(obj.display_name, obj.id, true, false));
                });
                $('#permissionsSelect').selectpicker();
                $('#AssignPermissionsForm').attr('action', $this.data('url'));
                $('#permissionsAddModal').modal('show');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    });
    
    $(".wysihtml5").wysihtml5();
    $(".datepicker").datepicker();

    /** delete dialog **/
    $(document).on('click', '.confirm-delete', function (e) {
        e.preventDefault();
        var $this = $(this);
        swal({
                title: window.la_lang.alertDelete,
                text: window.la_lang.alertDeleteText,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: window.la_lang.alertDeleteConfirm,
                cancelButtonText: window.la_lang.alertDeleteCancel,
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $('#deleteForm').attr('action', $this.attr('href')).submit();
                }
            });
    });
});