@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)

    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div id="{{ $title }}" class="col s12">
        <div class="row">
            <div class="input-field col s6">
                {{ Form::label('title', 'Page Name', ['class' => 'required' ]) }}
                {{ Form::text('title', null, [
                        'placeholder' => 'Page Name i.e. \'KISAN\'',
                        'required'  => 'required',
                        'data-slug' => 'slug'
                    ])
                }}
            </div>
            <div class="input-field col s6">
                {{ Form::label('slug', 'Slug', ['class' => 'required' ]) }}
                {{ Form::text('slug', null, [
                        'placeholder' => 'Slug i.e. \'slug\''
                    ])
                }}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                {{ Form::label('url', 'URL', ['class' => 'required' ]) }}
                {{ Form::text('url', null, [
                        'placeholder' => 'URL i.e. \'homes-for-sale/cities/ponte-vedra-beach\'',
                        'required'  => 'required'
                    ])
                }}
            </div>
        </div>
        <div class="row editor">
            <div class="input-field col s12">
                {{ Form::label('content', 'Content', ['class' => 'required' ]) }}
                {{ Form::textarea('content', null, [
                        'placeholder' => 'Email body',
                        'required'  => 'required',
                        'id' => 'editor__body',
                        'class' => 'editor'
                    ])
                }}
            </div>
        </div>
        <fieldset class="mt-1">
            <legend>SEO</legend>

            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#metaTitle">Meta Title</a></li>
                        <li class="tab col s3 "><a href="#metaKeywords">Meta Keywords</a></li>
                        <li class="tab col s3"><a href="#metaDescription">Meta Description</a></li>
                    </ul>
                </div>
                <div id="metaTitle" class="col s12">
                    <div class="input-field col s12">
                        {{ Form::textarea('meta_title', null) }}
                    </div>
                </div>
                <div id="metaKeywords" class="col s12">
                    <div class="input-field col s12">
                        {{ Form::textarea('meta_keywords', null) }}
                    </div>
                </div>
                <div id="metaDescription" class="col s12">
                    <div class="input-field col s12">
                        {{ Form::textarea('meta_description', null) }}
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="input-field col s12">
                {{ Form::select('page_type', ['Select','page'=>'Page','seo'=>'Seo'], null, ['class' => 'form-control']) }}
                {{ Form::label('page_type', 'Type', ['class' => 'control-label required' ])  }}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col s12">
                {{ Form::submit($ui->getSubmitText(), ['class' => 'waves-light btn theme-btn']) }}
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
