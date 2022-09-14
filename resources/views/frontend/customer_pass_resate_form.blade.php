@extends('frontend.master')
@section('content')
   <div class="container">
        <div class="row"> 
            <div class="col-lg-8 m-auto">
                <div class="card my-5">
                    <div class="card-header">
                        <h3>Password Reset</h3>
                    </div>
                    <div class="card-body">
                          <form action="{{ route('pass.reset.update') }}" method="POST">
                          {{$token}}
                            @csrf
                             <div class="form-group mb-2">
                                <label for="" class="form-label">Enter New Password</label>
                               <input type="password" name="password" class="form-controll">
                             </div>
                             {{-- <div class="form-group mb-2">
                                <label for="" class="form-label">Conform password</label>
                               <input type="password" name="password_confirmation" class="form-control">
                             </div> --}}
                              <input type="hidden" name="reset_token" value="{{$token}}">
                             <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection