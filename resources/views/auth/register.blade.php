<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Columna 1 -->
            <div>
                <!-- Nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Apellidos -->
                <div class="mt-4">
                    <x-input-label for="apellidos" :value="__('Apellidos')" />
                    <x-text-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos"
                        :value="old('apellidos')" required autofocus autocomplete="apellidos" />
                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="calle" :value="__('Calle')" />
                    <x-text-input id="calle" class="block mt-1 w-full" type="text" name="calle"
                        :value="old('calle')" required />
                    <x-input-error :messages="$errors->get('calle')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="numero" :value="__('Número')" />
                    <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero"
                        :value="old('numero')" required />
                    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

            </div>

            <!-- Columna 2 -->
            <div>
                <!-- Direccion -->

                <div>
                    <x-input-label for="piso" :value="__('Piso')" />
                    <x-text-input id="piso" class="block mt-1 w-full" type="text" name="piso"
                        :value="old('piso')" />
                    <x-input-error :messages="$errors->get('piso')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="puerta" :value="__('Puerta')" />
                    <x-text-input id="puerta" class="block mt-1 w-full" type="text" name="puerta"
                        :value="old('puerta')" />
                    <x-input-error :messages="$errors->get('puerta')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="codigo_postal" :value="__('Código Postal')" />
                    <x-text-input id="codigo_postal" class="block mt-1 w-full" type="text" name="codigo_postal"
                        :value="old('codigo_postal')" required />
                    <x-input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="ciudad" :value="__('Ciudad')" />
                    <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad"
                        :value="old('ciudad')" required />
                    <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="provincia" :value="__('Provincia')" />
                    <x-text-input id="provincia" class="block mt-1 w-full" type="text" name="provincia"
                        :value="old('provincia')" required />
                    <x-input-error :messages="$errors->get('provincia')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="pais" :value="__('País')" />
                    <x-text-input id="pais" class="block mt-1 w-full" type="text" name="pais"
                        :value="old('pais')" required />
                    <x-input-error :messages="$errors->get('pais')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
</x-guest-layout>
