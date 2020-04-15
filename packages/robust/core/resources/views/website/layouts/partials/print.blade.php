<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RealWebSystem</title>
    <style>
        @media print {
            body {
                margin:1rem;
                color: #000;
                background-color: #fff;
            }
            .header{
                padding-bottom: 10px;
                border-bottom: 1px solid #111;
                margin-bottom: 30px;
            }
            .header p{
                margin: 0px 0px;
            }
            h1{
                margin-top:0px;
                margin-bottom: 0px;
                font-size:24px;
            }
            label{
                font-weight: bold;
            }
            .s4{
                float: left;
                width: 31.11%;
                padding-right:10px;
            }
            .description{
                padding-top: 20px;
            }
            .description p{
                margin:40px 0px;
            }
            td{
                padding:6px;
            }

        }
    </style>
</head>
<body>
@inject('setting_helper','Robust\Core\Helpers\SettingsHelper')
@set('image',$result->images ? $result->images->first() : null)
@set('details',settings('data-mapping'))
@set('properties',$result->property->pluck('value','type'))
<div class="header">
    <h1>${{$result->system_price}} - {{$result->name}}</h1>
    <p>MLS#RX-{{$result->mls_number}}</p>
</div>
<div class="main-content">
    <img src="{{$image ? $image->url : ''}}" alt="" style="width: 100%">
    <div class="description">
        <div><label>${{$result->system_price}}</label></div>
        <div class="s4">
            Bedroom : {{$result->bedrooms}}
        </div>
        <div class="s4">
            Bathroom : {{$result->bathrooms}}
        </div>
        <div class="s4">
            {{$properties['total_square_feet'] ?? ''}}  sqft {{$properties['property_type'] ?? ''}}
        </div>
        <p>{{$properties['public_remarks'] ?? ''}}</p>
        @foreach($details as $title => $detail)
            <h4>{{$title}}</h4>
            <table border="1">
                @foreach($detail as $field)
                    @set('name',$field['name'])
                    @if(isset($properties[$name]))
                        <tr>
                            <td>{{$field['display']}}</td>
                            <td>{{$properties[$name]}}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @endforeach
    </div>
</div>
</body>
</html>
