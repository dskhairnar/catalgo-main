<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
            class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror">
        @error('email')
            <span class="text-red-500 text-sm" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password"
            class="w-full px-3 py-2 border rounded-lg @error('password') border-red-500 @enderror">
        @error('password')
            <span class="text-red-500 text-sm" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                class="form-checkbox">
            <span class="ml-2">Remember Me</span>
        </label>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Login
        </button>

        @if (Route::has('password.request'))
            <a class="text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        @endif
    </div>
</form>