@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                        </div>
                    @endif
                    <div class="card">
                     <div class="card-header">{{ __('Verify OTP') }}</div>
                     <div class="card-body">
                     <form method="POST" action="{{ route('postverifyToken') }}">
                      @csrf
                      <div class="form-group row">
                      <label for="token" class="col-md-4 col-form-label text-md-right">{{_('Code_OTP')}}</label>
                      <div class="col-md-6">
                      <input id="activation_token" type="text" class="form-control" name="activation_token" required autocomplete="off"><br><br>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            </div>
                            </div>
                        <form class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{_('submit')}}
                            </button>
                            </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
