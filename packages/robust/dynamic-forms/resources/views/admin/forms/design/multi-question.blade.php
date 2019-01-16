@set('questions', !empty($properties->questions)?$properties->questions:[])
@set('targets', !empty($properties->targets)?$properties->targets:[])

<div class="row dynamic-form__multi-question">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }} ">
            <label>{{$field->label}}(Multiple Question)</label>
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
                @foreach($questions as $key => $question)
                    <tr>
                        <td class="multi-question__heading">
                            @if(isset($targets[$key]))
                                {{$question . (($targets[$key] == '')?'':"(Target: $targets[$key])")}}
                            @endif
                        </td>
                        @foreach($options as $option)
                            <td>
                                <input type="radio" name="{{$key}}"
                                       value="{{$option}}"
                                       {{(isset($model[$field->id][$key]) && ($model[$field->id][$key] ==
                                $option)) ? 'checked':''}}
                                       disabled
                                >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>