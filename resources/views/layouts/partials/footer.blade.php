<footer class="footer-two">
    <div class="container">

        <div class="join-sec">
            <div>
                <h2>“আপনার প্রোপার্টি বিজ্ঞাপন দিন সহজেই”</h2>
                <p>মাত্র কয়েক মিনিটেই আপনার ফ্ল্যাট বা বাড়ির বিজ্ঞাপন প্রকাশ করুন এবং পৌঁছে যান হাজারো সম্ভাব্য ক্রেতা ও ভাড়াটিয়ার কাছে।</p>
            </div>
            @auth
                <a href="{{ route('filament.app.resources.properties.create') }}" class="btn btn-primary btn-lg"> Add Listing </a>
            @endauth

            @guest
                <a href="{{ route('filament.app.auth.login') }}" class="btn btn-primary btn-lg"> Log In </a>
            @endguest
        </div>

        <!-- Footer Top -->
        <div class="footer-top">
            <div class="row gy-4">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Company</h5>
                        <ul class="footer-menu">
                            <li><a href="{{ route('about.us') }}">About Us</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('filament.app.resources.properties.create') }}">Add Your Listing</a></li>
                        </ul>
                    </div>
                </div>

                <livewire:footer.top-destinations />

                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget footer-contacts">
                        <h5 class="footer-title">Reach Us</h5>
                        <div class="contact-info">
                            <h6>Location</h6>
                            <p>123 East 26th Street,Fifth Floor,New York, NY 10011</p>
                        </div>
                        <div class="contact-info">
                            <h6>Phone</h6>
                            <p>+1 34245 67678</p>
                        </div>
                        <div class="contact-info">
                            <h6>Email</h6>
                            <p><a href="https://dreamsestate.dreamstechnologies.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c5acaba3aa85a0bda4a8b5a9a0eba6aaa8">[email&#160;protected]</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget footer-subscribe">
                        <h5 class="footer-title">Newsletter</h5>
                        <div class="email-info">
                            <h6>Subscribe to Our Newsletter</h6>
                            <p>Just sign up and we'll send you a notification by email.</p>
                        </div>
                        <div class="d-flex align-items-center subscribe-wrap">
                            <div class="input-group input-group-flat">
										<span class="input-group-text">
											<i class="material-icons-outlined">email</i>
										</span>
                                <input type="email" class="form-control form-control-lg" placeholder="Enter Email Address">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="material-icons-outlined">send</i></button>
                        </div>
                        <div class="social-icon">
                            <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i></a>
                            <a href="javascript:void(0);"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                            <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="javascript:void(0);"><i class="fa-brands fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Footer Top -->

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <p class="copy-right">Copyright &copy; <script>document.write(new Date().getFullYear())</script>. All Rights Reserved, ENN Creation</p>
                <div class="policy-link">
                    <a href="privacy-policy.html">Privacy Policy</a>
                    <a href="javascript:void(0);">Legal Notice</a>
                    <a href="javascript:void(0);">Refund Policy</a>
                    <a href="terms-condition.html">Terms and Conditions</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Bottom -->

</footer>
