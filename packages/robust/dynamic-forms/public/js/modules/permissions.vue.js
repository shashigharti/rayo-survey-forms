;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Forms.Permission = {
        init: function () {
            new window.Vue({
                el: '#form_permission',
                components: {vSelect},
                data () {
                    return {
                        base_url: $(':input[name="base_url"]').val(),
                        selected_roles: [],
                        selected_users: [],
                        available_roles: [],
                        available_users: [],
                        form: {
                            id: $(':input[name="form_id"]').val(),
                            roles: [],
                            users: []
                        }
                    }
                },
                mounted: function () {
                    $.ajax({
                        url: this.base_url + '/api/roles'
                    }).done(response => {
                        let $this = this;
                        let $data = JSON.parse(response);
                        let $selected_roles = JSON.parse($(':input[name="roles"]').val());
                        this.available_roles = $data.map(function (role) {
                            if ($selected_roles.indexOf(role.id) >= 0) {
                                $this.selected_roles.push({value: role.id, label: role.name});
                            }
                            return {value: role.id, label: role.name};
                        });
                    });
                    $.ajax({
                        url: this.base_url + '/api/users'
                    }).done(response => {
                        let $this = this;
                        let $selected_users = JSON.parse($(':input[name="users"]').val());
                        this.available_users = response.data.map(function (user) {
                            if ($selected_users.indexOf(user.id) >= 0) {
                                $this.selected_users.push({value: user.id, label: user.first_name + user.last_name});
                            }
                            return {value: user.id, label: user.first_name + user.last_name};
                        });
                    });
                },
                methods: {
                    submit: function () {
                        $.ajax({
                            method: 'POST',
                            url: this.base_url + '/api/forms/' + this.form.id + '/permissions',
                            data: this.form
                        }).done(response => {

                        });
                    }
                },
                watch: {
                    selected_roles: function () {
                        let $this = this;
                        $this.form.roles = [];
                        this.selected_roles.forEach(function(role){
                            $this.form.roles.push(role.value);
                        });

                        this.submit();
                    },
                    selected_users: function () {
                        let $this = this;
                        $this.form.users = [];
                        this.selected_users.forEach(function(user){
                            $this.form.users.push(user.value);
                        });
                        this.submit();
                    }
                }
            });
        }
    };
    $(document).ready(function ($) {
        if ($('#form_permission').length > 0) {
            FRW.Forms.Permission.init();
        }
    });

}(jQuery, FRW, window, document));