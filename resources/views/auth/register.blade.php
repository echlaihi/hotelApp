{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

--}}


@extends('layouts.main')

@section("content")

<style type="text/css">
    /*fieldset{
        display: flex;
    }

    label{
        width: 40% !important;
        border: 1px solid red;
        display: flex;
    }

    input{
        width: 60%;
    }*/
</style>

    <section id="login">

        <div class="wrapper">
                    <h1>S'inscrir</h1>

            <form  id="registerForm" action="{{ route('register') }}" method="POST"> 
                @csrf

                <fieldset>
                    @error("first_name")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label>Votre Prenom: </label>
                    <input type="text" name="first_name">
                </fieldset>

                  <fieldset>

                    @error("last_name")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label>Votre Nom: </label>
                    <input type="text" name="last_name">
                </fieldset>

                  <fieldset>

                    @error("cin")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label>Votre cin: </label>
                    <input type="text" name="cin">
                </fieldset>

                  <fieldset>

                    @error("email")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email">Votre email: </label>
                    <input type="email" name="email">
                </fieldset>


                <fieldset>
                    @error("password")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="message">Votre mot de passe: </label>
                    <input type="password" name="password" id="">
                </fieldset>

                <fieldset>
                    <label>Confirmer votre mot de passe</label>
                    <input type="password" name="password_confirmation">
                </fieldset>


                <fieldset>
                    <button type="submit" onclick="document.querySelector('#registerForm').submit()" name="submit">S'inscrir</button>
                </fieldset>              
            </form>

        </div>
    
        
   </section>
@endsection
