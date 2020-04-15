@if(isset($results))
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="col-sm-12 company-info">

        <div class="col-sm-12 text-center">
            <h3 class="text-center">Company Name</h3>
            <p><label>Address :</label> Ekantakuna,Lalitpur</p>
        </div>
        <div class="report-block col-sm-12 text-right">02/04/2017</div>
    </div>
    <table>
        <tr>
            @foreach($fields as $column)
                <th>{{$form_helper->getLabelByName($column)}}</th>
            @endforeach
        </tr>
        @foreach($results as $row)
            <tr>
                @foreach($fields as $column)
                    <td> {{$row->$column}}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endif
