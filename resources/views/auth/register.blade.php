@extends('layout.authentication')
@section('title', 'Register')


@section('content')

<div class="auth_brand">
    <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/crmblack.png') }}"  class="d-inline-block img-fluid align-top mr-2" alt=""></a>
</div>
<div class="card">
    <div class="header">
        <p class="lead">Create an account</p>
    </div>
    <div class="body">
        <button class="btn btn-signin-social"><i class="fa fa-facebook-official facebook-color"></i> Sign in with Facebook</button>
        <div class="separator-linethrough"><span>OR</span></div>
        @if(Session::has('errorMsg'))
            <div class="alert alert-danger alert-message-display">{{Session::get('errorMsg')}}</div>
            @endif
            @if(Session::has('successMsg'))
            <div class="alert alert-success alert-message-display">{{Session::get('successMsg')}}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-message-display">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div  class="form-group c_form_group">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name" />
            </div>

            <div  class="form-group c_form_group">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" placeholder="Enter your email"  class="form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <div  class="form-group c_form_group">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control" placeholder="Enter your password"  type="password" name="password" required autocomplete="new-password" />
            </div>

            <div  class="form-group c_form_group">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" placeholder="re-enter your password"  class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div  class="form-group c_form_group">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-dark btn-lg btn-block">Register</button>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

            </div>
        </form>
    </div>
    </div>

    @stop

