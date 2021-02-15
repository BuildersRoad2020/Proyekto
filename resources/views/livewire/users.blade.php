<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-6">
        <div class="flex justify-between">
            <div class="pt-2 relative text-gray-600">
                <input wire:model.debounce.500ms="q" class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" type="search" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
            </div>         
        </div>

        <div class="mt-2">
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            User
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Email
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Role
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> User </span>
                            {{$user->name }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Email</span>
                            {{$user->email}}
                        </td>

                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Role</span>
                            @foreach ($user->RoleUser as $role)

                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Role</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $role->role_id === 1 ? 'Admin' : '' }} {{ $role->role_id === 2 ? 'Vendor' : '' }} {{ $role->role_id === 3 ? 'Technician' : '' }} </span>
                            @endforeach
                        </td>

                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Actions</span>
                            <x-jet-button wire:click="confirmContractorDeletion( {{$user->id }})" wire:loading.attr="disabled">
                                {{ __('EDIT') }}
                                </x-jet-danger-button>


                                <x-jet-danger-button wire:click="confirmContractorDeletion( {{$user->id }})" wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </x-jet-danger-button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
        {{ $users->links() }}
    </div>
    </div>
</div>