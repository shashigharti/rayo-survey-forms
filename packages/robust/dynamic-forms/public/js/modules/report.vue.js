;(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Form.AdvanceReport = {
        init: function () {
            new window.Vue({
                el: '#report__advance',
                components: {vSelect},
                data () {
                    return {
                        selected_form: null,
                        selected_project: null,
                        forms: [],
                        projects: [],
                        fields: [],
                        order_by: [],
                        all_fields: [],
                        form: [],
                        search_url: $('.report__advance').data('search-url'),
                        field: [],
                        field_url: $('.report__advance').data('field-url'),
                        base_url: $('.report__advance').data('base-url'),
                        search_data: {fields: '', order_by: '', conditions: []},
                        conditions: [],
                        condition_field: '',
                        condition_value: ''
                    }
                },
                methods: {
                    addNewCondition(){
                        this.conditions.push({
                            field: this.condition_field,
                            value: this.condition_value
                        });
                        this.condition_field = "";
                        this.condition_value = "";

                        this.search_data['conditions'] = JSON.stringify(this.conditions);
                    },
                    removeCondition(index){
                        this.conditions.splice(index, 1);
                    },
                    getConditionName(condition){
                        let $response = condition;
                        for (let i = 0; i < this.fields.length; i++) {
                            console.log(this.fields[i].value);
                            if (this.fields[i].value === condition) {
                                return this.fields[i].label;
                            }
                        }
                        return $response;
                    }
                },
                mounted: function () {
                    $.ajax({
                        url: this.base_url + '/api/projects'
                    }).done(response => {
                        this.projects = response.view.map(function (data) {
                            return {value: data.id, label: data.name};
                        });
                    });
                },
                watch: {
                    field: function () {
                        this.search_data['fields'] = this.field;
                    },
                    order_by: function () {
                        this.search_data['order_by'] = this.order_by.map(function (data) {
                            return data.value;
                        });
                    },
                    fields: function () {
                        this.all_fields = this.fields.map(function (data) {
                            return data.value;
                        });
                    },
                    selected_project: function () {
                        $.ajax({
                            url: this.base_url + '/api/projects/' + this.selected_project.value + '/forms'
                        }).done(response => {
                            this.forms = response.data.map(function (data) {
                                return {value: data.id, label: data.title};
                            });
                        });
                    },
                    selected_form: function () {
                        let $this = this;

                        $.ajax({
                            url: this.field_url,
                            data: {formId: this.selected_form}
                        }).done(data => {

                            let $data = data.data;
                            $data = $data.map(function (data) {
                                return {value: data.name, label: data.label};
                            });
                            this.fields = $data;

                        });

                    }
                }
            });
        }

    }
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        if ($('#report__advance').length > 0) {
            FRW.Form.AdvanceReport.init();
        }
    });

}(jQuery, FRW, window, document));
