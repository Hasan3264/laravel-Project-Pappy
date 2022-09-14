@extends('frontend.master')
@section('content')
   <div class="container">
        <div class="row"> 
            <div class="col-lg-8 m-auto">
                <div class="card my-5">
                    <div class="card-header">
                        <h3>Password Reset</h3>
                    </div>
                  @if (session('Send'))
                        <div class="card-body">
                         <div class="alert alert-success" role="alert">
                             {{session('Send')}}
                        </div>
                    </div>
                  @else
                      <div class="card-body">
                          <form action="{{ route('pass.reset.con') }}" method="POST">
                            @csrf
                             <div class="form-group mb-2">
                                <label for="" class="form-label">Enter Your email</label>
                               <input type="email" name="email" class="form-controll">
                             </div>
                             <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                          </form>
                    </div>
                  @endif
                </div>
            </div>
        </div>
   </div>
@endsection