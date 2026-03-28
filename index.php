```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPM International School | Abuja</title>

    <!-- Bootstrap 5 CDN -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (local, with CDN fallback) -->
    <link rel="stylesheet" href="assets/icons.min.css" onerror="this.onerror=null;this.href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- AOS Animation Library -->
    <link href="assets/aos-css.css" rel="stylesheet">
    <link href="assets/theme.css" rel="stylesheet">

    <style>
        /* Navbar dropdown on hover */
        .navbar .dropdown:hover>.dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .navbar .dropdown-toggle::after {
            margin-left: .3rem;
        }
    </style>

</head>

<body>
    <!-- ==================== NAVIGATION BAR ==================== -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="brand-logo">CPM</span>
                <span class="fs-5 fw-lighter text-dark">School</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#why-choose">Why Choose Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="dropdown ms-lg-4">
                    <a href="#" class="btn btn-teal dropdown-toggle" id="applyNowDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Login
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="applyNowDropdown">
                        <li><a class="dropdown-item" href="admin/login.php">Admin Login</a></li>
                        <li><a class="dropdown-item" href="student/login.php">Student Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO SECTION ==================== -->
    <section id="home" class="hero text-white">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 hero-content" data-aos="fade-up">
                    <h1 class="display-3 fw-bold mb-3" data-aos="fade-up" data-aos-delay="100">
                        Shaping Leaders of Tomorrow
                    </h1>
                    <p class="lead fs-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                        CPM International School
                    </p>
                    <p class="fs-5 mb-5 opacity-90" data-aos="fade-up" data-aos-delay="300">
                        Excellence in Academics<span style="font-size: 10px;"> &hearts;</span> Character<span style="font-size: 10px;"> &hearts;</span> Innovation<span style="font-size: 10px;"> &hearts;</span> Since 2002
                    </p>
                    <a href="#contact"
                        class="btn btn-teal btn-lg px-5 py-3 fs-5"
                        data-aos="fade-up"
                        data-aos-delay="400">
                        Apply Now for 2026/2027 Session
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-5 text-center">
            <i class="bi bi-chevron-down fs-3 animate-bounce" style="animation: bounce 2s infinite;"></i>
        </div>
    </section>

    <!-- ==================== ABOUT SECTION ==================== -->
    <section id="about" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <!-- Left Text -->
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="badge bg-teal text-white px-3 py-2 mb-3">EST. 2002 | ABUJA</span>
                    <h2 class="section-title display-5 fw-bold mb-4">About CPM International School</h2>
                    <p class="lead text-muted">
                        Located in the heart of Suleja, Niger State, CPM International School is a world-class secondary institution
                        that combines the Nigerian National Curriculum with international best practices.
                    </p>
                    <p class="mb-4">
                        We provide a nurturing environment where students develop academically, socially,
                        and morally. Our graduates consistently gain admission into top Nigerian universities and over shores.
                    </p>

                    <div class="row g-4 mt-4">
                        <!-- Mission -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="d-flex">
                                <i class="bi bi-bullseye fs-2 text-teal me-3"></i>
                                <div>
                                    <h5 class="fw-bold">Our Mission</h5>
                                    <p class="small text-muted">
                                        To inspire and equip every student with knowledge, skills, and values for global leadership.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Vision -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="d-flex">
                                <i class="bi bi-eye fs-2 text-teal me-3"></i>
                                <div>
                                    <h5 class="fw-bold">Our Vision</h5>
                                    <p class="small text-muted">
                                        To be Nigeria's most respected secondary school, producing leaders of integrity and innovation.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="img/press.jpeg"
                        alt="CPM International School Campus - Abuja"
                        class="img-fluid rounded-4 shadow-lg">
                    <div class="text-center mt-3">
                        <!-- <small class="text-muted">Our beautiful Suleja campus</small> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== WHY CHOOSE US SECTION ==================== -->
    <section id="why-choose" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge bg-teal px-4 py-2">EXCELLENCE</span>
                <h2 class="section-title display-5 fw-bold">Why Choose Us</h2>
                <p class="lead text-muted col-lg-8 mx-auto">
                    Rasons parents and students trust us with their future
                </p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="50">
                    <div class="why-card card h-100 text-center p-4">
                        <div class="why-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <h5 class="fw-bold">Academic Excellence</h5>
                        <p class="text-muted">89% WAEC/NECO success rate for 5 consecutive years.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="why-card card h-100 text-center p-4">
                        <div class="why-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-bold">Qualified Teachers</h5>
                        <p class="text-muted">Greater percentage of our teachers hold degrees and have professional teaching experience.</p>
                    </div>
                </div>

                <!-- Card 3 -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="why-card card h-100 text-center p-4">
                        <div class="why-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h5 class="fw-bold">Holistic Development</h5>
                        <p class="text-muted">Drama, music, debate, entrepreneurship clubs | we nurture every talent.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== GALLERY SECTION ==================== -->
    <section id="gallery" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title display-5 fw-bold">Photo Gallery</h2>
                <p class="lead text-muted">Moments that define our community</p>
            </div>

            <div class="row g-4">
                <!-- Gallery Item 1 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="100">
                    <img src="img/img1.jpeg"
                        alt="Aerial view of CPM School Campus"
                        class="gallery-img w-100 shadow">
                </div>

                <!-- Gallery Item 2 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="200">
                    <img src="img/img5.jpeg"
                        alt="Students in Science Laboratory"
                        class="gallery-img w-100 shadow">
                </div>

                <!-- Gallery Item 3 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="300">
                    <img src="img/img6.jpeg"
                        alt="Sports Day at CPM"
                        class="gallery-img w-100 shadow">
                </div>

                <!-- Gallery Item 4 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="400">
                    <img src="img/img9.jpeg"
                        alt="Graduation Ceremony"
                        class="gallery-img w-100 shadow">
                </div>

                <!-- Gallery Item 5 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="500">
                    <img src="img/img3.jpeg"
                        alt="Library Reading Session"
                        class="gallery-img w-100 shadow">
                </div>

                <!-- Gallery Item 6 -->
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="zoom-in" data-aos-delay="600">
                    <img src="img/img2.jpeg"
                        alt="Cultural Day Performance"
                        class="gallery-img w-100 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CONTACT / CTA SECTION ==================== -->
    <section id="contact" class="cta-section py-5 text-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <!-- Left CTA -->
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-3">Ready to Join the CPM Family?</h2>
                    <p class="lead opacity-90 mb-4">
                        Limited spaces available for the 2026/2027 academic session.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" onclick="alert('Application form would open here in production')"
                            class="btn btn-light btn-lg px-5 py-3 fw-semibold">
                            Start Application
                        </a>
                        <a href="tel:+2348031234567" class="btn btn-outline-light btn-lg px-5 py-3">
                            <i class="bi bi-telephone"></i> Call 09064457846
                        </a>
                    </div>
                </div>

                <!-- Right Contact Form -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark mb-4">Get in Touch</h4>

                            <form id="contactForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-lg" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" class="form-control form-control-lg" placeholder="Phone Number" required>
                                    </div>
                                    <div class="col-12">
                                        <input type="email" class="form-control form-control-lg" placeholder="Email Address" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control form-control-lg" rows="4"
                                            placeholder="Message or enquiry"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-teal w-100 py-3 fw-bold">
                                            SEND MESSAGE
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer text-white py-5">
        <div class="container">
            <div class="row g-5">
                <!-- School Info -->
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <span class="text-teal">CPM</span> International School
                    </h5>
                    <p class="opacity-75">
                        Opposite field base, 1st gate<br>
                        Suleja, Niger State,<br>
                        Nigeria.
                    </p>
                    <p class="small opacity-75">
                        Established 2002 • Approved by FCT Ministry of Education
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#about" class="text-white opacity-75 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#why-choose" class="text-white opacity-75 text-decoration-none">Why CPM</a></li>
                        <li class="mb-2"><a href="#gallery" class="text-white opacity-75 text-decoration-none">Gallery</a></li>
                        <li class="mb-2"><a href="#" class="text-white opacity-75 text-decoration-none">Admissions</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Contact Us</h6>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-telephone-fill me-3"></i>
                        <div>
                            <a href="tel:+2348031234567" class="text-white opacity-75 text-decoration-none">08050470948</a><br>
                            <a href="tel:+2348098765432" class="text-white opacity-75 text-decoration-none">09064457846</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-envelope-fill me-3"></i>
                        <a href="mailto:info@cpminternationalschool.edu.ng"
                            class="text-white opacity-75 text-decoration-none">cpminternational2022@gmail.com</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill me-3"></i>
                        <span class="opacity-75">Suleja, Niger State</span>
                    </div>
                </div>

                <!-- Social -->
                <div class="col-lg-3">
                    <!-- <h6 class="fw-bold mb-3">Follow Us</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white fs-3"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-white fs-3"><i class="bi bi-youtube"></i></a>
                    </div> -->

                    <div class="mt-5">
                        <small class="opacity-50">© 2026 CPM International School. All Rights Reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="assets/bootstrap.min.js"></script>
    <!-- AOS JS -->
    <script src="assets/aos-animate.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 80) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Fake form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button');
            const originalText = btn.innerHTML;

            btn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Sending...
            `;
            btn.disabled = true;

            setTimeout(() => {
                alert('✅ Thank you! Your message has been received. We will contact you within 24 hours.');
                this.reset();
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1800);
        });

        // Active nav link highlighting
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            const sections = ['home', 'about', 'why-choose', 'gallery', 'contact'];

            sections.forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section) {
                    const sectionTop = section.offsetTop;
                    if (scrollY >= sectionTop - 200) {
                        current = sectionId;
                    }
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>