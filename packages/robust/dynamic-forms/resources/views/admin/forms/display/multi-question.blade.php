@set('properties', isset($form_field->properties)?json_decode($form_field->properties):[])
@set('questions', !empty($properties->questions)?$properties->questions:[])
@set('targets', !empty($properties->targets)?$properties->targets:[])

<div class="row dynamic-form__multi-question">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group control-required">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            <table class="multiple-questions__sub-questions">
                <tr>
                    <th class="multi-question__heading">Questions</th>
                    @if(isset($properties->options))
                        @set('options', explode(",", $properties->options))
                        @foreach($options as $option)
                            <th>{{$option}}</th>
                        @endforeach
                    @endif
                </tr>
                @foreach($questions as $key=>$question)
                    <tr>
                        <td class="multi-question__heading">
                            @if(isset($targets[$key]))
                                {{$question . (($targets[$key] == '')?'':"(Target: $targets[$key])")}}
                            @else
                                {{$question}}
                            @endif
                        </td>
                        @foreach($options as $option)
                            <td>
                                <input type="radio"
                                       name="{{$form_field->name}}[{{$key}}]"
                                       value="{{$option}}"
                                        {{(isset($model[$form_field->name][$key]) && ($model[$form_field->name][$key] ==
                                 $option)) ? 'checked':''}}
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>