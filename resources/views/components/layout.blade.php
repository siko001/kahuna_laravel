<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kahuna Inc</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/bootstrap.min.css" />
    <link rel="stylesheet" href="/bootstrap-icons.css" />
    <link rel="stylesheet" href="/owl.carousel.min.css" />
    <link rel="stylesheet" href="/owl.theme.default.min.css" />
    <link href="/templatemo-pod-talk.css" rel="stylesheet" />
    <link rel="stylesheet" href="/overlay.css">
    <link rel="stylesheet" href="/thanksyou.css">
</head>

<body>
    <main>
        @if (Auth::guard('technician')->check())
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand me-lg-5 me-0" href="/">
                        <h1>Kahuna Techs</h1>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }} " href="/">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('register-product') ? 'active' : '' }}"
                                    href="/register-product">View all appliances</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Request::is('profile', 'product-settings') ? 'active' : '' }}"
                                    href="#" id="navbarLightDropdownMenuLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Account setting</a>

                                <ul class="dropdown-menu dropdown-menu-light"
                                    aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item  {{ request()->is('profile') ? 'active' : '' }}"
                                            href="/profile">Your profile </a></li>

                                    <li><a class="dropdown-item {{ request()->is('product-settings') ? 'active' : '' }}"
                                            href="/product-tech">Your Specializing products</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ request()->is('contact') ? 'active' : '' }}" href="/users">View
                                    Users</a>
                            </li>
                        </ul>

                        <div class="ms-4">
                            @if (Auth::guard('technician')->check())
                                <form action="{{ route('logout-tech') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn custom-btn custom-border-btn smoothscroll">Sign
                                        Out*</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        @else
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand me-lg-5 me-0" href="/">
                        <h1>Kahuna</h1>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }} " href="/">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('register-product') ? 'active' : '' }}"
                                    href="/register-product">Register A Product</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Request::is('profile', 'product-settings') ? 'active' : '' }}"
                                    href="#" id="navbarLightDropdownMenuLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Account setting</a>

                                <ul class="dropdown-menu dropdown-menu-light"
                                    aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item  {{ request()->is('profile') ? 'active' : '' }}"
                                            href="/profile">Your profile </a></li>

                                    <li><a class="dropdown-item {{ request()->is('product-settings') ? 'active' : '' }}"
                                            href="/product-settings">Your products</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ request()->is('contact') ? 'active' : '' }}"
                                    href="/contact">Contact
                                    us</a>
                            </li>
                        </ul>

                        <div class="ms-4">
                            @if (Auth::check())
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn custom-btn custom-border-btn smoothscroll">Sign
                                        Out</button>
                                </form>
                            @elseif(Auth::guard('technician')->check())
                                <form action="{{ route('logout-tech') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn custom-btn custom-border-btn smoothscroll">Sign
                                        Out*</button>
                                @else
                                    <a href="{{ '/sign-up' }}"
                                        class="btn custom-btn custom-border-btn smoothscroll">Sign
                                        in</a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

        @endif




        {{ $slot }}





        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    @if (Auth::guard('technician')->check())
                        <div class="col-lg-9 col-12 mb-5 mb-lg-0">
                            <div class="col-lg-6 col-md-6 col-12 mb-4 mb-md-0 mb-lg-0">
                                <h6 class="site-footer-title mb-3">Contact</h6>

                                <p class="mb-2"><strong class="d-inline me-2">Phone:</strong> +356-7701-0201</p>

                                <p>
                                    <strong class="d-inline me-2">Email:</strong>
                                    <a href="mailto:inquiry@kahuna.com" target="_blank">inquiry@kahuna.com</a>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                            <div class="subscribe-form-wrap">
                                <h6>Subscribe for Weekly Cooking Advice and Recipies</h6>

                                <form class="custom-form subscribe-form" action="#" method="POST"
                                    role="form">
                                    <input type="email" name="subscribe-email" id="subscribe-email"
                                        pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email Address"
                                        required="" />

                                    <div class="col-lg-12 col-12">
                                        <button type="submit" class="form-control" id="submit">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-md-0 mb-lg-0">
                            <h6 class="site-footer-title mb-3">Contact</h6>

                            <p class="mb-2"><strong class="d-inline me-2">Phone:</strong> +356-7701-0201</p>

                            <p>
                                <strong class="d-inline me-2">Email:</strong>
                                <a href="mailto:inquiry@kahuna.com" target="_blank">inquiry@kahuna.com</a>
                            </p>
                        </div>
                    @endif



                    <div class="col-lg-3 col-md-6 col-12">
                        <h6 class="site-footer-title mb-3">Download Mobile</h6>

                        <div class="site-footer-thumb mb-4 pb-2">
                            <div class="d-flex flex-wrap">
                                <a href="#">
                                    <img src="images/app-store.png" class="me-3 mb-2 mb-lg-0 img-fluid"
                                        alt="" />
                                </a>

                                <a href="#">
                                    <img src="images/play-store.png" class="img-fluid" alt="" />
                                </a>
                            </div>
                        </div>

                        <h6 class="site-footer-title mb-3">Social</h6>

                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container pt-5">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-12">
                        <a class="navbar-brand" href="/">
                            <h1>Kahuna</h1>
                        </a>
                    </div>

                    <div class="col-lg-7 col-md-9 col-12">
                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">

                                <a href="{{ Auth::guard('technician')->check() ? '/users' : '/' }}"
                                    class="site-footer-link">{{ Auth::guard('technician')->check() ? 'All Users' : 'Homepage' }}</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="{{ Auth::guard('technician')->check() ? '/add-product' : 'https://www.tasteofhome.com/collection/our-100-highest-rated-recipes-ever/' }}"
                                    class="site-footer-link">{{ Auth::guard('technician')->check() ? 'Add A New Product' : 'Recipies' }}</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="{{ Auth::guard('technician')->check() ? '/login-tech' : '/help' }}"
                                    class="site-footer-link">{{ Auth::guard('technician')->check() ? 'Login Tech' : 'Help Center' }}</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="{{ Auth::guard('technician')->check() ? '/register-tech' : '/contact' }}"
                                    class="site-footer-link">{{ Auth::guard('technician')->check() ? 'Register Tech' : 'Contact Us' }}</a>
                            </li>
                            <li class="site-footer-link-item">
                                <a href="{{ Auth::guard('technician')->check() ? '/login' : '/login-tech' }}"
                                    class="site-footer-link">{{ Auth::guard('technician')->check() ? 'User Login' : 'Tech Login' }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-12">
                        <p class="copyright-text mb-0">
                            Copyright © 2023 Kahuna <br /><br />
                            Design: <a rel="nofollow" href="http://neilmalliaportfolio.infinityfreeapp.com/"
                                target="_parent">Neil Mallia</a>
                        </p>
                        Distribution: <a rel="nofollow" href="http://neilmalliaportfolio.infinityfreeapp.com/"
                            target="_blank">Neil Mallia</a>
                    </div>
                </div>
            </div>

            <div class="preview" id="preview-adding">
                <div class="glass">
                    <h2 class="overlay-text">
                        <span class="hidden">Product Registered Successfully<br>
                            <div onclick="closeOverlayAdd()"><i class="bi bi-x-square"></i> </div>
                        </span>
                        <div class="spinner"></div>
                    </h2>
                </div>
            </div>


            <div class="preview" id="preview-remove">
                <div class="glass">
                    <div class="overlay-text">
                        <span class="hidden">
                            <h2>Are you sure you want to delete this Product?<br> </h2>
                            <h2 style="padding-left:30px;" id="go-back" class="display">
                                <div class="display go-back" onclick="closeOverlayRemove()"><i
                                        class="bi bi-x-square"></i> </div>
                            </h2>

                            <div class="display">
                                <p class="display"><span class="hover-text-back"
                                        style="color:black;padding-right:20px; margin-left:-20px;">Cancel
                                        Delete</span>
                                </p>
                            </div>

                            <h2 id="go-forward" class="display">
                                <div class="display go-forward" id="go-forward"
                                    onclick="closeOverlayRemoveProceed()"><i class="bi bi-check-square"></i></div>

                            </h2>
                            <div class="display">
                                <p class="display"><span class="hover-text-delete"
                                        style="color:black;margin-left:-20px;">Proceed
                                        with Delete</span>
                                </p>
                            </div>
                        </span>
                        <div id="spinner" class="spinner"></div>
                        </h2>
                    </div>
                </div>



        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/overlay.js"></script>
        <script src="js/val.js"></script>
</body>

</html>
