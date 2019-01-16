<div class="dynamic-form__control-box panel-box design-list">
    <div class="col-md-12">
        <h5>Basic Fields</h5>
    </div>
    <div class="col-md-6">
        <ul class="list-group list-group-gap dynamic-form__control-box dynamic-form__draggable">
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="text">
                <i class="fa fa-question"></i> Short Question
            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="checkbox">

                <i class="fa fa-check-square"></i> Multi Select

            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="radio"
            >
                <i class="fa fa-dot-circle-o"></i> Radio Button
            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="textarea"
            >
                <i class="fa fa-file-text-o"></i> Paragraph
            </li>
        </ul>
    </div>

    <div class="col-md-6">
        <ul class="list-group list-group-gap dynamic-form__control-box dynamic-form__draggable">
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="select"
            >
                <i class="fa fa-tasks"></i> Dropdown

            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="file"
            >
                <i class="fa fa-file-text-o" aria-hidden="true"></i></i> File

            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="editor"
            >
                <i class="fa fa-italic" aria-hidden="true"></i> Description

            </li>

        </ul>
    </div>

    <div class="col-md-12">
        <h5>Advanced Fields</h5>
    </div>
    <div class="col-md-6">
        <ul class="list-group list-group-gap dynamic-form__control-box dynamic-form__draggable">
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="email">
                <i class="fa fa-envelope-o"></i> Email
            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="number">
                <i class="fa fa-list-ol"></i> Number
            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="multi-question">

                <i class="fa fa-table"></i> Multiple Question
            </li>
        </ul>
    </div>

    <div class="col-md-6">
        <ul class="list-group list-group-gap dynamic-form__control-box dynamic-form__draggable">
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="date">
                <i class="fa fa-calendar"></i> Date
            </li>

            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="address">

                <i class="fa fa-map-marker"></i> Address
            </li>
            <li class="list-group-item btn-grey"
                data-url="{{ route('admin.forms.fields.store',['form_id' => $form->id]) }}"
                data-type="multi-input">

                <i class="fa fa-th"></i> Multiple Input
            </li>

        </ul>

    </div>
</div>