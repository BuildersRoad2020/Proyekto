<div data-turbolinks="false">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $status->name }}
            <span class="{{$status->status == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-green-800' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800' }}"> {{$status->status == 0 ? 'onHold' : 'Approved' }}</span>


        </h2>

    </x-slot>


    <div class="py-12 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h2 class="font-semibold text-l text-blue-800 leading-tight mb-2 pt-2 pl-2"> Contractor Details </h2>
                <div class="flex flex-wrap md:flex-wrap mt-2 mb-2 pl-2 ">

                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="name_primarycontact" value="{{ __('Contact Person') }}" />
                        <x-jet-input id="name_primarycontact" class="block mt-1 w-full" type="text" name="name_primarycontact" :value="old('name_primarycontact')" required wire:model.defer="name_primarycontact" />
                        <x-jet-input-error for="name_primarycontact" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="phone_primary" value="{{ __('Contact Number') }}" />
                        <x-jet-input id="phone_primary" class="block mt-1 w-full" type="text" name="phone_primary" :value="old('phone_primary')" required wire:model.defer="phone_primary" />
                        <x-jet-input-error for="phone_primary" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="email_primary" value="{{ __('Email') }}" />
                        <x-jet-input id="email_primary" class="block mt-1 w-full" type="email" name="email_primary" :value="old('email_primary')" required wire:model.defer="email_primary" />
                        <x-jet-input-error for="email_primary" class="mt-2" />
                    </div>


                    <div class="mr-2 w-full md:w-1/3 mb-1">
                        <x-jet-label for="address" value="{{ __('Street') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required wire:model.defer="address" />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="city" value="{{ __('City') }}" />
                        <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required wire:model.defer="city" />
                        <x-jet-input-error for="city" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="state" value="{{ __('State') }}" />
                        <x-jet-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" required wire:model.defer="state" />
                        <x-jet-input-error for="state" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="country" value="{{ __('Country') }}" />
                        <x-jet-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required wire:model.defer="country" />
                        <x-jet-input-error for="country" class="mt-2" />
                    </div>

                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="name_secondarycontact" value="{{ __('Alternate Contact Person') }}" />
                        <x-jet-input id="name_secondarycontact" class="block mt-1 w-full" type="text" name="name_secondarycontact" :value="old('name_secondarycontact')" required wire:model.defer="name_secondarycontact" />
                        <x-jet-input-error for="name_secondarycontact" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="phone_secondary" value="{{ __('Alternate Contact Number') }}" />
                        <x-jet-input id="phone_secondary" class="block mt-1 w-full" type="text" name="phone_secondary" :value="old('phone_secondary')" required wire:model.defer="phone_secondary" />
                        <x-jet-input-error for="phone_secondary" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="email_secondary" value="{{ __('Alternate Email') }}" />
                        <x-jet-input id="email_secondary" class="block mt-1 w-full" type="email" name="email_secondary" :value="old('email_secondary')" required wire:model.defer="email_secondary" />
                        <x-jet-input-error for="email_secondary" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-1 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h2 class="font-semibold text-l text-blue-800 leading-tight mb-2 pt-2 pl-2"> Financial Details </h2>
                <div class="flex flex-wrap md:flex-wrap mt-2 mb-2 pl-2 ">

                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="name_secondarycontact" value="{{ __('Alternate Contact Person') }}" />
                        <x-jet-input id="name_secondarycontact" class="block mt-1 w-full" type="text" name="name_secondarycontact" :value="old('name_secondarycontact')" required wire:model.defer="name_secondarycontact" />
                        <x-jet-input-error for="name_secondarycontact" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="phone_secondary" value="{{ __('Alternate Contact Number') }}" />
                        <x-jet-input id="phone_secondary" class="block mt-1 w-full" type="text" name="phone_secondary" :value="old('phone_secondary')" required wire:model.defer="phone_secondary" />
                        <x-jet-input-error for="phone_secondary" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/4 mb-1">
                        <x-jet-label for="email_secondary" value="{{ __('Alternate Email') }}" />
                        <x-jet-input id="email_secondary" class="block mt-1 w-full" type="email" name="email_secondary" :value="old('email_secondary')" required wire:model.defer="email_secondary" />
                        <x-jet-input-error for="email_secondary" class="mt-2" />
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>