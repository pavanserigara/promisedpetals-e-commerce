<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="min-h-screen pt-24 pb-12 flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-brand-50">
    <div class="sm:mx-auto sm:w-full sm:max-w-md animate-up">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-brand-900 font-serif">
            Join Our Community
        </h2>
        <p class="mt-2 text-center text-sm text-slate-600">
            Create an account to track orders and receive exclusive offers
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-up">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 glass">
            <form class="space-y-6" action="<?php echo URLROOT; ?>/users/register" method="POST">
                <?php csrf_field(); ?>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700"> Full Name </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['name_err'])) ? 'border-red-300' : 'border-slate-300'; ?> rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            value="<?php echo $data['name']; ?>">
                        <span class="text-red-500 text-xs mt-1"><?php echo $data['name_err']; ?></span>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700"> Email address </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['email_err'])) ? 'border-red-300' : 'border-slate-300'; ?> rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            value="<?php echo $data['email']; ?>">
                        <span class="text-red-500 text-xs mt-1"><?php echo $data['email_err']; ?></span>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700"> Password </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['password_err'])) ? 'border-red-300' : 'border-slate-300'; ?> rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            value="<?php echo $data['password']; ?>">
                        <span class="text-red-500 text-xs mt-1"><?php echo $data['password_err']; ?></span>
                    </div>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-slate-700"> Confirm Password
                    </label>
                    <div class="mt-1">
                        <input id="confirm_password" name="confirm_password" type="password" required
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['confirm_password_err'])) ? 'border-red-300' : 'border-slate-300'; ?> rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            value="<?php echo $data['confirm_password']; ?>">
                        <span class="text-red-500 text-xs mt-1"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transform transition hover:-translate-y-0.5">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500"> Already have an account? </span>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="<?php echo URLROOT; ?>/users/login"
                        class="font-medium text-brand-600 hover:text-brand-500"> Sign in here </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>