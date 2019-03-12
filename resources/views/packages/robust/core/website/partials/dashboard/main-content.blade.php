<section class="banner clearfix">
    <div class="banner-header">
        <div class="container-fluid">
            <div class="header-content">
                <div class="col-sm-6 header-text">
                    <div class="header-intro">
                        <h1>SIMPLIFIED DATA
                            COLLECTION, MONITORING
                            AND ANALYSIS TOOL</h1>
                        <div class="text-flexslider">
                            <ul class="slides">
                                <li><p>BUILD , COLLECT AND ANALYSE</p></li>
                                <li><p>FORM COLLECTION IN EASIEST WAY</p></li>
                                <li><p>NO MORE PAPER FORMS</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 header-img">
                    <img src="{{asset('assets/website/images/survey-form.png')}}">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about" class="about clearfix">
    <div class="container-fluid">
        <h3>RayoSurveryForms gives you the power to control your data collection process.<br>
            Managing the whole data collection process is as easy as <br>clicking the button</h3>
    </div>
</section>
<section id="features" class="feature clearfix">
    <div class="container">
        <div class="col-sm-6 col-xs-12 feature-container">
            <div class="feature-text">
                <h3>CREATE FORMS</h3>
                <p>Create your survery forms and share with the survey team.</p>
                <p>Creating a form is very easy and initiative with drag and drop
                    feature. Reuse your forms in other surverys.</p>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12 feature-container">
            <img src="{{asset('assets/website/images/laptop.png')}}">
        </div>
    </div>
</section>
<section class="feature clearfix">
    <div class="container">
        <div class="col-sm-6 text-center feature-container hidden-xs">
            <img class="phone" src="{{asset('assets/website/images/phone.png')}}">
        </div>
        <div class="col-sm-6 feature-container">
            <div class="feature-text">
                <h3> OFFLINE DATA COLLECTION</h3>
                <p>Collect your data timely and easily online or offline using mobile,tab or laptop.</p>
                <p>Easily monitor the data collection process centrally using realtime dashboards. System
                    informs
                    you about incomplete data
                    submissions.</p>
            </div>
        </div>
        <div class="col-sm-6 text-center feature-container visible-xs">
            <img class="phone" src="{{asset('assets/website/images/phone.png')}}">
        </div>
    </div>
</section>
<section class="feature clearfix">
    <div class="container">
        <div class="col-sm-6 col-xs-12 feature-container">
            <div class="feature-text">
                <h3>DATA MANAGEMENT, ANALYTICS AND VISUALIZATION</h3>
                <p>Manage your own data using data management features.</p>
                <p>Instant tabular reports and visualization.</p>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12 feature-container text-right">
            <img src="{{asset('assets/website/images/tablet.png')}}">
        </div>
    </div>
</section>
<section id="get_started" class="cta clearfix">
    <div class="cta-container clearfix">
        <div class="half-cta col-sm-6 col-xs-12">
            <h3>CONTACT US</h3>
            {{ Form::open(['url' => route('website.home'), 'method' => 'post', 'class' => 'form-horizontal']) }}
            @include("core::admin.partials.messages.info")
            <div class="col-sm-12">
                {{ Form::text('name',null,['placeholder'=>'Full Name']) }}
            </div>
            <div class="col-sm-6">
                {{ Form::email('email',null,['placeholder'=>'Email Address']) }}
            </div>
            <div class="col-sm-6">
                {{ Form::text('phone',null,['placeholder'=>'Mobile Number']) }}
            </div>
            <div class="col-sm-12">
                <textarea placeholder="Your Message"></textarea>
            </div>
            <button type="submit">SUBMIT</button>
            {{ Form::close() }}

        </div>
        <div class="half-cta dynamic-section text-center col-xs-12 col-sm-6">
            <h3>Rayo Forms</h3>
            <p>Build your own form!</p>
            <p>Save time and cost by designing your own custom forms and go paperless.Easily Managable and
                visualize
                your data without extra effort and tool.
            </p>
            <p> If you have any queries, please contact us at info@robustitconcepts.com or
                9851113148(mobile)</p>
            <a href="{{route('auth.register')}}">
                <h2>Register</h2>
            </a>
        </div>
    </div>
</section>
