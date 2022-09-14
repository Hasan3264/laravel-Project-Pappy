@extends('frontend\master')
@section('content')
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            @if (session('verify_email'))
                <div class="alert alert-success">{{ session('verify_email') }}</div>
            @else
            <div class="col-lg-8">

                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Sign In</button>
                    </li>
                    <li role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                    </li>
                </ul>

                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                        <form action="{{route('customer.login')}}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-user"></i></label>
                                    <input id="email_input" type="email" name="email" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input"><i class="fas fa-lock"></i></label>
                                    <input id="password_input" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="checkbox_item">
                                  <a href="{{ route('passsword.reset') }}">Forgot your password?</a>
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_primary">Sign In</button>
                            </div>
                            <div class="form_item_wrap">
                               <div class="form-group">
                                <ul class="d-flex" style="list-style-type: none; padding:0; margin:0; margin-top:20px;">
                                    <li style="font-weight: 900;" class="btn btn-primary">Sign with</li>
                                   <li style="margin-left: 10px; padding:6px 0px;"><a  href="{{ url('/github/redirect') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a></li>
                                   <li style="margin-left: 10px; padding:6px 0px;"><a href="{{ url('/google/redirect')}}"><i>Google</i> </a></li>
                                   <li style="margin-left: 10px; padding:6px 0px;"><a href="{{ url('/facebook/callback')}}"><i>facebook</i></a></li>
                                </ul>
                               </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                        <form action="{{ route('customer.insert') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">User Name*</h3>
                                <div class="form_item">
                                    <label for="username_input2"><i class="fas fa-user"></i></label>
                                    <input id="username_input2" type="text" name="name" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-envelope"></i></label>
                                    <input id="email_input" type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form_item_wrap">
                                <h3 class="input_title">Confirm Password</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>


                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_secondary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>



<!-- register_section - end
================================================== -->



@endsection
