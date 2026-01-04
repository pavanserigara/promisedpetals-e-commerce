<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div
        class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[500px] h-[500px] bg-brand-100/50 rounded-full blur-3xl">
    </div>
    <div
        class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-blue-100/30 rounded-full blur-3xl">
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative animate-up">
        <div class="text-center mb-10">
            <span class="inline-block p-4 bg-white rounded-[2rem] shadow-xl text-4xl mb-6">🌸</span>
            <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">Welcome <span
                    class="text-brand-600">Back</span></h2>
            <p class="mt-4 text-slate-400 font-bold uppercase tracking-widest text-[10px]">Access your curated orders
            </p>
        </div>

        <div
            class="bg-white/80 backdrop-blur-xl py-10 px-8 shadow-2xl shadow-slate-200/50 sm:rounded-[2.5rem] border border-white/50 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-brand-400 to-brand-600"></div>

            <?php flash('register_success'); ?>

            <form class="space-y-8" action="<?php echo URLROOT; ?>/users/login" method="POST">
                <?php csrf_field(); ?>

                <div>
                    <label for="email"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2 ml-1">Email
                        Address</label>
                    <input id="email" name="email" type="email" required placeholder="your@email.com"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium <?php echo (!empty($data['email_err'])) ? 'ring-2 ring-red-400' : ''; ?>"
                        value="<?php echo $data['email']; ?>">
                    <span class="text-red-500 text-[10px] font-bold mt-1 ml-1"><?php echo $data['email_err']; ?></span>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label for="password"
                            class="block text-[10px] font-bold uppercase tracking-widest text-slate-400">Password</label>
                        <a href="#"
                            class="text-[10px] font-bold text-brand-600 hover:text-brand-800 uppercase tracking-widest transition-colors">Forgot?</a>
                    </div>
                    <input id="password" name="password" type="password" required placeholder="••••••••"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-700 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium <?php echo (!empty($data['password_err'])) ? 'ring-2 ring-red-400' : ''; ?>"
                        value="<?php echo $data['password']; ?>">
                    <span
                        class="text-red-500 text-[10px] font-bold mt-1 ml-1"><?php echo $data['password_err']; ?></span>
                </div>

                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-5 w-5 text-brand-600 focus:ring-brand-400 border-slate-200 rounded-lg transition-all">
                    <label for="remember-me"
                        class="ml-3 block text-xs font-bold text-slate-500 uppercase tracking-wide cursor-pointer">Remember
                        Presence</label>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-5 rounded-2xl font-bold text-sm shadow-xl hover:bg-black hover:-translate-y-1 transition-all active:scale-95">
                    Sign In
                </button>
            </form>

            <div class="mt-10 pt-10 border-t border-slate-100 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">New to the Boutique?</p>
                <a href="<?php echo URLROOT; ?>/users/register"
                    class="inline-block w-full border-2 border-slate-100 text-slate-600 py-4 rounded-2xl font-bold text-sm hover:border-brand-200 hover:text-brand-600 transition-all active:scale-95">Create
                    Account</a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>