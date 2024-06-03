<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">
                    {{ __('Nombre') }}
                    <span class="text-red-500">*</span>
                </label>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Apellidos -->
            <div>
                <label for="apellidos" class="block font-medium text-sm text-gray-700">
                    {{ __('Apellidos') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos"
                    :value="old('apellidos')" required autocomplete="apellidos" />
                <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
            </div>


            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">
                    {{ __('Email') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- calle  --}}
            <div>
                <label for="calle" class="block font-medium text-sm text-gray-700">
                    {{ __('Calle') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="calle" class="block mt-1 w-full" type="text" name="calle"
                    :value="old('calle')" required autocomplete="calle" />
                <x-input-error :messages="$errors->get('calle')" class="mt-2" />
            </div>

            {{-- numero  --}}
            <div>
                <label for="numero" class="block font-medium text-sm text-gray-700">
                    {{ __('Numero') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="numero" class="block mt-1 w-full" type="number" name="numero"
                    :value="old('numero')" required autocomplete="numero" />
                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
            </div>

            {{-- piso  --}}
            <div>
                <label for="piso" class="block font-medium text-sm text-gray-700">
                    {{ __('Piso') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="piso" class="block mt-1 w-full" type="number" name="piso"
                    :value="old('piso')" autocomplete="piso" />
                <x-input-error :messages="$errors->get('piso')" class="mt-2" />
            </div>

            {{-- puerta  --}}
            <div>
                <label for="puerta" class="block font-medium text-sm text-gray-700">
                    {{ __('Puerta') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="puerta" class="block mt-1 w-full" type="text" name="puerta"
                    :value="old('puerta')" maxlength="2" autocomplete="puerta" />
                <x-input-error :messages="$errors->get('puerta')" class="mt-2" />
            </div>

            {{-- codigo_postal  --}}
            <div>
                <label for="codigo_postal" class="block font-medium text-sm text-gray-700">
                    {{ __('Codigo Postal') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="codigo_postal" class="block mt-1 w-full" type="text" name="codigo_postal"
                    :value="old('codigo_postal')" maxlength="5" required autocomplete="codigo_postal" />
                <x-input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
            </div>

            {{-- ciudad  --}}
            <div>
                <label for="ciudad" class="block font-medium text-sm text-gray-700">
                    {{ __('Ciudad') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                    :value="old('ciudad')" required autocomplete="ciudad" />
                <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
            </div>

            {{-- provincia  --}}
            <div>
                <label for="provincia" class="block font-medium text-sm text-gray-700">
                    {{ __('Provincia') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                    :value="old('provincia')" required autocomplete="provincia" />
                <x-input-error :messages="$errors->get('provincia')" class="mt-2" />
            </div>

            {{-- Pais  --}}
            <div>
                <label for="pais" class="block font-medium text-sm text-gray-700">
                    {{ __('Pais') }}
                    <span class="text-red-500">*</span>
                </label> <x-text-input id="pais" class="block mt-1 w-full" type="text" name="pais"
                    :value="old('pais')" required autocomplete="pais" />
                <x-input-error :messages="$errors->get('pais')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-medium text-sm text-gray-700">
                    {{ __('Password') }}
                    <span class="text-red-500">*</span>
                </label>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                    {{ __('Confirm Password') }}
                    <span class="text-red-500">*</span>
                </label>

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    @if (\JoelButcher\Socialstream\Socialstream::show())
        <x-socialstream />
    @endif
</x-guest-layout>
