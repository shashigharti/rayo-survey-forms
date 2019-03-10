<div class='element__section'>
    <button class="btn " data-target="#section__modal" data-toggle="modal"
            type="button">Add  New  Section
    </button>
    <!-- Modal -->
    <div class="modal fade section-select_modal" id="section__modal" aria-hidden="true" aria-labelledby="sectionModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="">
                        @include('reports::admin.reports.design.partials.sections')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-save theme-btn" data-dismiss="modal">Select</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>