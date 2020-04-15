<div class="modal fade" id="media-manager"
     data-media-path="{{ url('/') }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Media Manager</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                <li role="presentation" class="tab-media_upload" data-url="{{ route('admin.media.modal.upload') }}"
                        ><a class=""
                            href="javascript:void(0)"
                            aria-controls="media-upload"
                            role="tab" aria-expanded="false">Upload</a></li>

                <li class="active tab-media_manager" data-url="{{ route('admin.media.modal.type', 'image') }}"
                    data-media-path="{{ url('/') }}"><a data-toggle="tab"
                                                        href="javascript:void(0)"
                            >Images</a>
                </li>
            </ul>

            <div class="tab-content padding-top-10">
                <div class="tab-pane" class="media-upload" role="tabpanel">
                    <form class="dropzone" id="my-awesome-dropzone" method="POST">
                        <input type="file" name="file"/>
                    </form>
                </div>
            </div>
            <div class="modal-body clearfix">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn theme-btn" id="confirm">Apply</button>
            </div>
        </div>
    </div>
</div>