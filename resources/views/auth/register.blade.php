<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Apellidos -->
            <div>
                <x-input-label for="apellidos" :value="__('Apellidos')" />
                <x-text-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos')" required autocomplete="apellidos" />
                <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
            </div>
            

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- calle  --}}
            <div>
                <x-input-label for="calle" :value="__('Calle')" />
                <x-text-input id="calle" class="block mt-1 w-full" type="text" name="calle" :value="old('calle')" required autocomplete="calle" />
                <x-input-error :messages="$errors->get('calle')" class="mt-2" />
            </div>

            {{-- numero  --}}
            <div>
                <x-input-label for="numero" :value="__('Numero')" />
                <x-text-input id="numero" class="block mt-1 w-full" type="number" name="numero" :value="old('numero')" required autocomplete="numero" />
                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
            </div>

            {{-- piso  --}}
            <div>
                <x-input-label for="piso" :value="__('Piso')" />
                <x-text-input id="piso" class="block mt-1 w-full" type="number" name="piso" :value="old('piso')" autocomplete="piso" />
                <x-input-error :messages="$errors->get('piso')" class="mt-2" />
            </div>

            {{-- puerta  --}}
            <div>
                <x-input-label for="puerta" :value="__('Puerta')" />
                <x-text-input id="puerta" class="block mt-1 w-full" type="text" name="puerta" :value="old('puerta')" maxlength="2" autocomplete="puerta" />
                <x-input-error :messages="$errors->get('puerta')" class="mt-2" />
            </div>

            {{-- codigo_postal  --}}
            <div>
                <x-input-label for="codigo_postal" :value="__('Codigo Postal')" />
                <x-text-input id="codigo_postal" class="block mt-1 w-full" type="text" name="codigo_postal" :value="old('codigo_postal')" maxlength="5" required autocomplete="codigo_postal" />
                <x-input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
            </div>

            {{-- ciudad  --}}
            <div>
                <x-input-label for="ciudad" :value="__('Ciudad')" />
                <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" :value="old('ciudad')" required autocomplete="ciudad" />
                <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
            </div>

            {{-- provincia  --}}
            <div>
                <x-input-label for="provincia" :value="__('Provincia')" />
                <x-text-input id="provincia" class="block mt-1 w-full" type="text" name="provincia" :value="old('provincia')" required autocomplete="provincia" />
                <x-input-error :messages="$errors->get('provincia')" class="mt-2" />
            </div>

            {{-- Pais  --}}
            <div>
                <x-input-label for="pais" :value="__('Pais')" />
                <x-text-input id="pais" class="block mt-1 w-full" type="text" name="pais" :value="old('pais')" required autocomplete="pais" />
                <x-input-error :messages="$errors->get('pais')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
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

    @if (\JoelButcher\Socialstream\Socialstream::show())
        <x-socialstream />
    @endif
</x-guest-layout>
