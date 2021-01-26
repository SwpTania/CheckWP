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
			//"order": [[ 7, "asc" ],[ 8, "desc" ]],
			"order": [[ 8, "desc" ]],
			dom: 'Bfrtip',
			buttons: [
            	'copy', 'csv', 'excel', 'pdf', 'print'
        	]
		});
	} );
</script>

<?php
// function  query_group_by_filter($groupby){
//        global $wpdb;

//        return $wpdb->postmeta . '.meta_value';
// }
// add_filter('posts_groupby', 'query_group_by_filter');

// $wds_invoice_query = new WP_Query( array(
// 	'posts_per_page' => -1,
// 	'post_type' => 'wds_invoice',
// 	'post_status' => 'publish',
// 	//'downloadable' => true,
// 	//'ignore_sticky_posts' => 1,
// 	'meta_key' => 'payee_email',
// 	'orderby' => 'publish_date',
// 	'order' => 'DESC',
// 	// 'meta_query'     => array(
// 	//     array(
// 	//       'key'     => 'plan_id',
// 	//       'value'   => 1476,
// 	//       'compare' => '='
// 	//     ) 
// 	//   )

// 	// 'meta_query'     => array(
// 	//     array(
// 	//       'key'     => 'subscription_type',
// 	//       'value'   => 'macro',
// 	//       'compare' => '='
// 	//     ) 
// 	//   )
// 	// 'meta_value' => 0,
// 	// 'meta_compare' => '>='
// 	// 'meta_type' => 'NUMERIC'
// ) );

//remove_filter('posts_groupby', 'query_group_by_filter');
//echo '<pre>'; print_r($wds_invoice_query); die('asgfg');

libxml_use_internal_errors(true);

$auth_login_id = get_option('wds_merchant_login_id');
$auth_transaction_key = get_option('wds_merchant_transaction_key');

//$auth_login_id = '5dYZ54gmdcD';
//$auth_transaction_key = '5xTp6xzB89K23SCx';

if (get_option('wds_payment_mode') == "live") { 
    $post_url = "https://secure2.authorize.net/gateway/transact.dll";
    $recurring_posturl = "https://api2.authorize.net/xml/v1/request.api";
} else { 
    $post_url = "https://test.authorize.net/gateway/transact.dll";
    $recurring_posturl = "https://apitest.authorize.net/xml/v1/request.api";
}


