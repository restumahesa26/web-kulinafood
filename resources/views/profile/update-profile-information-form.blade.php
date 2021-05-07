<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Username -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" autocomplete="username" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nama_lengkap" value="{{ __('Nama Lengkap') }}" />
            <x-jet-input id="nama_lengkap" type="text" class="mt-1 block w-full" wire:model.defer="state.nama_lengkap" autocomplete="nama_lengkap" />
            <x-jet-input-error for="nama_lengkap" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="tempat_lahir" value="{{ __('Tempat Lahir') }}" />
            <x-jet-input id="tempat_lahir" type="text" class="mt-1 block w-full" wire:model.defer="state.tempat_lahir" autocomplete="tempat_lahir" />
            <x-jet-input-error for="tempat_lahir" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="tanggal_lahir" value="{{ __('Tanggal Lahir') }}" />
            <x-jet-input id="tanggal_lahir" type="date" class="mt-1 block w-full" wire:model.defer="state.tanggal_lahir" autocomplete="tanggal_lahir" />
            <x-jet-input-error for="tanggal_lahir" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="no_identitas" value="{{ __('No Identitas') }}" />
            <x-jet-input id="no_identitas" type="text" class="mt-1 block w-full" wire:model.defer="state.no_identitas" autocomplete="no_identitas" />
            <x-jet-input-error for="no_identitas" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select rounded-md shadow-sm mt-1 block w-full" wire:model.defer="state.jenis_kelamin">
                <option value="Laki-Laki" @if (Auth::user()->jenis_kelamin == "Laki-Laki")
                    selected
                @endif>Laki-Laki</option>
                <option value="Perempuan" @if (Auth::user()->jenis_kelamin == "Perempuan")
                    selected
                @endif>Perempuan</option>
            </select>
            <x-jet-input-error for="jenis_kelamin" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
