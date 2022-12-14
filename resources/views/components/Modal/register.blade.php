<div class="hidden modal overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
    id="registerModal">

    <div class="relative w-128 my-6 mx-auto max-w-md">

        <!--content-->
        <div
            class="border-0 rounded-xl shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">

            <!--header-->
            <div class="p-5 rounded-t-xl text-center mt-16 mx-10">

                <h3 class="text-2xl font-semibold">
                    Sign up to
                </h3>

                <a class="pl-10" href="{{ route('index') }}">
                    <div class="pl-10">
                        <img src="{{ asset('/assets/images/logo.png') }}" alt="" class=" pl-10">
                    </div>
                </a>

                <p class="text-gray-400 mt-1 text-sm">
                    Join UWHcamp and start your real project
                </p>

            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!--body-->
                <div class="relative p-6 flex-auto mx-10">

                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm mb-2" for="username">
                            Name
                        </label>

                        <input name="name"
                            class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 placeholder-serv-text text-xs"
                            id="username" type="text" placeholder="Your name" required>

                        @if ($errors->has('name'))
                            <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm mb-2" for="email">
                            Email
                        </label>

                        <input name="email"
                            class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 placeholder-serv-text text-xs"
                            id="email" type="email" placeholder="name@domain.com" required>

                        @if ($errors->has('email'))
                            <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-grey-darker text-sm mb-2" for="password_confirmation">
                            Password
                        </label>

                        <input name="password"
                            class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 placeholder-serv-text text-xs mb-3"
                            id="password_confirmation" type="password" placeholder="At least 8 characters" required>

                        @if ($errors->has('password'))
                            <p class="text-red-500 mb-3 text-sm">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-grey-darker text-sm mb-2" for="password">
                            Confirm Password
                        </label>

                        <input name="password_confirmation"
                            class="appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 placeholder-serv-text text-xs mb-3"
                            id="password" type="password" placeholder="At least 8 characters" required>

                        @if ($errors->has('password_confirmation'))
                            <p class="text-red-500 mb-3 text-sm">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="inline-block text-xs text-gray-400">
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox"
                                    class="form-checkbox h-5 w-5 text-serv-button rounded border-serv-text"><span
                                    class="ml-2 text-gray-400">I agree to the <a href="#"
                                        class="text-serv-button">Terms
                                        & Conditions</a></span>
                            </label>
                        </div>
                    </div>

                </div>

                <!--footer-->
                <div class="px-6 rounded-b-xl mx-10">
                    <input type="hidden" name="auth" value="true">
                    <button
                        class="block text-center bg-serv-button text-white text-lg py-2 px-12 rounded-lg w-full hover:text-serv-login1-text hover:bg-gray600">
                        Sign up
                    </button>

                    <div
                        class="border border-gray-300 hover:bg-gray-300 bg-serv-explore-button rounded-lg flex text-center items-center space-x-2 my-3 mx-10 px-4">
                        <img src="/assets/images/ic_google.svg"
                            class="object-cover object-center rounded-full my-3 mr-1" alt="">
                        <a class="inline-block font-medium text-serv-button"
                            href="{{ route('user.login.google') }}">Sign Up with Google
                        </a>
                    </div>

                    <p href="#" class="text-center py-2">
                        Already have account? <a href="#" class="text-serv-button"
                            onclick="toggleModal('loginModal');toggleModal('registerModal') ">Sign in</a>
                    </p>


                </div>
            </form>


        </div>
    </div>
</div>

<div class="hidden opacity-75 fixed inset-0 z-40 bg-black" id="registerModal-backdrop"></div>
