<?php
require "ClassAutoLoad.php";
?>
    <!doctype html>
    <html lang="en">
<?php $ObjLayout->header($conf); ?>
<?php $ObjLayout->navbar($conf); ?>

    <style>
        /* Animation on scroll styles */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Added for staggered animation in hero */
        .delay-1 { transition-delay: 200ms; }
        .delay-2 { transition-delay: 400ms; }

        :root{
            --navy: #0a2540;
            --navy-dark: #071a30;
            --gold: #D4AF37;
            --gold-dark: #b98f2b;
        }

        /* Replace Bootstrap primary (blue) with navy */
        .bg-primary { background-color: var(--navy) !important; }
        .text-primary { color: var(--navy) !important; }
        .btn-primary { background-color: var(--navy) !important; border-color: var(--navy) !important; color: #fff !important; }
        .btn-primary:hover, .btn-primary:focus { background-color: var(--navy-dark) !important; border-color: var(--navy-dark) !important; }

        /* Replace white accents with gold where white was used for contrast */
        .text-white { color: var(--gold) !important; }

        /* Light backgrounds/buttons -> gold */
        .bg-light { background-color: var(--gold) !important; color: var(--navy) !important; }
        .btn-light { background-color: var(--gold) !important; color: var(--navy) !important; border-color: var(--gold) !important; }
        .btn-light:hover, .btn-light:focus { background-color: var(--gold-dark) !important; border-color: var(--gold-dark) !important; color: var(--navy) !important; }

        /* Outline-light -> gold outline */
        .btn-outline-light {
            color: var(--gold) !important;
            border-color: var(--gold) !important;
        }
        .btn-outline-light:hover, .btn-outline-light:focus {
            background-color: var(--gold) !important;
            color: var(--navy) !important;
        }

        /* Map other small utility color classes (icons etc.) to navy */
        .text-success, .text-info { color: var(--navy) !important; }

        /* Minor readability tweaks */
        .card { border-color: rgba(10,37,64,0.08); }
        .text-muted { color: rgba(0,0,0,0.6) !important; }
    </style>

    <main role="main">
        <div class="jumbotron jumbotron-fluid bg-primary text-white" style="margin-top: 56px;">
            <div class="container text-center py-5">
                <h1 class="display-3 font-weight-bold animate-on-scroll">Welcome to StrathEventique</h1>
                <p class="lead mb-4 animate-on-scroll delay-1">Your premier platform for discovering and managing amazing events</p>

                <?php if(!isset($_SESSION['user_id'])): ?>
                    <div class="mt-4 animate-on-scroll delay-2">
                        <a href="signup.php" class="btn btn-light btn-lg mx-2">Get Started</a>
                        <a href="signin.php" class="btn btn-outline-light btn-lg mx-2">Sign In</a>
                    </div>
                <?php else: ?>
                    <div class="mt-4 animate-on-scroll delay-2">
                        <h3 class="text-white">Welcome back, <?php echo $_SESSION['user_name']; ?>!</h3>
                        <a href="#events" class="btn btn-light btn-lg mx-2">Browse Events</a>
                        <a href="#create" class="btn btn-outline-light btn-lg mx-2">Create Event</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="container my-5">
            <div class="row text-center mb-5">
                <div class="col-12 animate-on-scroll">
                    <h2 class="display-4">Why Choose StrathEventique?</h2>
                    <p class="lead text-muted">Everything you need for event management in one place</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4 animate-on-scroll">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-calendar-event text-primary" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                            </div>
                            <h3>Discover Events</h3>
                            <p class="text-muted">Browse through thousands of exciting events happening in your area and beyond.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 animate-on-scroll">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-people text-success" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                </svg>
                            </div>
                            <h3>Connect & Network</h3>
                            <p class="text-muted">Meet like-minded people and build connections at events that matter to you.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 animate-on-scroll">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear text-info" viewBox="0 0 16 16">
                                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319z"/>
                                </svg>
                            </div>
                            <h3>Easy Management</h3>
                            <p class="text-muted">Create and manage your own events with our intuitive and powerful tools.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--Add this later when I can connect actual events-->
<!--        <div class="py-5">-->
<!--            <div class="container">-->
<!--                <div class="row text-center mb-5">-->
<!--                    <div class="col-12 animate-on-scroll">-->
<!--                        <h2 class="display-4">Featured Events</h2>-->
<!--                        <p class="lead text-muted">Check out some of the most popular upcoming events</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-4 mb-4 animate-on-scroll">-->
<!--                        <div class="card shadow-sm">-->
<!--                            <img src="https://placehold.co/600x400/0a2540/D4AF37?text=Tech+Conf+2025" class="card-img-top" alt="Tech Conference">-->
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title">Global Tech Conference 2025</h5>-->
<!--                                <p class="card-text text-muted">Join industry leaders to discuss the future of technology and innovation.</p>-->
<!--                                <a href="#" class="btn btn-primary">Learn More</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 mb-4 animate-on-scroll delay-1">-->
<!--                        <div class="card shadow-sm">-->
<!--                            <img src="https://placehold.co/600x400/0a2540/D4AF37?text=Music+Fest" class="card-img-top" alt="Music Festival">-->
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title">Annual Music & Arts Festival</h5>-->
<!--                                <p class="card-text text-muted">Experience a weekend of incredible live music, art installations, and food.</p>-->
<!--                                <a href="#" class="btn btn-primary">Get Tickets</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 mb-4 animate-on-scroll delay-2">-->
<!--                        <div class="card shadow-sm">-->
<!--                            <img src="https://placehold.co/600x400/0a2540/D4AF37?text=Food+Expo" class="card-img-top" alt="Food Expo">-->
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title">International Food Expo</h5>-->
<!--                                <p class="card-text text-muted">A culinary journey featuring the best chefs and cuisines from around the world.</p>-->
<!--                                <a href="#" class="btn btn-primary">View Menu</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="bg-light py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12 animate-on-scroll">
                        <h2 class="display-4">What Our Users Say</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 animate-on-scroll">
                        <div class="card h-100">
                            <div class="card-body">
                                <blockquote class="blockquote text-center">
                                    <p class="mb-3">"StrathEventique made organizing our annual conference a breeze. The tools are intuitive and the support is top-notch!"</p>
                                    <footer class="blockquote-footer">Jane Doe, <cite title="Source Title">Event Organizer</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 animate-on-scroll delay-1">
                        <div class="card h-100">
                            <div class="card-body">
                                <blockquote class="blockquote text-center">
                                    <p class="mb-3">"As an attendee, it's my go-to platform for finding interesting local events. The interface is clean and easy to use."</p>
                                    <footer class="blockquote-footer">John Smith, <cite title="Source Title">Music Enthusiast</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if(!isset($_SESSION['user_id'])): ?>
            <div class="py-5"> <div class="container text-center animate-on-scroll">
                    <h2 class="mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Join thousands of event enthusiasts today!</p>
                    <a href="signup.php" class="btn btn-primary btn-lg">Create Your Account</a>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const targets = document.querySelectorAll('.animate-on-scroll');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    } else {
                        entry.target.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.1 // Triggers when 10% of the element is visible
            });

            targets.forEach(target => {
                observer.observe(target);
            });
        });
    </script>
<?php $ObjLayout->footer($conf); ?>