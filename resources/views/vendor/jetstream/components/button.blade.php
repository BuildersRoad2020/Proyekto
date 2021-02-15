<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white-800 border border-blue-800 rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-900 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
