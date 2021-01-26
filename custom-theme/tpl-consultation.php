<?php
/*
 * E-mail list page in back-end menu
 */
?>

<div class="container-fluid">
    <h1>Consultation Popup</h1>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">Consultation Popup Content</a></li>
        <li><a data-toggle="tab" href="#menu2">List of Emails</a></li>
    </ul>

    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
            <div class="panel panel-info">
                <div class="panel-body">
                    <fieldset>
                        <form method="post" id="consultation_popup_form1" action=""  class="form-horizontal">
                            <div class="">
                                <!--<div class="form-group">
                                    <label class="control-label col-sm-3">Heading Text</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="consultation_heading_text"  pattern="{1,25}" required="" class="form-control" id="consultation_heading_text" value="<?php echo get_option('consultation_heading_text');?>" >
                                    </div>
                                </div>   -->                             
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Show Consultation Popup </label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="show_consultation_popup"  pattern="{1,25}" class="form-control" id="show_consultation_popup" <?php if(get_option('show_consultation_popup') == 1){echo 'checked';} ?>>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                      <button type="submit" name="updatepopupdata" class="btn btn-primary">Update Content</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                    <div class="alert message-form" style="display:none"></div>
                </div>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <div class="panel panel-info">
                <div class="panel-body">
                    <h3>List of Emails</h3> 
                    <hr/>        
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <table id="consultation_email_list" class="display email_datatable table table-bordered table-condensed" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>E-mail Address</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>    
</div>

<style type="text/css">
    .form-control {margin: 7px auto;width: 100%;}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {vertical-align: middle;}
    th.sorting_disabled {width: 80px !important;text-align: center;}
    table.dataTable tbody th, table.dataTable tbody td {padding: 0px 10px;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: #fff;background-color: #3379b7;border: 1px solid #3379b7;font-weight: 600;}
    .nav-tabs {border-bottom: 1px solid #3379b7;}
    .panel-info {border-color: #3379b7;}
</style>

<script type="text/javascript">
    jQuery(document).ready(function() {
        //data: {action:'consultation_popup_data',consultation_heading:consultation_heading_text, consultation_popup:show_consultation_popup},
        jQuery("#consultation_popup_form1").validate({
            // rules: {
            //     consultation_heading_text: {
            //         required: true
            //     }
            // },
            // messages: {
            //     consultation_heading_text: {
            //         required: "This field is required."
            //     },
            // },
            submitHandler: function () {
                // var consultation_heading_text = jQuery('#consultation_heading_text').val();
                var show_consultation_popup = 0;
                if(jQuery('#show_consultation_popup').is(":checked")){
                    show_consultation_popup = 1;
                }
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {action:'consultation_popup_data',consultation_popup:show_consultation_popup},
                    success: function (response) {
                        var json = eval("(" + response + ")");
                        if (json.status == "success") {
                            datatable.clear().draw();
                            datatable.columns.adjust().draw();
                            jQuery('.message-form').html("<div class='alert alert-success'>Data Updated Successfully</div>");
                            jQuery('.message-form').show();
                            setTimeout(function () {
                                jQuery('.message-form').html();
                                jQuery('.message-form').fadeOut();
                            }, 10000);
                        } else {
                            jQuery('.message-form').html("<div class='alert alert-danger' style='color:red;'>Error  Found !</div>");
                            jQuery('.message-form').show();
                            setTimeout(function () {
                                jQuery('.message-form').html();
                                jQuery('.message-form').fadeOut();
                            }, 10000);
                        }
                    }
                });
            }
        });
        var datatable = jQuery('#consultation_email_list').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": ajaxurl + "?action=get_all_consultation_email_list",
                "type": "POST"
            },
            "order": [[ 1, "asc" ]],
            "columns": [
                {
                    "data": "id",
                    render: function (data, type, row) {
                        return data;
                    },
                    "targets": 0,
                    "orderable": false
                },
                {
                    "data": "name",
                    render: function (data, type, row) {
                        return '<input type="text" id="consultation_name_field" class="form-control" value="' + data + '">';
                    }
                },
                {
                    "data": "number",
                    render: function (data, type, row) {
                        return '<span id="consultation_number_field" >' + data + '<span>';
                    }
                },
                {
                    "data": "mail",
                    render: function (data, type, row) {
                        return '<input type="text" id="consultation_email_field" class="form-control" value="' + data + '">';
                    }
                },
                {
                    "data": "update",
                    "render": function (data, type, row) {
                        return '<a href="javascript:void(0)" class="btn btn-success btn-sm" id="update_consultation_data" data-email_id="' + data + '">Update</a>';
                    },
                    "targets": 0,
                    "orderable": false
                },
                {
                    "data": "delete",
                    "render": function (data, type, row) {
                        return '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="delete_consultation_data" data-email_id="' + data + '">Delete</a>';
                    },
                    "targets": 0,
                    "orderable": false
                },
            ] 
        });

        jQuery('body').on('click', '#delete_consultation_data', function () {
            var email_id = jQuery(this).data('email_id');
            var email = jQuery(this).parents('tr').find('td input#consultation_email_field').val();
            var name = jQuery(this).parents('tr').find('td input#consultation_name_field').val();
            var number = jQuery(this).parents('tr').find('td span#consultation_number_field').text();
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {action:'delete_consultation_email_data', id:email_id, email:email, name:name, number:number },
                success: function (response) {
                    datatable.clear().draw();
                    datatable.columns.adjust().draw();
                }
            });
        });
        jQuery('body').on('click', '#update_consultation_data', function () {
            var email_id = jQuery(this).data('email_id');
            var email = jQuery(this).parents('tr').find('td input#consultation_email_field').val();
            var name = jQuery(this).parents('tr').find('td input#consultation_name_field').val();
            var number = jQuery(this).parents('tr').find('td span#consultation_number_field').text();
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {action:'update_consultation_email_data', id:email_id, email:email, name:name, number:number },
                success: function (response) {
                    datatable.clear().draw();
                    datatable.columns.adjust().draw();
                }
            });
        });
    });   
</script>