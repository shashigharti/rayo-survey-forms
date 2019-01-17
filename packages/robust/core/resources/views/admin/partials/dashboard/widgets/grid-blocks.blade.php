<?php
    $total_new_users  =Robust\Core\Helpers\DynamicFormHelper::totalNewUsers();
    $total_new_forms  =Robust\Core\Helpers\DynamicFormHelper::newFormCreated();
    $form_submitted  =Robust\Core\Helpers\DynamicFormHelper::formSubmitted();
?>
<div class="infobox infobox-green">
    <div class="infobox-icon">
        <i class="ace-icon fa fa-comments"></i>
    </div>

    <div class="infobox-data">
        <span class="infobox-data-number">{{ $form_submitted }}</span>
        <div class="infobox-content">Forms Submitted</div>
    </div>
    <div class="stat stat-success">8%</div>
</div>

<div class="infobox infobox-blue">
    <div class="infobox-icon">
        <i class="ace-icon fa fa-twitter"></i>
    </div>

    <div class="infobox-data">
        <span class="infobox-data-number">{{ $total_new_users  }}</span>

        <div class="infobox-content">New Users</div>
    </div>

    <div class="badge badge-success">
        +32%
        <i class="ace-icon fa fa-arrow-up"></i>
    </div>
</div>

<div class="infobox infobox-pink">
    <div class="infobox-icon">
        <i class="ace-icon fa fa-shopping-cart"></i>
    </div>

    <div class="infobox-data">
        <span class="infobox-data-number">{{ $total_new_forms }}</span>

        <div class="infobox-content">New Forms Created</div>
    </div>
    <div class="stat stat-important">4%</div>
</div>
