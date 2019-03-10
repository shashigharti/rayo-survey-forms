;
(function ($, FRW, window, document, undefined) {
    'use strict';

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Reports.DesignerContainer = {

        startup: true,
        init: function (obj) {
            $(document).on('click', '.report__elem, .report__section', FRW.Reports.DesignerContainer.selectElement);
            $(document).on('click', '[data-action="del-el"]', FRW.Reports.DesignerContainer.delete);
            $(document).on('submit', '.element__image-editor form', FRW.Reports.DesignerContainer.uploadImage);
            $(document).on('click', '.section-select_modal .btn-save', function(){
                var $this = $('.designer__container');
                var $url = $this.data('add-url');
                var $type = $('input[name="sections"]:checked').val();  

                $.ajax({
                    method: "POST",
                    url: $url,
                    data: {type: $type},
                    success: function ($result) {
                        $this.append($result.ui_view);
                        FRW.Reports.Droppable.init();                      
                        
                        FRW.Reports.DesignerContainer.updateTemplate();                        
                    }
                });
            });           

            

            $('body').on('click', '.element__image-editor .btn-save', function () {                
                $('.element__image-editor form').submit();
                FRW.Reports.DesignerContainer.updateTemplate();
            });

            $('.element__image-editor').on('show.bs.modal', function () {
                $( ".element__image-editor input[type='file']").remove();
                $( ".element__image-editor img").remove();
                
                $( ".ui-selected .elem__image input[type='file']" ).clone().appendTo( ".element__image-editor form" );
                $( ".ui-selected .elem__image img" ).clone().appendTo( ".element__image-editor .image-editor__container" );

                FRW.Cropper.init($('.element__image-editor img'));                
            });
            
            //Track mouse hover for droppable div
            $('.designer__droppable')
                .mouseout(function () {
                    $(this).removeClass('ui-droppable-selected');
                })
                .mouseover(function (e) {
                    $(this).parents().removeClass('ui-droppable-selected');
                    $(this).addClass('ui-droppable-selected');
                    e.stopPropagation();
                });

            $(document).on('change', '.ui-selected .elem__editor td', function(){
                FRW.Reports.DesignerContainer.updateTemplate();
            });
            $(document).on('select', '.report__elem', function(){
                $('.ui-selected .elem__editor td').summernote('destroy');
                FRW.Reports.SummerNoteEditor.init('.ui-selected .elem__editor td');
            });
            FRW.Reports.DesignerContainer.addPlaceholder();

        },
        onDrop: function (event, ui) {
            var $url = $('.designer__container').data('add-url');
            var $type = ui.draggable.data('type');
            var $this = $(this);

            $.ajax({
                method: "POST",
                url: $url,
                data: {type: $type},
                success: function ($result) {
                    $this.find('.help-message').remove();
                    $this.append($result.ui_view);
                    FRW.Reports.DesignerContainer.updateTemplate();

                    if ($type == 'editor') {
                        FRW.Reports.SummerNoteEditor.init('.ui-selected .elem__editor td');
                    }else{
                        FRW.Reports.DesignerContainer.addPlaceholder();
                    }
                }
            });
        },
        updateTemplate: function () {
            var url = $('.designer__container').data('update-url');
            $('.ui-selected .elem__editor td').summernote('destroy');
            
            var $html = '';
            var $template = $('.designer__container').html();
            var $html = $('.designer__container').clone();
            $html.find('.elem__image form, .designer__tools, input').remove();
            $html.find('div').children().unwrap();
            
            $.ajax({
                method: "POST",
                url: url,
                data: {template: $template, html: $html.html()}
            });
            
        },
        delete: function () {
            $(this).closest('.report__elem, .report__section').first().remove();
            FRW.Reports.DesignerContainer.updateTemplate();
        },
        selectElement: function (e) {
            e.stopPropagation();
            
            if( $(this).hasClass('ui-selected')){
                return;
            }
            
            $('.report-designer .ui-selected').trigger('blur');
            $('.report-designer .ui-selected').removeClass('ui-selected');
            
            $(this).addClass('ui-selected');
            $(this).trigger('select');
            
            if($(this).hasClass('report__section')){
                FRW.Reports.DesignerContainer.displayControlBox($(this));
            }else{
                FRW.Reports.DesignerContainer.displayPropertyBox($(this));
            }
        },
        uploadImage: function (event) {
            event.stopPropagation();
            event.preventDefault();

            var data = new FormData(this);
            $.ajax({
                url: this.action,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (result) {
                    $('.ui-selected .img-crop').attr('src', result.file_name);
                    FRW.Reports.DesignerContainer.updateTemplate();
                }
            });
        },
        displayPropertyBox: function ($obj) {           
            
            var url = $('.ui-selected').data('property-url');
            var $type = $('.ui-selected').data('type');
            $.ajax({
                url: url,
                success: function(result){
                    $('.report-designer .left-box').empty().append(result.ui_view);
                }
            });

        },
        displayControlBox: function ($obj) {
            
            var url = $('.designer__container').data('controlbox-url');
            $.ajax({
                url: url,
                success: function(result){
                    $('.report-designer .left-box').empty().append(result.ui_view);
                    FRW.Reports.UIControlBoxElement.init();
                }
            });
        },
        addPlaceholder:function(){
            if ($(".elem__image img[src='']")) {
                $(".elem__image img[src='']").each(function () {
                    var $container = $($(this).data('container'));
                    var $width = $container.width();
                    $(this).attr("src", "http://placehold.it/" + $width + "X150");
                });
            }
        }
    }

    FRW.Reports.UIControlBoxElement = {
        init: function () {
            this.obj = $(".designer__draggable li");
            this.id = this.obj.data("id");
            this.type = this.obj.data("type");
            this.title = this.type + "-" + this.id;
            this.properties = {};
            this.obj.draggable({
                helper: "clone",
                connectWith: '.designer__droppable',
                opacity: 0.5,
                zIndex: 10
            });
        }
    };
    FRW.Reports.Droppable =  {
        init:function(){
            $('.designer__droppable').droppable({
                tolerance: 'pointer',
                greedy: true,
                drop: FRW.Reports.DesignerContainer.onDrop
            });
        }
        
    }

    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.Reports.UIControlBoxElement.init();
        FRW.Reports.DesignerContainer.init();
        FRW.Reports.Droppable.init();
    });

}(jQuery, FRW, window, document));