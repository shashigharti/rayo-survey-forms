@extends('core::admin.layouts.default') @section('content') @set('ui', new $ui)
@inject('dashboard_helper','Robust\Core\Helpers\DashboardHelper')
<div id="main" class="page {{$title}}">
    <div class="row">
        <div class="container">
            <div class="row breadcrumbs-inline" id="breadcrumbs-wrapper">
                {!! Breadcrumb::getInstance()->render() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s9">
                        <div class="panel card statistics__block">
                            <h5 class="center-align">No. of Active Users</h5>
                            <div class="statistics__block-single card center-align">
                                <h6 class="title">Today</h6>
                                <p class="price">Active Users</p>
                                <p class="count">0</p>
                                <a href="">Send Follow Up</a>
                                <a href="">
                                    <button class="btn theme-btn">
                                        More Details
                                    </button>
                                </a>
                            </div>
                            <div class="statistics__block-single card center-align">
                                <h6 class="title">Weekly</h6>
                                <p class="price">Active Users</p>
                                <p class="count">1</p>
                                <a href="">Send Follow Up</a>
                                <a href="">
                                    <button class="btn theme-btn">
                                        More Details
                                    </button>
                                </a>
                            </div>
                            <div class="statistics__block-single card center-align">
                                <h6 class="title">Monthly</h6>
                                <p class="price">Active Users</p>
                                <p class="count">2</p>
                                <a href="">Send Follow Up</a>
                                <a href="">
                                    <button class="btn theme-btn">
                                        More Details
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <div class="panel card emaildetail__block ">
                                    <div class="icon-block cyan">
                                    </div>
                                    <div class="detail">
                                        <p>Total Single Listing Viewed</p>
                                        <h6 class="green-c">22</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="panel card emaildetail__block ">
                                    <div class="icon-block green">
                                    </div>
                                    <div class="detail ">
                                        <p>Total Distance Calculated</p>
                                        <h6 class="red-c">22</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="panel card emaildetail__block ">
                                    <div class="icon-block red">
                                    </div>
                                    <div class="detail ">
                                        <p>Total Listings</p>
                                        <h6 class="red-c">23</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="panel card emaildetail__block ">
                                    <div class="icon-block orange">
                                    </div>
                                    <div class="detail">
                                        <p>Newly Added Listing </p>
                                        <h6 class="orange-c">11</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col s8 mt-2">
                                <div class="panel card shortcuts__block center-align">
                                    <h5 class="title">Quick Links</h5>
                                    <a href="">
                                        <div class="shortcuts__block-single blue">
                                            <i class="material-icons">
                                                pages
                                            </i>
                                            <p>Pages</p>
                                        </div>
                                    </a>
                                    <a href="">
                                        <div class="shortcuts__block-single amber">
                                            <i class="material-icons">
                                                show_chart
                                            </i>
                                            <p>Leads</p>
                                        </div>
                                    </a>
                                    <a href="">
                                        <div class="shortcuts__block-single red">
                                            <i class="material-icons">
                                                settings
                                            </i>
                                            <p>Settings</p>
                                        </div>
                                    </a>
                                    <a href="">
                                        <div class="shortcuts__block-single green">
                                            <i class="material-icons">
                                                supervisor_account
                                            </i>
                                            <p>Agents</p>
                                        </div>
                                    </a>

                                </div>
                            </div>
                            <div class="col s4 mt-2">
                                <div class="panel card top__block">
                                    <h5>Recent Active Leads</h5>
                                    <p>John Castel</p>
                                    <a href="">View All</a>
                                </div>
                                <div class="panel card top__block">
                                    <h5>Recent Active Leads</h5>
                                    <p>John Castel</p>
                                    <a href="">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="panel card properties__block center-align">
                            <h5>Total Properties</h5>
                            <span class="count">0</span>
                            <p>pulled today</p>
                        </div>
                        <div class="panel card totalcount__block">
                            <div class="totalcount__block--single">
                                <h5>22</h5>
                                <p>Total Number of Leads</p>
                            </div>
                            <div class="totalcount__block--single">
                                <h5>34</h5>
                                <p>Total Number of Email</p>
                            </div>
                            <div class="totalcount__block--single">
                                <h5>12</h5>
                                <p>Total Number of Homes For Sale</p>
                            </div>
                            <div class="totalcount__block--single">
                                <h5>33</h5>
                                <p>Total Number of Homes Sold</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
