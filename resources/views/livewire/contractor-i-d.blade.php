<div data-turbolinks="false">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $id->name }}
            <span class="{{$id->status == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-green-800' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800' }}"> {{$id->status == 0 ? 'onHold' : 'Approved' }}</span>


        </h2>

    </x-slot>


    <div class="py-12 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="flex justify-between">
                    <div class="pt-2 relative">
                        <h2 class="font-semibold text-l text-blue-800 leading-tight pl-2"> Contractor Details </h2>
                    </div>
                    <div class="mt-2 mr-4">
                        <label class="inline-flex items-center mr-auto">
                            <select class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" :value="old('status')" wire:model.debounce.2000000ms="status">
                                <option value="0">on Hold</option>
                                <option value="1">Approved</option>
                            </select>
                        </label>
                    </div>
                </div>

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
                    <div class="mr-2 w-full md:w-24 mb-1">
                        <x-jet-label for="postcode" value="{{ __('Postal Code') }}" />
                        <x-jet-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" required wire:model.defer="postcode" />
                        <x-jet-input-error for="postcode" class="mt-2" />
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

                <button class="inline-flex items-center px-4 py-2 bg-blue-500 border border-blue-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest mb-2 ml-2 hover:bg-blue-300 border border-blue-5git 00 active:bg-blue-900 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 " wire:click="$set('confirmingEdit', true)" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </button>

            </div>
        </div>
    </div>

<!-- Edit Modal -->
        <x-jet-dialog-modal wire:model="confirmingEdit">
            <x-slot name="title">
                {{ __('Update Contractor') }}
            </x-slot>

            <x-slot name="content">
                    {{ __('Are you sure you want to update this contractor?') }}
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="confirmEdit" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirmingEdit', false)" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

</div>