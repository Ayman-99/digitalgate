@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Profile</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Profile</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- section -->
    <section class="section section--last">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile">
                        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">My purchases</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Settings</a>
                            </li>
                        </ul>

                        <button class="profile__logout" type="button">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive table-responsive--border">
                                <table class="profile__table">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Product</th>
                                        <th>Title</th>
                                        <th>Platform</th>
                                        <th>Date</th>
                                        <th>Pice</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td><a href="#">8451</a></td>
                                        <td>
                                            <div class="profile__img">
                                                <img src="img/cards/5.jpg" alt="">
                                            </div>
                                        </td>
                                        <td>Desperados III Digital Deluxe Edition</td>
                                        <td>XBOX</td>
                                        <td>Aug 22, 2020</td>
                                        <td><span class="profile__price">$49.00</span></td>
                                        <td><span class="profile__status">Not confirmed</span></td>
                                        <td><button class="profile__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">8126</a></td>
                                        <td>
                                            <div class="profile__img">
                                                <img src="img/cards/7.jpg" alt="">
                                            </div>
                                        </td>
                                        <td>Red Dead Redemption 2</td>
                                        <td>PC</td>
                                        <td>July 22, 2020</td>
                                        <td><span class="profile__price">$59.00</span></td>
                                        <td><span class="profile__status profile__status--confirmed">Confirmed</span></td>
                                        <td><button class="profile__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">7314</a></td>
                                        <td>
                                            <div class="profile__img">
                                                <img src="img/cards/3.jpg" alt="">
                                            </div>
                                        </td>
                                        <td>Baldur's Gate II: Enhanced Edition</td>
                                        <td>PC</td>
                                        <td>June 12, 2019</td>
                                        <td><span class="profile__price">$38.99</span></td>
                                        <td><span class="profile__status profile__status--cenceled">Canceled</span></td>
                                        <td><button class="profile__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- paginator -->
                        <div class="col-12">
                            <div class="paginator">
                                <div class="paginator__counter">
                                    3 from 9
                                </div>

                                <ul class="paginator__wrap">
                                    <li class="paginator__item paginator__item--prev">
                                        <a href="#">
                                            <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='244 400 100 256 244 112' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='120' y1='256' x2='412' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                                        </a>
                                    </li>
                                    <li class="paginator__item paginator__item--active"><a href="#">1</a></li>
                                    <li class="paginator__item"><a href="#">2</a></li>
                                    <li class="paginator__item"><a href="#">3</a></li>
                                    <li class="paginator__item paginator__item--next">
                                        <a href="#">
                                            <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='268 112 412 256 268 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='392' y1='256' x2='100' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end paginator -->
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                    <div class="row">
                        <!-- details form -->
                        <div class="col-12 col-lg-6">
                            <form action="#" class="form">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="form__title">Profile details</h4>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="username">Username</label>
                                        <input id="username" type="text" name="username" class="form__input" placeholder="User 123">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="email">Email</label>
                                        <input id="email" type="text" name="email" class="form__input" placeholder="email@email.com">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="firstname">First Name</label>
                                        <input id="firstname" type="text" name="firstname" class="form__input" placeholder="John">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="lastname">Last Name</label>
                                        <input id="lastname" type="text" name="lastname" class="form__input" placeholder="Doe">
                                    </div>

                                    <div class="col-12">
                                        <button class="form__btn" type="button">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end details form -->

                        <!-- password form -->
                        <div class="col-12 col-lg-6">
                            <form action="#" class="form">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="form__title">Change password</h4>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="oldpass">Old Password</label>
                                        <input id="oldpass" type="password" name="oldpass" class="form__input">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="newpass">New Password</label>
                                        <input id="newpass" type="password" name="newpass" class="form__input">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="form__label" for="confirmpass">Confirm New Password</label>
                                        <input id="confirmpass" type="password" name="confirmpass" class="form__input">
                                    </div>

                                    <div class="col-12">
                                        <button class="form__btn" type="button">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end password form -->
                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </section>
    <!-- end section -->
@endsection
