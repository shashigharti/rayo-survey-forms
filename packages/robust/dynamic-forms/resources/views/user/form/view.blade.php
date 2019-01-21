<div class="container form-container preview-page">
    @include("core::admin.partials.messages.info")
    <div class="panel-body panel-box dynamic__form-container form__wrapper default-form">
        <form id="dynamicForm">
            @csrf
            <div id="form__content--display">

            </div>
        </form>
    </div>
</div>
