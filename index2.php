<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TAP Card Element</title>
        <meta name="viewport" content="width=device-width">
        <meta name="csrf-token" content="rV65qY6xRZ7MnKcq9ZQun7YMx0xnwcpZGCfB2R4l" />
        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="https://jselements.tap.company/tapdocumentation/public/css/jquery.fullpage.css" />
        <link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/style2.css">

        <link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/custom.css">
        <link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/prism.css">
        <script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.min.js"></script>

        <!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
        <script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.min.js"></script>
        <script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.easings.min.js"></script>

        <script src="https://jselements.tap.company/tapdocumentation/public/js/bootstrap.min.js"></script>
        <script src="https://jselements.tap.company/tapdocumentation/public/js/prism.js"></script>
        <script src="https://jselements.tap.company/tapdocumentation/public/js/custom.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>

        <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
        <script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/scrolloverflow.min.js"></script>
        <script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/jquery.fullpage.js"></script>

    </head>
    <body>
        <div id="centralloader"></div>
        <div class="wrapper">
            <nav id="sidebar" class="mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">


                        <!-- <ul class="list-unstyled CTAs">
                            <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li>
                            <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li>
                        </ul> -->
                    </div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 24px; top: 0px; display: block; max-height: 116px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></nav>    <div id="content">


                <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
                <style type="text/css">
                    #card-element{
                        height: auto;
                    }
                    #content{ width: 100%; }
                    #sidebarhead,#sidebar,.navbar{display: none;}
                    body{       background: inherit;}
                </style>


                <br>
<div>correct test card: 4508 7500 1574 1019</div>
<div>wrong test card: 4000 0000 0000 0002</div>
                <div id="tab-1" class="tab-content current" style="overflow: hidden;">
                    <form id="form-container" method="post" action="charge.php">
                        <!-- Tap element will be here -->
                        <div id="element-container"></div>
                        <div id="error-handler" role="alert"></div>
                        <div id="success" style=" display: none;;position: relative;float: left;">
                            Success! Your token is <span id="token"></span>
                        </div>
                        <!-- Tap pay button -->
                        <button id="tap-btn">Submit</button>
                    </form>
                </div>

                <script>
                    //pass your public key from tap's dashboard
                    var tap = Tapjsli('pk_test_EtHFV4BuPQokJT6jiROls87Y');

                    var elements = tap.elements({});
                    var style = {
                        base: {
                            color: '#535353',
                            lineHeight: '18px',
                            fontFamily: 'sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: 'rgba(0, 0, 0, 0.26)',
                                fontSize: '15px'
                            }
                        },
                        invalid: {
                            color: 'red'
                        }
                    };

                    var labels = {
                        cardNumber: "Card Number",
                        expirationDate: "MM/YY",
                        cvv: "CVV",
                        cardHolder: "Card Holder Name"
                    };

                    var paymentOptions = {
                        currencyCode: ["KWD", "USD", "SAR"],
                        labels: labels,
                        TextDirection: 'ltr'
                    }

                    var card = elements.create('card', {style: style}, paymentOptions);

                    card.mount('#element-container');

                    card.addEventListener('change', function (event) {
                        if (event.BIN) {
                            console.log(event.BIN)
                        }
                        if (event.loaded) {
                            //console.log("UI loaded :"+event.loaded);
                            //console.log("current currency is :"+card.getCurrency())
                        }
                        var displayError = document.getElementById('error-handler');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

//window.addEventListener("unhandledrejection", (event) => {
//  console.warn(`UNHANDLED PROMISE REJECTION: ${event.reason}`);
//});
//
//window.onunhandledrejection = (event) => {
//  console.warn(`UNHANDLED PROMISE REJECTION: ${event.reason}`);
//};
//
//onunhandledrejection = (event) => {};

(function ($) {
                    // Handle form submission
                    var form = document.getElementById('form-container');
                    $('#form-container').on('submit', function (event) {
                        event.preventDefault();

                        tap.createToken(card).then(function (result) {
                            console.log(result);
                            if (result.error) {
                                // Inform the user if there was an error
                                var errorElement = document.getElementById('error-handler');
                                errorElement.textContent = result.error.message;
                            } else {
                                // Send the token to your server
                                var errorElement = document.getElementById('success');
                                errorElement.style.display = "block";
                                var tokenElement = document.getElementById('token');
                                tokenElement.textContent = result.id;
                                tapTokenHandler(result.id, event);

                            }
                        });
                    });

                    function tapTokenHandler(token_id, event) {
                        console.log(token_id);
                        $('#form-container').append('<input type="text" name="tapToken" id="tapToken" value="' + token_id + '">');
                        event.currentTarget.submit();
                    }

})(jQuery);
                </script>

            </div>

            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function () {
                    $("#sidebar").mCustomScrollbar({
                        theme: "minimal"
                    });

                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar, #content, #sidebarhead').toggleClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    });
                });
                $(window).load(function () {
                    $('#centralloader').fadeOut();
                });
            </script>
        </div>
    </body>
</html>