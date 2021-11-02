<div class="content">
    <style>
        .content {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .icon-stat {
            display: block;
            overflow: hidden;
            position: relative;
            padding: 15px;
            margin-bottom: 1em;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .icon-stat-label {
            display: block;
            color: #999;
            font-size: 13px;
        }

        .icon-stat-value {
            display: block;
            font-size: 28px;
            font-weight: 600;
        }

        .icon-stat-visual {
            position: relative;
            top: 22px;
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            line-height: 30px;
        }

        .bg-primary {
            color: #fff;
            background: #d74b4b;
        }

        .bg-secondary {
            color: #fff;
            background: #6685a4;
        }

        .icon-stat-footer {
            padding: 10px 0 0;
            margin-top: 10px;
            color: #aaa;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Revenue</span>
                            <span class="icon-stat-value">$0</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Total Sales</span>
                            <span class="icon-stat-value">0</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Revenue</span>
                            <span class="icon-stat-value">$0</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="icon-stat">
                    <div class="row">
                        <div class="col-xs-8 text-left">
                            <span class="icon-stat-label">Today Sales</span>
                            <span class="icon-stat-value">0</span>
                        </div>
                        <div class="col-xs-4 text-center">
                            <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                        </div>
                    </div>
                    <div class="icon-stat-footer">
                        <i class="fa fa-clock-o"></i> Updated Now
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-2">
                <p align="center">Navigation</p>
                <div class="list-group">
                    <a wire:click="switch_tab('product')" class="list-group-item list-group-item-action" aria-current="true">
                        Products
                    </a>
                    <a wire:click="switch_tab('category')" class="list-group-item list-group-item-action">Categories</a>
                    <a wire:click="switch_tab('discount')" class="list-group-item list-group-item-action">Discount</a>
                    <a wire:click="switch_tab('user')" class="list-group-item list-group-item-action">Users</a>
                    <a wire:click="switch_tab('purchase')" class="list-group-item list-group-item-action">Purchases</a>
                    <a wire:click="switch_tab('settings')" class="list-group-item list-group-item-action">Settings</a>
                </div>
            </div>
            <div wire:loading.delay wire:target="switch_tab" class="loading">Loading&#8230;</div>
            <div class="col-md-9 py-4">
                <p> </p>
                @switch($tab)
                @case('product')
                <livewire:product />
                @break

                @case('discount')
                <livewire:discount-component />
                @break

                @case('category')
                <livewire:category />
                @break

                @default
                <h1> Draft </h1>
                @endswitch
            </div>
        </div>

    </div>

</div>