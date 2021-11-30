<div class="deznav">
    <div class="deznav-scroll">
        @if(Auth::user()->type == "admin")
        <a href="javascript:void(0)" class="add-menu-sidebar" data-toggle="modal" data-target="#addOrderModalside" >+ New Event</a>
        <ul class="metismenu" id="menu">
            <li><a class="ai-icon" href="{{ route ('main') }}" >
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Event</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route ('event.list') }}" >List Event</a>
                    </li>
                    <li><a href="{{ route('tadarus.index') }}">Tadarus Al-Quran</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Payment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('subscription.index') }}">Subscription</a></li>
                    <li><a href="{{ route('donation.index') }}">Donation</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">User</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="" href="{{ route ('customer.list') }}">Customer</a></li>
                    <li><a class="" href="{{ route ('admin.list') }}">Admin / Staff</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Report</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="" href="{{ route ('report.payment') }}">Payment</a></li>
                    <li><a class="" href="{{ route ('report.event') }}">Event</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Add New Users</a></li>
                    <li><a class="">Change Password</a></li>
                    <li><a class="">Third Party Interagation</a></li>
                </ul>
            </li>
        </ul>
        @elseif(Auth::user()->type == "member")
        <ul class="metismenu" id="menu">
            <li><a class="ai-icon" href="{{ route('member.main') }}" >
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('member.event.list') }}" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Event</span>
                </a>
            </li>
            <li><a class="ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Tadarus Al-Quran</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('member.donation') }}" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Donation</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('member.subscription') }}" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Subscription</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="" href="{{ route('member.setting.profile') }}">Edit Profile</a></li>
                    <li><a class="" href="{{ route('member.setting.change_password') }}">Change Password</a></li>
                </ul>
            </li>
        </ul>
        @endif
        <div class="copyright">
            <p><strong>Otata Event Dashboard</strong> © 2021 All Rights Reserved</p>
            <p>Design <span class="heart"></span> by iWhost</p>
        </div>
    </div>
</div>

<!--begin::Modal-->
@include('theme.modals.add_event')
<!--end::Modal-->