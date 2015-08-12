<style>
    .section{
        margin-left: -20px;
        margin-right: -20px;
        font-family: "Raleway",san-serif;
    }
    .section h1{
        text-align: center;
        text-transform: uppercase;
        color: #808a97;
        font-size: 35px;
        font-weight: 700;
        line-height: normal;
        display: inline-block;
        width: 100%;
        margin: 50px 0 0;
    }
    .section:nth-child(even){
        background-color: #fff;
    }
    .section:nth-child(odd){
        background-color: #f1f1f1;
    }
    .section .section-title img{
        display: table-cell;
        vertical-align: middle;
        width: auto;
        margin-right: 15px;
    }
    .section h2,
    .section h3 {
        display: inline-block;
        vertical-align: middle;
        padding: 0;
        font-size: 24px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section .section-title h2{
        display: table-cell;
        vertical-align: middle;
    }

    .section-title{
        display: table;
    }

    .section h3 {
        font-size: 14px;
        line-height: 28px;
        margin-bottom: 0;
        display: block;
    }

    .section p{
        font-size: 13px;
        margin: 25px 0;
    }
    .section ul li{
        margin-bottom: 4px;
    }
    .landing-container{
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        padding: 50px 0 30px;
    }
    .landing-container:after{
        display: block;
        clear: both;
        content: '';
    }
    .landing-container .col-1,
    .landing-container .col-2{
        float: left;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .landing-container .col-1 img{
        width: 100%;
    }
    .landing-container .col-1{
        width: 55%;
    }
    .landing-container .col-2{
        width: 45%;
    }
    .premium-cta{
        background-color: #808a97;
        color: #fff;
        border-radius: 6px;
        padding: 20px 15px;
    }
    .premium-cta:after{
        content: '';
        display: block;
        clear: both;
    }
    .premium-cta p{
        margin: 7px 0;
        font-size: 15px;
        font-weight: 500;
        display: inline-block;
        width: 60%;
    }
    .premium-cta a.button{
        border-radius: 6px;
        height: 60px;
        float: right;
        background: url('<?php echo YITH_YWSL_URL?>assets/images/upgrade.png') #ff643f no-repeat 13px 13px;
        border-color: #ff643f;
        box-shadow: none;
        outline: none;
        color: #fff;
        position: relative;
        padding: 9px 50px 9px 70px;
    }
    .premium-cta a.button:hover,
    .premium-cta a.button:active,
    .premium-cta a.button:focus{
        color: #fff;
        background: url(<?php echo YITH_YWSL_URL?>assets/images/upgrade.png) #971d00 no-repeat 13px 13px;
        border-color: #971d00;
        box-shadow: none;
        outline: none;
    }
    .premium-cta a.button:focus{
        top: 1px;
    }
    .premium-cta a.button span{
        line-height: 13px;
    }
    .premium-cta a.button .highlight{
        display: block;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
    }
    .premium-cta .highlight{
        text-transform: uppercase;
        background: none;
        font-weight: 800;
        color: #fff;
    }

    @media (max-width: 768px) {
        .section{margin: 0}
        .premium-cta p{
            width: 100%;
        }
        .premium-cta{
            text-align: center;
        }
        .premium-cta a.button{
            float: none;
        }
    }

    @media (max-width: 480px){
        .wrap{
            margin-right: 0;
        }
        .section{
            margin: 0;
        }
        .landing-container .col-1,
        .landing-container .col-2{
            width: 100%;
            padding: 0 15px;
        }
        .section-odd .col-1 {
            float: left;
            margin-right: -100%;
        }
        .section-odd .col-2 {
            float: right;
            margin-top: 65%;
        }
    }

    @media (max-width: 320px){
        .premium-cta a.button{
            padding: 9px 20px 9px 70px;
        }

        .section .section-title img{
            display: none;
        }
    }
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Social Login</span> to benefit from all features!
                </p>
                <a href="<?php echo YITH_WC_Social_Login_Admin()->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>

        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/01-bg.png) no-repeat #fff; background-position: 85% 75%">
        <h1>Premium Features</h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/01.png" alt="Socials icon" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/01-icon.png" alt="Socials"/>
                    <h2>12 social networks available</h2>
                </div>
                <p>
                    Your users can register and log into your shop with many more social profiles with the premium
                    version of the plugin: LinkedIn, Yahoo, Foursquare, Live, Instagram, PayPal, Tumblr, VKontakte and
                    GitHub.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/02-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/02-icon.png" alt="screen" />
                    <h2>Connection report</h2>
                </div>
                <p>
                    A report that keeps you informed about past connections on your site. A section entirely devoted to
                    the plugin is integrated into WooCommerce report, so that you can see the amount of occurred user
                    connections for each single social network.
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/02.png" alt="icon" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/03-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/03.png" alt="Screenshot" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/03-icon.png" alt="icon" />
                    <h2>“My Account” page</h2>
                </div>
                <p>
                    “My Account” page is the main page for the plugin: here users can find the list with all social
                    networks available for simoultaneous <b>social connections</b>. Connections can be disabled any time by
                    clicking on the “Unlink” button.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/04-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/04-icon.png" alt="Icon" />
                    <h2>Redirect</h2>
                </div>
                <p>
                    Do you want your users to be <b>redirected</b> to a specific page after logging in, instead of seeing the page they had left?<br/>
                    You can just set it from the <b>option panel</b> and choose either some of WooCommerce static pages or a URL that you yourself specify.
                </p>

            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/04.png" alt="Screenshot" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/05-bg.png) no-repeat #fff; background-position: 85% 75%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/05.png" alt="Screenshot" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/05-icon.png" alt="Icon"/>
                    <h2>Shortcode and Widget</h2>
                </div>
                <p>
                    Exploit at your best potential features of YITH WooCommerce Social Login and add the social network
                    you prefer in stategic spots of your shop using shortcodes and widgets made available by the plugin.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/06-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/06-icon.png" alt="Icon" />
                    <h2>Position of login buttons</h2>
                </div>
                <p>
                    There is a specific option that allows you to choose the <b>position for displaying your login buttons
                    in the shop</b>: in checkout page, in WooCommerce registration form or in WordPress login page, are just
                    a few among all available options.
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/06.png" alt="Screenshot" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/07-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/07.png" alt="Screenshot" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/07-icon.png" alt="Icon" />
                    <h2>Drag and drop buttons</h2>
                </div>
                <p>
                    The plugin offers you a summarising view of all social networks. Here you can see enabled and
                    disabled ones. By simply <b>dragging and dropping</b> them you can set their display order.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWSL_URL ?>assets/images/08-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWSL_URL ?>assets/images/08-icon.png" alt="Icon" />
                    <h2>WooCommerce registration</h2>
                </div>
                <p>
                    YITH WooCommerce Social Login enables new <b>user registrations</b> directly from their social accounts.
                    Instead of using the usual registration form in “My Account” page, if new users want to register to
                    your shop they can do it through their <b>social profile</b>. Some information, such as “Billing State” and
                    “Billing City”, will be registered by WooCommerce in their user profiles.
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWSL_URL ?>assets/images/08.png" alt="Screenshot" />
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Social Login</span> to benefit from all features!
                </p>
                <a href="<?php echo YITH_WC_Social_Login_Admin()->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>
        </div>
    </div>
</div>