<?php

// function twentyeleven_setup() {
 
//     //require only in admin!
//     if(is_admin()){ 
//         require_once('lib/my-theme-settings.php');
//     }
// }
    /*
 * Define Constants
 */
define('WPTUTS_SHORTNAME', 'wptuts'); // used to prefix the individual setting field id see wptuts_options_page_fields()
define('WPTUTS_PAGE_BASENAME', 'export-invoice'); // the settings page slug

/*
 * Specify Hooks/Filters
 */
add_action( 'admin_menu', 'wptuts_add_menu' );
 
/*
 * The Admin menu page
 */
function wptuts_add_menu(){
     
    // Display Settings Page link under the "Appearance" Admin Menu
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    $wptuts_settings_page = add_theme_page(__('Export Invoice'),'Export Invoice', 'manage_options', WPTUTS_PAGE_BASENAME, 'wptuts_settings_page_fn');          
}


/**
 * Helper function for defining variables for the current page
 *
 * @return array
 */
function wptuts_get_settings() {}
/*
 * Admin Settings Page HTML
 * 
 * @return echoes output
 */
function wptuts_settings_page_fn() {
// get the settings sections array
    // $settings_output = wptuts_get_settings();
?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"></div>
        <h2>Export Invoice Data</h2>
         
        <a class="button button-primary" target="_blank" href="<?php get_admin_url() ?>?export_user=1">
                Download Invoice Data
        </a>
    </div>
<?php } 
function getExport2()
{
    if (!isset($_GET['export_user'])) {
        return;
    }

    if ($_GET['export_user'] == '1') {
        
        $filename = 'Invoice_Data_' . date('Y_m_d') . '.xlsx';

        $args = array(
            'post_type' => 'wds_invoice',
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $the_query = new WP_Query($args);
        
        // $args = array('orderby' => 'name', 'hide_empty' => false, 'parent' => 0);
        // $courses = get_terms(array('finance-courses', 'accounting-courses', 'calculus-courses', 'statistics-courses', 'qmb-courses', 'ism-excel-courses'), $args);

        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        //date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli') {
            die('This example should only be run from a Web Browser');
        }

        $class_path = ABSPATH. 'php-excel/Classes/PHPExcel.php';

        /** Include PHPExcel */
        require_once $class_path;
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Zack Monawar")
                ->setLastModifiedBy("Zack Monawar")
                ->setTitle("Invoice Data Sheet")
                ->setSubject("Invoice Data details")
                ->setDescription("Detail list of the Invoice")
                ->setKeywords("Invoice List")
                ->setCategory("Invoice List");


        if ($the_query->have_posts()) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Invoice Number')
                    ->setCellValue('B1', 'Invoice Title')
                    ->setCellValue('C1', 'Plan Name')
                    ->setCellValue('D1', 'Plan Type')
                    ->setCellValue('E1', 'Amount Paid')
                    ->setCellValue('F1', 'Customer Name')
                    ->setCellValue('G1', 'Customer Email')
                    ->setCellValue('H1', 'Subscription ID')
                    ->setCellValue('I1', 'Subscription status');

            $rec_id = 2;
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $invoice_meta = get_post_meta(get_the_ID());
                $rec_invoice_number = $invoice_meta['invoice_number'][0];
                $rec_invoice_title = get_the_title(get_the_ID());
                if(isset($invoice_meta['plan_name'][0])){
                    $rec_plan_name = $invoice_meta['plan_name'][0];
                } else{
                    $rec_plan_name = '';
                }
                $rec_plan_type = $invoice_meta['plan_type'][0];
                $rec_paid_amount = '$'.$invoice_meta['paid_amount'][0];
                $rec_customer_name = $invoice_meta['payee_firstname'][0].' '.$invoice_meta['payee_lastname'][0];
                $rec_customer_email = $invoice_meta['payee_email'][0];
                if(isset($invoice_meta['subscription_id'][0])){
                    $rec_subscription_id = $invoice_meta['subscription_id'][0];
                } else{
                    $rec_subscription_id = '';
                }
                if(isset($invoice_meta['subscription_status'][0])){
                    $rec_subscription_status = $invoice_meta['subscription_status'][0];
                } else{
                    $rec_subscription_status = '';
                }
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $rec_id, $rec_invoice_number)
                        ->setCellValue('B' . $rec_id, $rec_invoice_title)
                        ->setCellValue('C' . $rec_id, $rec_plan_name)
                        ->setCellValue('D' . $rec_id, $rec_plan_type)
                        ->setCellValue('E' . $rec_id, $rec_paid_amount)
                        ->setCellValue('F' . $rec_id, $rec_customer_name)
                        ->setCellValue('G' . $rec_id, $rec_customer_email)
                        ->setCellValue('H' . $rec_id, $rec_subscription_id)
                        ->setCellValue('I' . $rec_id, $rec_subscription_status);

                $rec_id++;
            }
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Invoice Data Sheet');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    exit();
}

add_action('admin_init', 'getExport2');
