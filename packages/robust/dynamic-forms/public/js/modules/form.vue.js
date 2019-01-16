;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Forms.Create = {
        init: function () {
            new window.Vue({
                el: '#form_create',
                components: {vSelect},
                data () {
                    return {
                        projects: [],
                        base_url: $(':input[name="base_url"]').val(),
                        selected_project: null,
                        current_project: null,
                        slug: $(':input[name="slug"]').data('value'),
                        title: $(':input[name="title"]').data('value'),
                    }
                },
                methods: {
                    slugify: function () {
                        if (!(this.title == null)) {
                            this.slug = this.title.toString().toLowerCase()
                                .replace(/\s+/g, '-')           // Replace spaces with -
                                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                                .replace(/^-+/, '')             // Trim - from start of text
                                .replace(/-+$/, '');            // Trim - from end of text
                        }

                    }
                },
                mounted: function () {
                    $.ajax({
                        url: this.base_url + '/api/projects'
                    }).done(response => {
                        let $this = this;
                        this.projects = response.view.map(function (data) {
                            return {value: data.id, label: data.name};
                        });
                        this.projects.forEach(function (project) {
                            if ($(':input[name="form_group_id"]').data('value') == project.value) {
                                $this.selected_project = project;
                            }
                        });
                    });
                },
                watch: {
                    selected_project: function () {
                        this.current_project = this.selected_project.value;
                    }
                }
            });
        }
    };
    $(document).ready(function ($) {
        if ($('#form_create').length > 0) {
            FRW.Forms.Create.init();
        }
    });

}(jQuery, FRW, window, document));