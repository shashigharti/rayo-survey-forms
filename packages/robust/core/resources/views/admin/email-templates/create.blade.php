@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)

    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    {{ Form::hidden('user_id',Auth::user()->id) }}
        <div id="{{ $title }}" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    {{ Form::label('name', 'Name', ['class' => 'required' ]) }}
                    {{ Form::text('name', null, [
                            'placeholder' => 'Name i.e. \'KISAN\'',
                            'required'  => 'required'
                        ])
                    }}
                </div>
                <div class="input-field col s6">
                    {{ Form::label('type', 'Type', ['class' => 'required' ]) }}
                    {{ Form::text('type', null, [
                            'placeholder' => 'Type i.e. \'Lead Import\''
                        ])
                    }}
                </div>
            </div>
            <div class="row">
                @set('template', request()->query('template') ?? $model->template ?? '')
                <div class="input-field col s12">
                    {{ Form::select('template', [
                            '' => 'Select Template',
                            'new-user-registration' => 'New user Registration',

                        ],
                        $template,
                        [
                            'class' => 'select-reload-on-change',
                            'data-url-to-reload' => url()->current()
                        ])
                    }}
                    {{ Form::label('template', 'Select template to load', ['class' => 'required' ]) }}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    {{ Form::label('subject', 'Subject', ['class' => 'required' ]) }}
                    {{ Form::textarea('subject', null, [
                            'placeholder' => 'subject i.e. \'Your South Central Alaska Home Search\'',
                            'required'  => 'required'
                        ])
                    }}
                </div>
            </div>
            <div class="row editor">
                <div class="input-field col s12">
                    {{ Form::label('body', 'body', ['class' => 'required' ]) }}
                    {{ Form::textarea('body', !isset($model->template) &&  $template != '' ? view('core::admin.email-templates.partials.index',['template'=>$template]) : $model->body, [
                            'placeholder' => 'Email body',
                            'required'  => 'required',
                            'id' => 'editor__body',
                            'class' => 'editor'
                        ])
                    }}
                </div>
                <div class="col s12 editor__variables">
                    *|LEAD_FIRSTNAME|* | *|LOGO|* | *|WEBSITE|* | *|VERIFICATION_LINK|*
                </div>
            </div>

            <div class="row mt-3">
                <div class="col s12">
                   {{ Form::submit($ui->getSubmitText(), ['class' => 'waves-light theme-btn btn']) }}
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
