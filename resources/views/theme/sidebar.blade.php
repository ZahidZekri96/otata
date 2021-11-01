<div class="deznav">
    <div class="deznav-scroll">
        @if(Auth::user()->type == "admin")
        <a href="javascript:void(0)" class="add-menu-sidebar" data-toggle="modal" data-target="#addOrderModalside" >+ New Event</a>
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="event.html">Event</a></li>
                    <li><a href="event-detail.html">Event Detail</a></li>
                    <li><a href="customers.html">Customers</a></li>
                    <li><a href="analytics.html">Analytics</a></li>
                    <li><a href="reviews.html">Reviews</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Event</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="" >List Event</a>
                    </li>
                    <li><a href="./post-details.html">Add New Event</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Payment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Subscription</a></li>
                    <li><a class="">Donation</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">User</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Customer</a></li>
                    <li><a class="">Admin / Staff</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Report</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Customer</a></li>
                    <li><a class="">Admin / Staff</a></li>
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
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="event.html">Event</a></li>
                    <li><a href="event-detail.html">Event Detail</a></li>
                    <li><a href="customers.html">Customers</a></li>
                    <li><a href="analytics.html">Analytics</a></li>
                    <li><a href="reviews.html">Reviews</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Event</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="" >List Event</a>
                    </li>
                    <li><a href="./post-details.html">Add New Event</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Payment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Subscription</a></li>
                    <li><a class="">Donation</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">User</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Customer</a></li>
                    <li><a class="">Admin / Staff</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Report</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="">Customer</a></li>
                    <li><a class="">Admin / Staff</a></li>
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