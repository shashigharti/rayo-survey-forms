@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="dynamic-form design_page_form">
        <div id='builder'></div>
        {{--<div class="col-md-4 left-box">
            @include('dynamic-forms::admin.forms.partials.controlbox')
        </div>
        <div class="col-md-8 right-box panel-box">
            @include('dynamic-forms::admin.partials.pages-nav')
            <div class="tab-content dynamic-form__container">
                @foreach(range(1, $pages) as $key => $page)
                    <div id="page-{{$page}}" data-form-id="{{ $form->id }}"
                         data-form-save-url="{{ route('admin.forms.store') }}"
                         data-page-no="{{$page}}"
                         data-sort-url="{{route('admin.forms.fields.sort')}}"
                         class="tab-pane fade in dynamic-form__designer dynamic-form__droppable {{(session('current_page')) ? (session('current_page') == $key +1 ) ? 'active' : '' : ($key == 0 && !session('altered')) ?'active':(session('altered') && $key == sizeof(range(1,$pages))-1) ? 'active' :''}}">
                        @if(isset($form_fields[$page]))
                            @foreach($form_fields[$page] as $count => $page_form_field)
                                @set('field', (object) $page_form_field)
                                @include('dynamic-forms::admin.forms.partials.element',[
                                    'id' => $field->id,
                                    'count' => $count
                                    ])
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>--}}
    </div>
@endsection
