@section('title')
    <title>Register</title>
@endsection

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors />

        <form method="POST" action="{{ route('register') }}">
            @csrf            
            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            </div>

            <div>
                <x-jet-label for="nama_lengkap" value="{{ __('Nama Lengkap') }}" />
                <x-jet-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required autofocus autocomplete="nama_lengkap" />
            </div>

            <div>
                <x-jet-label for="tempat_lahir" value="{{ __('Tempat Lahir') }}" />
                <x-jet-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required autofocus autocomplete="tempat_lahir" />
            </div>

            <div>
                <x-jet-label for="tanggal_lahir" value="{{ __('Tanggal Lahir') }}" />
                <x-jet-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required autofocus autocomplete="tanggal_lahir" />
            </div>

            <div>
                <x-jet-label for="no_identitas" value="{{ __('No Identitas') }}" />
                <x-jet-input id="no_identitas" class="block mt-1 w-full" type="text" name="no_identitas" :value="old('no_identitas')" required autofocus autocomplete="no_identitas" />
            </div>

            <div>
                <x-jet-label for="jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
                <x-jet-input id="jenis_kelamin" class="form-control" type="radio" name="jenis_kelamin" value="Laki-Laki" required autofocus autocomplete="jenis_kelamin" />Laki-Laki
                <x-jet-input id="jenis_kelamin" class="form-control" type="radio" name="jenis_kelamin" value="Perempuan" required autofocus autocomplete="jenis_kelamin" />Perempuan
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
