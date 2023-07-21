<div class="headerNav py-3">
    <div class="container-fluid px-md-5 ">

        <nav class="navbar navbar-expand-xl navbar-light  mx-lg-5" id="boltd">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{ getFile(config('location.logoIcon.path').'logo.png')}}" alt="homepage"
                     class="dark-logo" />
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <ul class="navbar-nav ml-auto  align-items-end align-items-sm-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('user.home')  ? 'active' : '' }}"
                           href="{{ route('user.home') }}">@lang('Dashboard') </a>
                    </li>

                    <li class="nav-item dropdown {{ Request::routeIs('user.order*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('Order')
                            <i data-feather="chevron-down" class="svg-icon"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{menuActive('user.order.create')}}" href="{{ route('user.order.create') }}">@lang('New Order')</a>
                            <a class="dropdown-item {{menuActive('user.order.mass')}}" href="{{ route('user.order.mass') }}">@lang('Mass Order')</a>
                            <a class="dropdown-item {{menuActive('user.order.index')}}" href="{{ route('user.order.index') }}">@lang('All Order')</a>
                            <a class="dropdown-item {{menuActive('user.order-refill')}}" href="{{ route('user.order-refill') }}">@lang('Refill Order')</a>
                            <a class="dropdown-item {{menuActive('user.order-dripFeed')}}" href="{{ route('user.order-dripFeed') }}">@lang('Drip Feed')</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('user.service*')  ? 'active' : '' }}"
                           href="{{ route('user.service.show') }}">@lang('Services') </a>
                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link {{ Request::routeIs('user.addFund*')  ? 'active' : '' }}"
                           href="{{route('user.addFund')}}">@lang('Add Fund')</a>
                    </li>



                    <li class="nav-item ">
                        <a class="nav-link {{ Request::routeIs('user.fund-history') ? 'active' : '' }}"
                           href="{{ route('user.fund-history') }}">@lang('Fund History')</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ Request::routeIs('user.transaction') ? 'active' : '' }}"
                           href="{{ route('user.transaction') }}">@lang('Transactions') </a>
                    </li>


                    <li class="nav-item dropdown {{
    (Request::routeIs('user.profile') || Request::routeIs('user.api.docs') || Request::routeIs('user.ticket*') || Request::routeIs('user.referral') || Request::routeIs('user.referral.bonus*')) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownUser"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <img src="{{getFile(config('location.user.path').Auth::user()->image )}}"
                                 alt="{{ Auth::user()->name }}" class="rounded-circle" width="40px">
                            <span>{{ Auth::user()->username }}</span>
                            <i data-feather="chevron-down" class="svg-icon"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                            <a class="dropdown-item {{menuActive('user.profile')}}" href="{{ route('user.profile') }}">
                                <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                                @lang('My Profile')</a>

                            <a class="dropdown-item {{menuActive('user.referral')}}" href="{{ route('user.referral') }}">
                                <i data-feather="users" class="svg-icon mr-2 ml-1"></i>
                                @lang('My Referral')</a>

                            <a class="dropdown-item {{menuActive(['user.referral.bonus','user.referral.bonus.search'])}}" href="{{ route('user.referral.bonus') }}">
                                <i data-feather="list" class="svg-icon mr-2 ml-1"></i>
                                @lang('Referral Bonus')</a>




                            <a class="dropdown-item {{menuActive('user.api.docs')}}" href="{{ route('user.api.docs') }}">
                                <i data-feather="key" class="svg-icon mr-2 ml-1"></i> @lang('API Setting')
                            </a>

                            <a class="dropdown-item {{menuActive('user.ticket.create')}}" href="{{ route('user.ticket.create') }}">
                                <i class="fab fa-hire-a-helper mr-2 ml-1 icon-color"></i>@lang('Open Ticket')
                            </a>
                            <a class="dropdown-item {{menuActive('user.ticket.list')}}" href="{{ route('user.ticket.list') }}">
                                <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i> @lang('Show Ticket')
                            </a>
                            <a class="dropdown-item {{menuActive(['user.twostep.security'])}}" href="{{route('user.twostep.security')}}">
                                <i class="fas fa-lock mr-2 ml-1 icon-color"></i> @lang('2FA Security')
                            </a>


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </div>


            <!-- Notification -->
            <div class="push-notification dropdown" id="pushNotificationArea">

                <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                   id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <span><i class="far fa-bell bell-font"></i></span>
                    <span class="badge badge-primary notify-no rounded-circle" v-cloak>@{{ items.length }}</span>
                </a>

                <div class="right-dropdown dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                    <ul class="list-style-none">
                        <li>
                            <div class="scrollable message-center notifications position-relative">

                                <!-- Message -->
                                <a v-for="(item, index) in items"
                                   @click.prevent="readAt(item.id, item.description.link)"
                                   href="javascript:void(0)"
                                   class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success text-white rounded-circle btn-circle">
                                                    <i :class="item.description.icon" class="text-white"></i>
                                                </span>

                                    <div class="d-inline-block v-middle pl-2">
                                        <span class="font-12 d-block text-muted" v-cloak v-html="item.description.text"></span>
                                        <span class="font-12 d-block text-muted text-truncate" v-cloak>@{{ item.formatted_date }}</span>
                                    </div>
                                </a>

                            </div>
                        </li>

                        <li>
                            <a class="nav-link pt-3 text-center text-dark notification-clear-btn" href="javascript:void(0);"
                               v-if="items.length > 0" @click.prevent="readAll">
                                <strong>@lang('Clear all')</strong>
                            </a>
                            <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);"
                               v-else>
                                <strong>@lang('No Data found')</strong>
                            </a>

                        </li>
                    </ul>
                </div>


            </div>
            <!-- End Notification -->

            <div class="push-notification">
                <a onclick="darkMode()" class="nav-link dropdown-toggle pl-md-3 cursor-pointer"
                   aria-expanded="false">
                    <span><i class="far fa-moon bell-font"></i></span>
                </a>
            </div>


        </nav>

    </div>

</div>
