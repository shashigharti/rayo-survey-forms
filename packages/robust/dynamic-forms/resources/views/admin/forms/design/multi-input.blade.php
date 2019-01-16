@set('questions', !empty($properties->questions)?$properties->questions:[])
@set('targets', !empty($properties->targets)?$properties->targets:[])

<div class="row dynamic-form__multiple-input">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }} ">
            <label>{{$field->label}}(Multiple Input Question)</label>
            <table class="multiple-input__sub-questions">
                <tr><th> Questions </th><th>Value</th></tr>
                @foreach($questions as $key => $question)
                    <tr>
                        <td class="multiple-input__heading">
                            @if(isset($targets[$key]))
                                {{$question . (($targets[$key] == '')?'':"(Target: $targets[$key])")}}
                            @endif
                        </td>
                        <td>
                            <input type="text" name="{{$key}}"  disabled>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>