<?php
/*
Template Name: Submit Property
*/
get_header();
$loan_amount = 240000;
$loan_percent = 1.99;
$loan_years = 10;
// Check if the form was submitted
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] )) {

        $loan_amount = $_POST['amount'];
        $loan_percent = $_POST['percent'];
        $loan_years = $_POST['years'];
        $loan_months = $loan_years*12;//месяцев в году
        $loan_upfront_payment = $loan_amount*0.33; // Первоначальный взнос (33% на данный момент)
        $loan_upfront_payment = round($loan_upfront_payment,0);
        $loan_with_percents = $loan_amount-$loan_upfront_payment; // Тело для начисления процентов
        $loan_monthly_percent = $loan_percent/1200; //Процентов в месяц
        $monthly_payment_with_percent = $loan_with_percents*($loan_monthly_percent+($loan_monthly_percent/((pow((1+$loan_monthly_percent),$loan_months))-1))); // Месячный платеж с процентами
        $monthly_payment_with_percent = round($monthly_payment_with_percent,2);
        $loan_monthly_percentage_payment = '';// Начисление месячных процентов
        $loan_upfront_payment_monthly = $loan_upfront_payment/$loan_months; // Месячный платеж из первого взноса
        $total_monthly_payment = $monthly_payment_with_percent+$loan_upfront_payment_monthly; //Общий месячный аннуитентный платеж
        $id ='submit_success';
        $text=__('Thank you for submitting this property. Our team will analyze it and if everything is  ok we will approve it soon.','framework');
        $url1="location.href='". get_permalink(get_the_ID())."'";
        $url2="location.href='".site_url()."'";
//        echo $modalBox = '<button class="btn btn-primary btn-lg property_prompt" data-toggle="modal" data-target="#'.$id.'"></button>
//<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="'.$id.'Label" aria-hidden="true">
//<div class="modal-dialog">
//<div class="modal-content">
//<div class="modal-header">
//</div>
//<div class="modal-body"> '. $text .' </div>
//<div class="modal-footer">
//<button type="button" onclick="'.$url1.'" class="btn btn-default inverted" data-dismiss="modal">Submit another property</button></a>
//<button type="button" onclick="'.$url2.'" class="btn btn-default inverted" data-dismiss="modal">Back to Home</button>
//</div>
//  </div>
//</div>
//</div>';
        ?>
        <script>
            jQuery(document).ready(function () {
                jQuery('.property_prompt').hide();
                jQuery('.property_prompt').click(function () {
                    jQuery('.modal').addClass('in').show();
                });
                jQuery('.property_prompt').trigger('click');
            });
        </script>
        <?php
    }
    ?>
    <!-- Start Content -->
    <div class="main" role="main"><div id="content" class="content full"><div class="container">
                <div class="page"><div class="row">
                            <form id="add-property" action="#submit-calculation" method="post" enctype="multipart/form-data">
                                <div class="block-heading" id="details">
                                    <h4><span class="heading-icon"><i class="fa fa-home"></i></span><?php _e('Калькулятор аннуитетных платежей','framework'); ?></h4>
                                </div>
                                <div class="padding-as25 margin-30 lgray-bg">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <span style="font-weight:bold">Сумма займа  $</span><input name="amount" value="<? echo $loan_amount; ?>" type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <span style="font-weight:bold">Процентная ставка</span> <input name="percent" value="<? echo $loan_percent; ?>" type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <span style="font-weight:bold">Срок погашения (лет) </span> <input name="years" value="<? echo $loan_years; ?>" type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="text-align-center margin-30" id="submit-calculation">
                                    <input type="submit" value="<?php _e('Рассчитать','framework'); ?>" name="submit" class="btn btn-primary btn-lg"/>
                                    <input type="hidden" name="post_type" id="post_type" value="domande" />
                                    <input type="hidden" name="action" value="post" />
                                    <?php wp_nonce_field( 'new-post' ); ?>
                                </div>
                            </form>
                            <?php if(isset($total_monthly_payment)){
                                echo '<div class="row padding-as25 margin-30 lgray-bg">
                                        <div class="col-md-6 col-sm-6">
                                            Взнос в Накопительный фонд   $ '. $loan_upfront_payment . '
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            Ежемесячный платеж   $ '. $total_monthly_payment .'
                                        </div>
                                    </div>';
                            }
                             ?>
                        </div></div></div></div>
<?php get_footer(); ?>