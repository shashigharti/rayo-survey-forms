<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description">
    <title>RealEstate</title>
    <style>
        html {
            font-family: 'Roboto', sans-serif !important;
            font-weight: normal;
            line-height: 1.5;
            color: #6b6f82;
        }
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="600" style="border:1px solid #111; margin:10px auto;">
    <tbody>
    <tr>
        <td style="text-align:center;padding:5px 5px 10px 5px;background-color:white;border-bottom:0px;">
            <img src="img/Logo.jpg" style="margin-top: 20px;max-height:200px;">
        </td>
    </tr>
    <tr>
        <td style="border: none; border-bottom: 1px solid lightgrey;background-color: #F9F9F9;">
            <p style="padding: 10px 20px;">
                <span style="font-size: 15px;">Hi </span>
            </p>
            <p style="padding: 5px 20px;">
                <br>  Your friend {{$member->first_name}} referred a listing to you from our website
                <br> {{$listing->name}}
                <br>Asking Price :  {{$listing->system_price}}
                <br/>
                <br>
            <p style="text-align:center;"> <a href="{{route('website.realestate.single',['slug' => $listing->slug])}}" style="margin-top: 12px;background:#1F7ABD;color:white;border:none;position:relative;height:90px;font-size:1.1em;font-weight: bolder;font-family: verdana;padding:10px 20px;cursor:pointer;border: 1;border-radius: 4px;outline:none;text-decoration:none;">View Details</a></p>
            <br/>

            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="padding: 20px 20px;"> Please let me know if you have questions about any of these homes or if you would like to schedule a showing. <br><br> <i>Rod Stone</i> <br> <a href="mailto:rod@rodstone.com">rod@rodstone.com</a>
            </p>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #315C85; padding: 10px 15px;">
            <p>
                <a style="text-align:center;text-decoration: none; font-family: verdana; color: white; font-weight: bold; font-size: 18px;" href="#">https://4alaskarealestate.com</a> <br> <br>
                <i style="color: white; font-family: verdana; font-size: 12px;background-color: #315C85">This message is intended for Vega Norma who registered on <a style="color:#1ba71b" href="{{env('APP_URL')}}">{{env('APP_NAME')}}</a> To stop these emails, <a style="color:#1ba71b" href="#">Click here</a>.</i>
            </p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
