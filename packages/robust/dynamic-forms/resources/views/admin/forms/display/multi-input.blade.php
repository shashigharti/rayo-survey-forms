@set('properties', isset($form_field->properties)?json_decode($form_field->properties):[])
@set('questions', !empty($properties->questions)?$properties->questions:[])
@set('targets', !empty($properties->targets)?$properties->targets:[])

<div class="row dynamic-form__multi-question">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group control-required">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            <table class="multiple-questions__sub-questions">
                @foreach($questions as $key => $question)
                    <tr>
                        <td class="multi-question__heading">
                            @if(isset($targets[$key]))
                                {{$question . (($targets[$key] == '')?'':"(Target: $targets[$key])")}}
                            @else
                                {{$question}}
                            @endif
                        </td>
                        <td>
                            <input type="text" name="{{$form_field->name}}[{{$key}}]" value=" {{isset($model[$form_field->name][$key])? $model[$form_field->name][$key]:''}}">
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>