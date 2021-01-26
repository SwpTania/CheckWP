<link rel="stylesheet" type="text/css" href="https://acku.edu.af/wp-content/plugins/woocommerce/assets/css/admin.css?ver=3.5.7">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery('#macro_subscriptions_list').DataTable({
			"order": [[ 7, "desc" ]],
			dom: 'Bfrtip',
			buttons: [
            	'copy', 'csv', 'excel', 'pdf', 'print'
        	]
		});
	} );
</script>

<?php

function  query_group_by_filter($groupby){
       global $wpdb;

       return $wpdb->postmeta . '.meta_value';
    }

add_filter('posts_groupby', 'query_group_by_filter');

$wds_invoice_query = new WP_Query( array(
	'posts_per_page' => -1,
	'post_type' => 'wds_invoice',
	'post_status' => 'publish',
	//'downloadable' => true,
	//'ignore_sticky_posts' => 1,
	'meta_key' => 'payee_email',
	'orderby' => 'publish_date',
	'order' => 'DESC',
	// 'meta_query'     => array(
	//     array(
	//       'key'     => 'plan_id',
	//       'value'   => 1476,
	//       'compare' => '='
	//     ) 
	//   )

	// 'meta_query'     => array(
	//     array(
	//       'key'     => 'subscription_type',
	//       'value'   => 'macro',
	//       'compare' => '='
	//     ) 
	//   )
	// 'meta_value' => 0,
	// 'meta_compare' => '>='
	// 'meta_type' => 'NUMERIC'
) );

remove_filter('posts_groupby', 'query_group_by_filter');


//echo '<pre>'; print_r($wds_invoice_query); die('asgfg');

?>


