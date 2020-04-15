<div class="col s12 system-settings__general">
    {{ Form::open(['route' => ['admin.settings.store'], 'enctype' => 'multipart/form-data', 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
    ]) }}
    <div class="form-group form-material row">
        <div class="col s12 file-uploader" data-base-path="{{url('api/file-uploader/image/')}}"
            data-dest=".file-uploader_files"
            data-upload-path="{{route('api.file-uploader.image.upload')}}"
        >
            @csrf
            {{ Form::label('logo', 'Logo') }}
            @set('files', (isset($settings['logo']) && $settings['logo'] != '') ?  explode(',', $settings['logo']): [])
            <div class="file-uploader__preview">
                @foreach($files as $file)
                    <div data-id="{{ $file }}" class="file-uploader__file">
                        <img height="80" src="{{ getMedia($file) ?? '' }}"/>
                        <a  data-delete-path="{{url('file-uploader/image/' . $file)}}"
                            href="javascript:void(0)"
                            class="file-uploader__delete-btn"
                        >
                            <i class="material-icons"> delete </i>
                        </a>
                    </div>
                @endforeach
            </div>
            <div>
                <small>(Image Size: 200 x 200)</small>
            </div>
            <div>
                {{ Form::file('files[]', [
                        'class' =>'col s6 file-uploader__input',
                        'multiple' => 'multiple'
                    ])
                }}
                <button type="button"
                    class="btn cyan file-uploader__upload-btn"
                >
                    Upload Logo
                </button>
            </div>
            {{ Form::hidden('logo', $settings['logo'] ?? null, [
                    'class' => 'file-uploader_files'
                ])
            }}
        </div>
    </div>
    <div class="form-group form-material mt-3 row">
        <div class="col s12 input-field">
            {{ Form::label('company_name', 'Company Name', ['class' => 'control-label' ]) }}
            {{ Form::text('company_name', isset($settings['company_name'])?$settings['company_name']:'', [
                    'class' => 'form-control'
                ])
            }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col s6 input-field">
            {{ Form::label('contact_email', 'Contact Email', ['class' => 'control-label' ]) }}
            {{ Form::text('contact_email', isset($settings['contact_email'])?$settings['contact_email']:'', [
                    'class' => 'form-control'
                ])
            }}
        </div>
         <div class="col s6 input-field">
            {{ Form::label('phone_number', 'Phone Number', ['class' => 'control-label' ]) }}
            {{ Form::text('phone_number', isset($settings['phone_number'])?$settings['phone_number']:'', [
                    'class' => 'form-control'
                ])
            }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col s12 input-field">
            {{ Form::textarea('description', isset($settings['description'])?$settings['description']:'', [
                'class' => 'form-control'])
            }}
            {{ Form::label('description', 'Description', ['class' => 'control-label' ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col s12 input-field">
            {{ Form::textarea('address', isset($settings['address'])?$settings['address']:'', [
                    'class' => 'form-control'
                ])
            }}
             {{ Form::label('address', 'Address', ['class' => 'control-label' ]) }}
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <fieldset>
                <legend>FavIcons</legend>
                @set('count',isset($settings['icons']) ? count($settings['icons']) : 1)
                @for($i=0;$i < $count; $i++)
                    <div class="row dynamic-elem" data-key="{{ $i }}">
                        <div class="input-field col s3">
                            {{ Form::label("icons[$i][rel]", 'Rel') }}
                            {{ Form::text("icons[$i][rel]",$settings['icons'][$i]['rel']  ?? '' )}}
                        </div>
                        <div class="input-field col s3">
                            {{ Form::label("icons[$i][size]", 'Size') }}
                            {{ Form::text("icons[$i][size]",$settings['icons'][$i]['size']  ?? '') }}
                        </div>
                        {{ Form::hidden("icons[$i][href]",$settings['icons'][$i]['href']  ?? '', [
                                'class' => 'form-control icon_media-id'
                            ])
                        }}
                        <div class="input-field col s3">
                            <input type="file" name="files"  class="icon_file-uploader" data-url="{{route('api.file-uploader.image.upload')}}">
                        </div>
                        <a href="javascript:void(0)">
                            <i class="material-icons dynamic-elem__btn dynamic-elem__delete @if($i == 0) hide @endif">
                                delete
                            </i>
                        </a>
                        <a href="javascript:void(0)">
                            <i class="material-icons dynamic-elem__btn dynamic-elem__add">
                                add
                            </i>
                        </a>
                    </div>
                @endfor
            </fieldset>
        </div>
    </div>

    <div class="form-group form-material mt-1 row">
        <div class="col s12">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    </div>

    {{Form::close()}}
</div>
