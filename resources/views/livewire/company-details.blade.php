<div data-turbolinks="false">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $id->name }}
            <span class="{{$id->status == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-green-800' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800' }}"> {{$id->status == 0 ? 'onHold' : 'Approved' }}</span>


        </h2>

    </x-slot>


    <div class="py-2 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(session()->has('message'))
                <div class="fixed top-0 right-0 bg-opacity-0 ">
                    <div class="text-right py-4 lg:px-4 rounded animate-fade-in-down" wire:poll.5000ms>
                        <div class="p-2 bg-green-500 items-center bg-opacity-75 text-green-100 leading-none rounded-full lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full bg-green-200 uppercase px-2 py-1 text-xs font-bold mr-3">
                                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z" />
                                    <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z" />
                                </svg>
                            </span>
                            <span class="font-semibold mr-2 text-left flex-auto"> {{ session('message') }} </span>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex justify-between ">
                    <div class="pt-2 relative">
                        <h2 class="font-semibold text-l text-blue-800 leading-tight pl-2"> Contractor Details </h2>
                    </div>
                </div>

                <div class="flex flex-wrap md:flex-wrap mt-2 mb-2 pl-2 ">

                    <div class="mr-2 w-full md:w-1/3 mb-1">
                        <x-jet-label for="address" value="{{ __('Street') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required wire:model.defer="address" />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    @if (!is_null($info->country))
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
                        <x-jet-input id="country" class="block mt-1 w-full" type="text" name="countries_id" :value="old('country')" required wire:model.defer="country" />
                        <x-jet-input-error for="country" class="mt-2" />
                    </div>
                    @endif

                    @empty ($info->country)
                    <div class="mr-2 w-full md:w-auto mb-1 mt-1">
                        <x-jet-label value="{{ __('Country') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedCountry">
                            <option value="" selected>Select a Country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedCountry" class="mt-2" />
                    </div>

                    @if (!is_null($states))
                    <div class="mr-2 w-full md:w-auto mb-1 mt-1">
                        <x-jet-label value="{{ __('State') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedState">
                            <option value="" disabled selected>Select a State</option>
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedState" class="mt-2" />
                    </div>
                    @endif
                    @if (!is_null($cities))
                    <div class="mr-2 w-full md:w-auto mb-1 mt-1">
                        <x-jet-label value="{{ __('City') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedCity">
                            <option value="" disabled selected>Select a City</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedCity" class="mt-2" />
                    </div>
                    @endif
                    @endempty
                    <div class="mr-2 w-full md:w-24 mb-1">
                        <x-jet-label for="postcode" value="{{ __('Postal Code') }}" />
                        <x-jet-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" required wire:model.defer="postcode" />
                        <x-jet-input-error for="postcode" class="mt-2" />
                    </div>

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

                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="abn" value="{{ __('ABN(Australian Business Number)') }}" />
                        <x-jet-input id="abn" class="block mt-1 w-full" type="text" name="abn" :value="old('abn')" required wire:model.defer="abn" />
                        <x-jet-input-error for="abn" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="bankname" value="{{ __('Bank') }}" />
                        <x-jet-input id="bankname" class="block mt-1 w-full" type="text" name="bankname" :value="old('bankname')" required wire:model.defer="bankname" />
                        <x-jet-input-error for="bankname" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="accountname" value="{{ __('Account Name') }}" />
                        <x-jet-input id="accountname" class="block mt-1 w-full" type="text" name="accountname" :value="old('accountname')" required wire:model.defer="accountname" />
                        <x-jet-input-error for="accountname" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="accountnumber" value="{{ __('Account Number') }}" />
                        <x-jet-input id="accountnumber" class="block mt-1 w-full" type="text" name="accountnumber" :value="old('accountnumber')" required wire:model.defer="accountnumber" />
                        <x-jet-input-error for="accountnumber" class="mt-2" />
                    </div>

                    <div class="mr-2 w-full md:w-1/5 mb-1">
                        <x-jet-label for="branch" value="{{ __('Branch') }}" />
                        <x-jet-input id="branch" class="block mt-1 w-full" type="text" name="branch" :value="old('branch')" required wire:model.defer="branch" />
                        <x-jet-input-error for="branch" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/6 mb-1">
                        <x-jet-label for="bsb" value="{{ __('BSB') }}" />
                        <x-jet-input id="bsb" class="block mt-1 w-full" type="text" name="bsb" :value="old('bsb')" required wire:model.defer="bsb" />
                        <x-jet-input-error for="bsb" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/6 mb-1">
                        <x-jet-label for="currency" value="{{ __('Currency') }}" />
                        <x-jet-input id="currency" class="block mt-1 w-full" type="text" name="currency" :value="old('currency')" required wire:model.defer="currency" />
                        <x-jet-input-error for="currency" class="mt-2" />
                    </div>
                    <div class="mr-2 w-full md:w-1/6 mb-1">
                        <x-jet-label for="terms" value="{{ __('Payment Terms') }}" />
                        <x-jet-input id="terms" class="block mt-1 w-full" type="text" name="terms" :value="old('terms')" required wire:model.defer="terms" />
                        <x-jet-input-error for="terms" class="mt-2" />
                    </div>
                </div>

                <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-blue-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest mb-2 ml-2 hover:bg-blue-300 border border-blue-5git 00 active:bg-blue-900 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 " wire:click="confirmEdit" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </button>
                <div wire:Loading> Just a sec ... </div>

            </div>
        </div>
    </div>
</div>