<div class="wrap">
	<h2>Subscriptions List</h2>

	<table id="macro_subscriptions_list" class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<th id="cb" class="manage-column column-cb check-column text-center"><strong>#</strong></th>

				<th scope="col" id="email" class="manage-column column-name"><a href="javascript:void(0)"><span>Email</span><span class="sorting-indicator"></span></a></th>

				<th scope="col" id="name" class="manage-column column-name text-center"><span>Name</span><span class="sorting-indicator"></span></th>

				<th scope="col" id="promo" class="manage-column column-sku text-center"><span>Plan Name</span><span class="sorting-indicator"></span></th>

				<th scope="col" id="price" class="manage-column column-price text-center">Payment Amount</th>

				<!-- <th scope="col" id="subscription_id" class="manage-column column-price text-center">Subscription ID</th> -->

				<th scope="col" id="promo" class="manage-column column-sku text-center"><span>Promo Code</span><span class="sorting-indicator"></span></th>

				<th scope="col" id="payment" class="manage-column column-payment text-center" width="10%">Payments</th>

				<!-- <th scope="col" id="date" class="manage-column column-date"><a href="javascript:void(0)"><span>1st payment</span><span class="sorting-indicator"></span></a></th> -->

				<th scope="col" id="date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>1st Payment</span><span class="sorting-indicator"></span></a></th>

				<th scope="col" id="last_payment_date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>Last Payment</span><span class="sorting-indicator"></span></a></th>
			</tr>
		</thead>
		<tbody>

			<?php
			if(!empty($wds_invoice_query->posts)){
				$i=1;
				foreach ($wds_invoice_query->posts as $wds_invoice) {
					global $wpdb;

					//echo $wds_invoice->ID;

					$email = get_field( "payee_email", $wds_invoice->ID );
					$paid_amount = get_field("paid_amount", $wds_invoice->ID);
					$subscription_id = get_field("subscription_id", $wds_invoice->ID);
					$plan_id = get_field("plan_id", $wds_invoice->ID);
					$plan_type = get_field("plan_type", $wds_invoice->ID);
					$plan_name = get_field("plan_name", $wds_invoice->ID);
					$promo_code = get_field("promo_code", $wds_invoice->ID);

					$payment_date = date("m/d/Y", strtotime($wds_invoice->post_date));

					$payee_firstname = get_field("payee_firstname", $wds_invoice->ID);
					$payee_lastname = get_field("payee_lastname", $wds_invoice->ID);

					if($plan_type == 'Auto Renew'){
						$start_date = get_field("start_date", $wds_invoice->ID);

						$start_date = ($start_date) ? date("m/d/Y", strtotime($start_date)) : date("m/d/Y", strtotime($wds_invoice->post_date));

					}else{
						$start_date = date("m/d/Y", strtotime($wds_invoice->post_date)); //$wds_invoice->post_date;
					}

					//$count = $wpdb->get_row("SELECT COUNT(*) AS THE_COUNT FROM $wpdb->postmeta WHERE (meta_key = 'payee_email' AND meta_value = '".$email."')");

					//$counts = $count->THE_COUNT;

					//$results = $wpdb->get_results( "select post_id, meta_key from $wpdb->postmeta where meta_value = '".$email."'", ARRAY_A );
					$args = array(
						'post_type'		=>	'wds_invoice',
						'post_status' => 'publish',
						'orderby' => 'publish_date',
						'order' => 'DESC',
						'meta_query'	=>	array(
							array(
								'value'	=>	$email
							)
						)
					);
					$wds_invoice_query2 = new WP_Query( $args );

					if(!empty($wds_invoice_query2->posts)){
						$counts = $j = $wds_invoice_query2->post_count;
						foreach ($wds_invoice_query2->posts as $wds_invoice2) {
							if($counts > 1 ){
								$last_payment_date = date("m/d/Y", strtotime($wds_invoice2->post_date));
							}else{
								$last_payment_date = '-';
							}
							break;
						}
					}

					//echo '<pre>'; print_r($my_query); echo '</pre>';//print_r($plan_type); print_r($start_date); //die;

					//echo $paid_amount_count = $wpdb->get_var("SELECT COUNT( meta_value ) FROM $wpdb->postmeta WHERE meta_key = 'payee_email' AND meta_value = '$email' " );

					//$start_date =  ($start_date) ? date("m/d/Y", strtotime($start_date)) : '-';


			?>

				<tr>
					<td scope="row" class="check-column text-center"><strong><?php echo $i;?></strong></td>

					<td class="sku column-email" data-colname="Email"><?php echo $email;?></td>

					<td class="sku column-name text-center" data-colname="Name"><?php echo $payee_firstname. ' '.$payee_lastname;?></td>

					<td class="sku column-plan text-center" data-colname="Plan"><?php echo $plan_name;?></td>

					<td class="price column-price text-center" data-colname="Price">
						<span class="woocommerce-Price-amount amount"><strong><?php echo '$'.$paid_amount;?></strong></span>
					</td>

					<!-- <td class="price column-subscription-id text-center" data-colname="Subscription ID"><?php echo $subscription_id;?></span></td> -->

					<td class="sku column-promo text-center" data-colname="Promo"><?php echo $promo_code;?></td>

					<td class="payments column-price text-center" data-colname="Payments">
						<span class="woocommerce-Price-amount amount"><strong><?php echo $counts;?></strong></span>
					</td>

					<!-- <td class="date column-date text-center" data-colname="Date"><abbr title="<?php echo date("m/d/Y", strtotime($start_date));?>"><?php echo date("m/d/Y", strtotime($start_date));?></abbr></td> -->

					<td class="date column-date text-center" data-colname="Date"><?php echo $payment_date;?></td>

					<td class="date column-date text-center" data-colname="Date"><?php echo $last_payment_date;?></td>

				</tr>

			<?php
				$i++;
				}

			}

			?>
			
		
		</tbody>
	<tfoot>
		<tr>
			<td id="cb" class="manage-column column-cb check-column text-center"><strong>#</strong></td>

			<th scope="col" id="email" class="manage-column column-name"><a href="javascript:void(0)"><span>Email</span><span class="sorting-indicator"></span></a></th>

			<th scope="col" id="name" class="manage-column column-name text-center"><span>Name</span><span class="sorting-indicator"></span></th>

			<th scope="col" id="promo" class="manage-column column-sku text-center"><span>Plan Name</span><span class="sorting-indicator"></span></th>

			<th scope="col" id="price" class="manage-column column-price text-center">Payment Amount</th>

			<!-- <th scope="col" id="subscription_id" class="manage-column column-price text-center">Subscription ID</th> -->

			<th scope="col" id="promo" class="manage-column column-sku text-center"><span>Promo Code</span><span class="sorting-indicator"></span></th>

			<th scope="col" id="payment" class="manage-column column-payment text-center">Payments</th>

			<!-- <th scope="col" id="date" class="manage-column column-date"><a href="javascript:void(0)"><span>1st payment</span><span class="sorting-indicator"></span></a></th> -->

			<th scope="col" id="date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>1st Payment</span><span class="sorting-indicator"></span></a></th>

			<th scope="col" id="last_payment_date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>Last Payment</span><span class="sorting-indicator"></span></a></th>
		</tr>
	</tfoot>
</table>

</div>

<style type="text/css">
	#macro_subscriptions_list tr th.text-center{
		text-align: center!important;
	}
</style>