/*$post_string = '<getSettledBatchListRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
      <merchantAuthentication>
            <name>'.$auth_login_id.'</name>
            <transactionKey>'.$auth_transaction_key.'</transactionKey>
      </merchantAuthentication>
      <includeStatistics>true</includeStatistics>
      <firstSettlementDate>2020-09-25T08:15:30</firstSettlementDate>
      <lastSettlementDate>2020-09-26T08:15:30</lastSettlementDate>
</getSettledBatchListRequest>';

$post_url = $recurring_posturl;

$request = curl_init($post_url);
curl_setopt($request, CURLOPT_HEADER, 0);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $post_string);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
$post_response = curl_exec($request);

curl_close($request); // close curl object

if ($post_response) {
	$xml = simplexml_load_string($post_response);
echo '<pre>'; print_r($xml); die('Testing');

}*/



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

				<th scope="col" id="status" class="manage-column column-status text-center" width="10%">Status</th>

				<!-- <th scope="col" id="date" class="manage-column column-date"><a href="javascript:void(0)"><span>1st payment</span><span class="sorting-indicator"></span></a></th> -->

				<th scope="col" id="date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>1st Payment</span><span class="sorting-indicator"></span></a></th>

				<th scope="col" id="last_payment_date" class="manage-column column-date text-center"><a href="javascript:void(0)"><span>Last Payment</span><span class="sorting-indicator"></span></a></th>
			</tr>
		</thead>
		<tbody>

			<?php

			$post_string = '<ARBGetSubscriptionListRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
			   <merchantAuthentication>
			      <name>'.$auth_login_id.'</name>
			      <transactionKey>'.$auth_transaction_key.'</transactionKey>
			   </merchantAuthentication>
			   <refId></refId>
			   <searchType>subscriptionActive</searchType>
			   <sorting>
			      <orderBy>id</orderBy>
			      <orderDescending>true</orderDescending>
			   </sorting>
			   <paging>
			      <limit>1000</limit>
			      <offset>1</offset>
			   </paging>
			</ARBGetSubscriptionListRequest>';

			$post_url = $recurring_posturl;

			$request = curl_init($post_url);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $post_string);
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
			$post_response = curl_exec($request);

			curl_close($request); // close curl object

			if ($post_response) {
				$xml = simplexml_load_string($post_response);

				if ($xml === false) {
				  echo "Failed loading Response: ";
				  foreach(libxml_get_errors() as $error) {
				    echo "<br>", $error->message;
				  }
				} else {
					$i=1;
						//echo '<pre>'; print_r($xml->subscriptionDetails->subscriptionDetail);die;
					foreach ($xml->subscriptionDetails->subscriptionDetail as $subscriptionDetail) {
						global $wpdb;

						$subscription_id = $subscriptionDetail->id;
						$name = $subscriptionDetail->name;
						$status = $subscriptionDetail->status;
						$createTimeStampUTC = $subscriptionDetail->createTimeStampUTC;
						$payee_firstname = $subscriptionDetail->firstName;
						$payee_lastname = $subscriptionDetail->lastName;
						$totalOccurrences = $subscriptionDetail->totalOccurrences;
						$pastOccurrences = $subscriptionDetail->pastOccurrences;
						$paymentMethod = $subscriptionDetail->paymentMethod;
						$accountNumber = $subscriptionDetail->accountNumber;
						$invoice = $subscriptionDetail->id;
						$amount = $subscriptionDetail->amount;
						$currencyCode = $subscriptionDetail->currencyCode;

						$post_id = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'subscription_id' AND meta_value=$subscription_id " );

						$email = get_field( "payee_email", $post_id );

						//$paid_amount = get_field("paid_amount", $post_id);
						//$subscription_id = get_field("subscription_id", $wds_invoice->ID);

						$plan_id = get_field("plan_id", $post_id);
						$plan_type = get_field("plan_type", $post_id);
						$plan_name = get_field("plan_name", $post_id);
						$promo_code = get_field("promo_code", $post_id);
						$plan_type = get_field("plan_type", $post_id);

						$payment_date = date("m/d/Y", strtotime($createTimeStampUTC));
						$payment_date2 = date("Y-m-d", strtotime($createTimeStampUTC));

						$last_payment_date = '';

						if($pastOccurrences > 1){
							//$duration = ($pastOccurrences-1)*30;
							//$last_payment = date( "m/d/Y", strtotime( "$createTimeStampUTC +$duration day" ) );
							//$last_payment2 = date( "Y-m-d", strtotime( "$createTimeStampUTC +$duration day" ) );

							$duration = ($pastOccurrences-1);
							$last_payment = date( "m/d/Y", strtotime("+$duration month", strtotime( "$createTimeStampUTC" ) ));
							$last_payment2 = date( "Y-m-d", strtotime("+$duration month", strtotime( "$createTimeStampUTC" ) ));

							if( $last_payment2 >= $payment_date2 && date( "Y-m-d") >= $last_payment2 ){
								$last_payment_date = $last_payment;
							}
						}

						//$payee_firstname = get_field("payee_firstname", $post_id);
						//$payee_lastname = get_field("payee_lastname", $post_id);
						//echo "<br>";print_r($subscriptionDetail);
			?>

				<tr>
					<td scope="row" class="check-column text-center"><strong><?php echo $i;?></strong></td>

					<td class="sku column-email" data-colname="Email"><?php echo $email;?></td>

					<td class="sku column-name text-center" data-colname="Name"><?php echo $payee_firstname. ' '.$payee_lastname;?></td>

					<td class="sku column-plan text-center" data-colname="Plan"><?php echo $plan_name;?></td>

					<td class="price column-price text-center" data-colname="Price">
						<span class="woocommerce-Price-amount amount"><strong><?php echo '$'.$amount;?></strong></span>
					</td>

					<!-- <td class="price column-subscription-id text-center" data-colname="Subscription ID"><?php echo $subscription_id;?></span></td> -->

					<td class="sku column-promo text-center" data-colname="Promo"><?php echo $promo_code;?></td>

					<td class="payments column-price text-center" data-colname="Payments">
						<span class="woocommerce-Price-amount amount"><strong><?php echo $pastOccurrences;?></strong></span>
					</td>

					<td class="sku column-promo text-center" data-colname="Promo"><?php echo $status;?></td>

					<!-- <td class="date column-date text-center" data-colname="Date"><abbr title="<?php echo date("m/d/Y", strtotime($start_date));?>"><?php echo date("m/d/Y", strtotime($start_date));?></abbr></td> -->

					<td class="date column-date text-center" data-colname="Date"><?php echo $payment_date;?></td>

					<td class="date column-date text-center" data-colname="Date"><?php echo $last_payment_date;?></td>

				</tr>

			<?php
					$i++;
					}

				}

			}

			?>


			<?php

			$post_string = '<ARBGetSubscriptionListRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
			   <merchantAuthentication>
			      <name>'.$auth_login_id.'</name>
			      <transactionKey>'.$auth_transaction_key.'</transactionKey>
			   </merchantAuthentication>
			   <refId></refId>
			   <searchType>subscriptionInactive</searchType>
			   <sorting>
			      <orderBy>id</orderBy>
			      <orderDescending>true</orderDescending>
			   </sorting>
			   <paging>
			      <limit>1000</limit>
			      <offset>1</offset>
			   </paging>
			</ARBGetSubscriptionListRequest>';

			$post_url = $recurring_posturl;

			$request = curl_init($post_url);
			curl_setopt($request, CURLOPT_HEADER, 0);
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($request, CURLOPT_POSTFIELDS, $post_string);
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
			$post_response = curl_exec($request);

			curl_close($request); // close curl object

			if ($post_response) {
				$xml = simplexml_load_string($post_response);

				if ($xml === false) {
				  echo "Failed loading Response: ";
				  foreach(libxml_get_errors() as $error) {
				    echo "<br>", $error->message;
				  }
				} else {
					$i=$i;
					foreach ($xml->subscriptionDetails->subscriptionDetail as $subscriptionDetail) {
						global $wpdb;

						$subscription_id = $subscriptionDetail->id;
						$name = $subscriptionDetail->name;
						$status = $subscriptionDetail->status;
						$createTimeStampUTC = $subscriptionDetail->createTimeStampUTC;
						$payee_firstname = $subscriptionDetail->firstName;
						$payee_lastname = $subscriptionDetail->lastName;
						$totalOccurrences = $subscriptionDetail->totalOccurrences;
						$pastOccurrences = $subscriptionDetail->pastOccurrences;
						$paymentMethod = $subscriptionDetail->paymentMethod;
						$accountNumber = $subscriptionDetail->accountNumber;
						$invoice = $subscriptionDetail->id;
						$amount = $subscriptionDetail->amount;
						$currencyCode = $subscriptionDetail->currencyCode;

						$post_id = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'subscription_id' AND meta_value=$subscription_id " );

						$email = get_field( "payee_email", $post_id );

						//$paid_amount = get_field("paid_amount", $post_id);
						//$subscription_id = get_field("subscription_id", $wds_invoice->ID);

						$plan_id = get_field("plan_id", $post_id);
						$plan_type = get_field("plan_type", $post_id);
						$plan_name = get_field("plan_name", $post_id);
						$promo_code = get_field("promo_code", $post_id);
						$plan_type = get_field("plan_type", $post_id);

						$payment_date = date("m/d/Y", strtotime($createTimeStampUTC));

						$payment_date2 = date("Y-m-d", strtotime($createTimeStampUTC));

						$last_payment_date = '';
						if($pastOccurrences > 1){
							//$duration = $pastOccurrences*30;
							//$last_payment = date( "m/d/Y", strtotime( "$createTimeStampUTC +$duration day" ) );
							//$last_payment2 = date( "Y-m-d", strtotime( "$createTimeStampUTC +$duration day" ) );

							$duration = ($pastOccurrences-1);
							$last_payment = date( "m/d/Y", strtotime("+$duration month", strtotime( "$createTimeStampUTC" ) ));
							$last_payment2 = date( "Y-m-d", strtotime("+$duration month", strtotime( "$createTimeStampUTC" ) ));

							if( $last_payment2 >= $payment_date2 && date( "Y-m-d") >= $last_payment2 ){
								$last_payment_date = $last_payment;
							}
						}

						//$payee_firstname = get_field("payee_firstname", $post_id);
						//$payee_lastname = get_field("payee_lastname", $post_id);
						//echo "<br>";print_r($subscriptionDetail);
			?>

				<tr>
					<td scope="row" class="check-column text-center"><strong><?php echo $i;?></strong></td>

					<td class="sku column-email" data-colname="Email"><?php echo $email;?></td>

					<td class="sku column-name text-center" data-colname="Name"><?php echo $payee_firstname. ' '.$payee_lastname;?></td>

					<td class="sku column-plan text-center" data-colname="Plan"><?php echo $plan_name;?></td>

					<td class="price column-price text-center" data-colname="Price">
						<span class="woocommerce-Price-amount amount"><strong><?php echo '$'.$amount;?></strong></span>
					</td>

					<!-- <td class="price column-subscription-id text-center" data-colname="Subscription ID"><?php echo $subscription_id;?></span></td> -->

					<td class="sku column-promo text-center" data-colname="Promo"><?php echo $promo_code;?></td>

					<td class="payments column-price text-center" data-colname="Payments">
						<span class="woocommerce-Price-amount amount"><strong><?php echo $pastOccurrences;?></strong></span>
					</td>

					<td class="sku column-promo text-center" data-colname="Promo"><?php echo $status;?></td>

					<!-- <td class="date column-date text-center" data-colname="Date"><abbr title="<?php echo date("m/d/Y", strtotime($start_date));?>"><?php echo date("m/d/Y", strtotime($start_date));?></abbr></td> -->

					<td class="date column-date text-center" data-colname="Date"><?php echo $payment_date;?></td>

					<td class="date column-date text-center" data-colname="Date"><?php echo $last_payment_date;?></td>

				</tr>

			<?php
					$i++;
					}
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

			<th scope="col" id="status" class="manage-column column-status text-center" width="10%">Status</th>

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
