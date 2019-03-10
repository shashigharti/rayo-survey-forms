<div class='element__image-editor'>
    <!-- Modal -->
    <div class="modal fade" id="image-editor__modal" aria-hidden="true" aria-labelledby="imageEditorModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    {{Form::open(['route' => ['admin.reports.image.update'],
                        'enctype' => 'multipart/form-data'])}}
                    <div class="col-md-8 image-editor__container">
                    </div>
                    <div class="col-md-4">
                        <div class="report-designer__control-box panel-box">
                            <div class="col-md-4">
                                <div class="button__actions">
                                    <button><i class="fa fa-rotate-left"></i></button>
                                    <button><i class="fa fa-rotate-right"></i></button>
                                    <button><i class="fa fa-plus-circle"></i></button>
                                    <button><i class="fa fa-minus-circle"></i></button>
                                </div>
                                <div class="elem__image-dimensions">
                                    X:<input type="text" name="x">
                                    Y:<input type="text" name="y">
                                    Width:<input type="text" name="width">
                                    Height:<input type="text" name="height">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary theme-btn btn-save" data-dismiss="modal">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>