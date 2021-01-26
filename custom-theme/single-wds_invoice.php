<?php

get_header();
$background_image = get_field('page_background_image', get_the_ID());
?>
<section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro contOver">
            <div class="contactForm">
                <div class="form-group">
                    <h3 class="text-center">THANK YOU FOR YOUR PURCHASE</h3>
                </div>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post();
                    $invoice_meta  = get_post_meta($post->ID); //echo $post->ID; echo '<pre>'; print_r($invoice_meta);
                     $firstname= $invoice_meta['payee_firstname'][0];
                     $lastname= $invoice_meta['payee_lastname'][0];
                     $lastname= $invoice_meta['payee_lastname'][0];
                     $payee_email= $invoice_meta['payee_email'][0];
                     $paid_amount= $invoice_meta['paid_amount'][0];
                     $invoice_number= $invoice_meta['invoice_number'][0];
                     $plan_type = $invoice_meta['plan_type'][0];
                     $plan_name = $invoice_meta['plan_name'][0];
                     $invoice ='<div class="text-center" style="font-size: 22px;margin: 70px 0 0 0;line-height: 40px;">';                     
                            
                     if($plan_type == 'Auto renewal'){
                        $subscription_id= $invoice_meta['subscription_id'][0];
                        $subscription_status= $invoice_meta['subscription_status'][0];
                        $customer_ProfileId= $invoice_meta['customer_ProfileId'][0];
                        $customer_PaymentProfileId= $invoice_meta['customer_PaymentProfileId'][0];
                        $transaction_id = $subscription_id;
                        //$invoice.= "You have selected $plan_type plan <br>"."Your subscription ID : $subscription_id <br>"."Paid amount is: $paid_amount <br>"."Customer profile ID is : $customer_ProfileId<br>"."Customer PaymentProfileID is : $customer_PaymentProfileId<br>";
                     }
                     else{
                        $transaction_id= $invoice_meta['transaction_id'][0];
                        $payment_status= $invoice_meta['payment_status'][0];
                        //$invoice.= "You have selected $plan_type plan <br>" . "Your Transaction ID : $transaction_id <br>" . "Paid amount is: $paid_amount <br>";
                     }     

                     if(empty($invoice_meta['subscription_type'][0]) ){               
                     
                     $invoice .= '<p style="font-size: 24px;line-height: 40px;">Please text Zack at <b>727-543-4114</b> to schedule your initial consultation. Looking forward to helping you transform 1 Rep at a Time!</p><br/>You have successfully completed your Transaction.<br/>Your Transaction ID is <b>' . $transaction_id . '</b> and Invoice ID is <b>' . $invoice_number . '</b>.<br>You have opted plan "<b>' . $plan_name . '</b>". Amount Paid <b>$' . $paid_amount . '</b>.';
                    }

                    if(!empty($invoice_meta['subscription_type'][0]) && $invoice_meta['subscription_type'][0] == 'macro' ){
                        $invoice .= 'You have successfully completed your Transaction.<br/>Your Transaction ID is <b>' . $transaction_id . '</b> and Invoice ID is <b>' . $invoice_number . '</b>.<br>You have opted plan "<b>' . $plan_name . '</b>". Amount Paid <b>$' . $paid_amount . '</b>.';

                        $invoice .= '<br><b>Please check your email for login details.</b>';

                        if ( is_user_logged_in() ):
                        $invoice .= '<br><br><a href="https://6packmacros.com/macro-result" class="recalculate_btn" id="recalculate_btn">Check Result</a>';
                        endif;

                    }


                     $invoice .= '</div><p class="sincerely">Sincerely,<br/>Zack and Neil</p>';


                    echo $invoice;
                    //$mail_sent = wp_mail($payee_email, 'Thanks For Order' , $invoice);
                    //if($mail_sent){
                    //    echo 'Invoice has been sent to you';
                    //}
                    //else{
                    //    echo 'Mail is not sent ';
                    //}
                     
                    ?>
                        <?php //the_content();
                        
                        ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    .recalculate_btn {
        /*display: block;*/
        width: 50%;
        background: #e1b30d;
        padding: 8px 20px;
        font-size: 35.15px;
        font-weight: 600;
        text-transform: uppercase;
        color: #000;
        font-family: roboto slab;
        border-radius: 7px;
    }
    a.recalculate_btn:hover, a.recalculate_btn:focus {
        color: #000000!important;
    }
</style>
<?php get_footer(); ?>