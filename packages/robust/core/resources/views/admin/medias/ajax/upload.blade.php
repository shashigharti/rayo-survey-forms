<div class="uploading_div">
    <img src="{{ asset('assets/images/uploading.gif') }}" alt="" width="150">
</div>
<div class="media-upload_form">
    {{ Form::open(['route' => 'admin.medias.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class'=> 'modal-media_upload_form']) }}
    <div class="media-text">
        <h4>Drag image here</h4>
        <h5>(or Click to browse)</h5>
    </div>
    <input type="file" class='modal-file_upload_area' name="media[]" id="modal-file_upload" multiple="true">
    <div class="uploaded-image-block">

    </div>
    {{ Form::close() }}
</div>