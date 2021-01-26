<?php
/*
 * E-mail list page in back-end menu
 */
?>

<div class="container-fluid">
    <h1>Exit Popup</h1>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">Exit Popup Content</a></li>
        <li><a data-toggle="tab" href="#menu2">List of Emails</a></li>        
    </ul>

    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
            <div class="panel panel-info">
                <div class="panel-body">
                    <fieldset>
                        <form method="post"  id="exit_popup_form1" action=""  class="form-horizontal">
                            <div class="">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Heading Text</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading_text"  pattern="{1,25}" required="" class="form-control" id="heading_text" value="<?php echo get_option('exit_popup_heading_text');?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Regular Text</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="regular_text"  pattern="{1,25}" required="" class="form-control" id="regular_text" value="<?php echo get_option('exit_popup_regular_text');?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Text after image</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="text_after_free_gift"  pattern="{1,25}" required="" class="form-control" id="text_after_free_gift" value="<?php echo get_option('exit_popup_text_after_image');?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Text in input field</label>
                                    <div class="col-sm-9">
                                        <input type="text" name ="input_placeholder"  pattern="{1,25}" required="" class="form-control" id="input_placeholder"  value="<?php echo get_option('exit_popup_input_placeholder');?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Button Text</label>
                                    <div class="col-sm-9">
                                        <input type="text" name ="button_text"  pattern="{1,25}" required="" class="form-control" id="button_text"  value="<?php echo get_option('exit_popup_button_text');?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Show Exit Popup </label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="show_exit_popup"  pattern="{1,25}" class="form-control" id="show_exit_popup" <?php if(get_option('show_exit_popup') == 1){echo 'checked';} ?>>
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
                    <h3>Add Email</h3>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 col-md-4">
                            <fieldset>
                                <form method="post"  id="updatecsvdata_form1" action="" >
                                    <div class="form-group">
                                        <label for="email">Email address:</label>
                                        <input type="text" name="add_email"  pattern="{1,25}" required="" class="form-control" id="add_email">
                                    </div>
                                    <button type="submit" name="updatecsvdata" class="btn btn-primary">Submit</button>
                                </form>                            
                            </fieldset>
                            <div class="alert message-form1" style="display:none"></div>  
                        </div>
                    </div>           
                    <h3>List of Emails</h3> 
                    <hr/>        
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <table id="example" class="display email_datatable table table-bordered table-condensed" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
        jQuery("#exit_popup_form1").validate({
            rules: {
                heading_text: {
                    required: true
                },
                regular_text: {
                    required: true
                },
                text_after_free_gift: {
                    required: true
                },
                button_text: {
                    required: true
                }
            },
            messages: {
                heading_text: {
                    required: "This field is required."
                },
                regular_text: {
                    required: "This field is required."
                },
                text_after_free_gift: {
                    required: "This field is required."
                },
                button_text: {
                    required: "This field is required."
                }
            },
            submitHandler: function () {
                var heading_text = jQuery('#heading_text').val();
                var regular_text = jQuery('#regular_text').val();
                var text_after_image = jQuery('#text_after_free_gift').val();
                var button_text = jQuery('#button_text').val();
                var input_placeholder = jQuery('#input_placeholder').val();
                var show_exit_popup = 0;
                if(jQuery('#show_exit_popup').is(":checked")){
                    show_exit_popup = 1;
                }
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {action:'exit_popup_data',heading:heading_text, regular:regular_text, text_after_image:text_after_image, input_placeholder:input_placeholder, button:button_text, exit_popup:show_exit_popup},
                    success: function (response) {
                        var json = eval("(" + response + ")");
                        if (json.status == "success") {
                            datatable.clear().draw();
                            datatable.columns.adjust().draw();
                            jQuery('.message-form').html("<div class='alert alert-success'>Data Updated Successfully</div>");
                            jQuery('.message-form').show();
                            document.getElementById("updatecsvdata_form1").reset();
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
        jQuery("#updatecsvdata_form1").validate({
            rules: {
                add_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                add_email: {
                    required: "This field is required.",
                    email: "Please enter valid email id."
                }
            },
            submitHandler: function () {
                var email = jQuery('#add_email').val();
                jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {action:'add_email_data',email:email},
                    success: function (response) {
                        var json = eval("(" + response + ")");
                        if (json.status == "success") {
                            datatable.clear().draw();
                            datatable.columns.adjust().draw();
                            jQuery('.message-form1').html("<div class='alert alert-success'>Data Updated Successfully</div>");
                            jQuery('.message-form1').show();
                            document.getElementById("updatecsvdata_form1").reset();
                            setTimeout(function () {
                                jQuery('.message-form1').html();
                                jQuery('.message-form1').fadeOut();
                            }, 10000);
                        } else {
                            jQuery('.message-form1').html("<div class='alert alert-danger' style='color:red;'>Error  Found !</div>");
                            jQuery('.message-form1').show();
                            setTimeout(function () {
                                jQuery('.message-form1').html();
                                jQuery('.message-form1').fadeOut();
                            }, 10000);
                        }
                    }
                });
            }
        });
        var datatable = jQuery('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": ajaxurl + "?action=get_all_email_list",
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
                    "data": "mail",
                    render: function (data, type, row) {
                        return '<input type="text" id="csv_email_field" class="form-control" value="' + data + '">';
                    }
                },
                {
                    "data": "update",
                    "render": function (data, type, row) {
                        return '<a href="javascript:void(0)" class="btn btn-success btn-sm" id="update_email_data_filed" data-email_id="' + data + '">Update</a>';
                    },
                    "targets": 0,
                    "orderable": false
                },
                {
                    "data": "delete",
                    "render": function (data, type, row) {
                        return '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="delete_email_data_filed" data-email_id="' + data + '">Delete</a>';
                    },
                    "targets": 0,
                    "orderable": false
                },
            ] 
        });

        jQuery('body').on('click', '#delete_email_data_filed', function () {
            var email_id = jQuery(this).data('email_id');
            var email = jQuery(this).parents('tr').find('td input#csv_email_field').val();
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {action:'delete_email_data',id:email_id,email:email},
                success: function (response) {
                    datatable.clear().draw();
                    datatable.columns.adjust().draw();
                }
            });
        });
        jQuery('body').on('click', '#update_email_data_filed', function () {
            var email_id = jQuery(this).data('email_id');
            var email = jQuery(this).parents('tr').find('td input#csv_email_field').val();
            console.log('update');
            console.log(email_id,email);
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {action:'update_email_data',id:email_id,email:email},
                success: function (response) {
                    datatable.clear().draw();
                    datatable.columns.adjust().draw();
                }
            });
        });
    });   
</script>