<?php
// Load the special of the day from JSON file
$special = file_exists('special.json') ? json_decode(file_get_contents('special.json'), true) : null;

// Restaurant information
$restaurant_info = [
    'name' => 'Restaurantly',
    'tagline' => 'Where Every Bite Tells a Story',
    'description' => 'Experience culinary excellence with our farm-to-table approach, featuring locally sourced ingredients and innovative dishes that celebrate both tradition and modern gastronomy.',
    'hours' => [
        'Monday - Thursday' => '11:00 AM - 10:00 PM',
        'Friday - Saturday' => '11:00 AM - 11:00 PM',
        'Sunday' => '12:00 PM - 9:00 PM'
    ],
    'contact' => [
        'phone' => '+1 (555) 123-4567',
        'email' => 'hello@restaurantly.com',
        'address' => '123 Gourmet Street, Foodie City, FC 12345'
    ]
];

// Check if user is logged in as admin
session_start();
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($restaurant_info['name']) ?> - Home</title>
    <meta name="description" content="<?= htmlspecialchars($restaurant_info['description']) ?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>
<body>

<header>
    <nav>
        <div class="logo">
            <a href="index.php"><?= htmlspecialchars($restaurant_info['name']) ?></a>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="reservations.php">Reservations</a>
            <a href="order.php">Order Online</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <?php if ($is_admin): ?>
                <a href="admin/dashboard.php" class="admin-link">Admin Dashboard</a>
                <a href="admin/logout.php" class="logout-link">Logout</a>
            <?php else: ?>
                <a href="admin_login.php" class="admin-link">Admin Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- Hero Section -->
<section id="hero">
    <div class="hero-content">
        <h1><?= htmlspecialchars($restaurant_info['name']) ?></h1>
        <p class="tagline"><?= htmlspecialchars($restaurant_info['tagline']) ?></p>
        <p class="hero-description"><?= htmlspecialchars($restaurant_info['description']) ?></p>
        <div class="hero-buttons">
            <a href="reservations.php" class="btn btn-primary">Book a Table</a>
            <a href="order.php" class="btn btn-secondary">Order Online</a>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <span>Scroll to explore</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- Today's Special Section -->
<section id="specials">
    <div class="container">
        <h2>Today's Special</h2>
        <div class="special-content">
            <?php if ($special): ?>
                <div class="special-item">
                    <div class="special-image">
                        <img src="<?= htmlspecialchars($special['image']) ?>" alt="<?= htmlspecialchars($special['dish']) ?>" />
                        <div class="special-badge">Chef's Pick</div>
                    </div>
                    <div class="special-details">
                        <h3><?= htmlspecialchars($special['dish']) ?></h3>
                        <p class="special-description"><?= htmlspecialchars($special['desc']) ?></p>
                        <div class="special-price">$<?= htmlspecialchars($special['price'] ?? 'Market Price') ?></div>
                        <a href="order.php" class="btn btn-accent">Order Now</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-special">
                    <div class="no-special-icon">🍽️</div>
                    <h3>No Special Today</h3>
                    <p>Check back tomorrow for our chef's latest creation!</p>
                    <a href="menu.php" class="btn btn-primary">View Full Menu</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Menu Preview Section -->
<section id="menu-preview">
    <div class="container">
        <h2>Our Menu</h2>
        <p class="section-subtitle">Discover our carefully curated selection of dishes</p>
        
        <div class="menu-categories">
            <div class="menu-category">
                <div class="category-icon">🥗</div>
                <h3>Starters</h3>
                <p>Fresh appetizers to awaken your palate</p>
                <a href="menu.php#starters" class="btn btn-outline">View Starters</a>
            </div>
            
            <div class="menu-category">
                <div class="category-icon">🍝</div>
                <h3>Main Courses</h3>
                <p>Signature dishes crafted with passion</p>
                <a href="menu.php#mains" class="btn btn-outline">View Mains</a>
            </div>
            
            <div class="menu-category">
                <div class="category-icon">🍰</div>
                <h3>Desserts</h3>
                <p>Sweet endings to perfect your meal</p>
                <a href="menu.php#desserts" class="btn btn-outline">View Desserts</a>
            </div>
            
            <div class="menu-category">
                <div class="category-icon">🍷</div>
                <h3>Beverages</h3>
                <p>Carefully selected wines and cocktails</p>
                <a href="menu.php#beverages" class="btn btn-outline">View Drinks</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>Our Story</h2>
                <p>Founded in 2010, <?= htmlspecialchars($restaurant_info['name']) ?> has been serving exceptional cuisine to our community for over a decade. Our passion for food and commitment to quality has made us a beloved destination for food enthusiasts.</p>
                
                <div class="about-features">
                    <div class="feature">
                        <div class="feature-icon">🌱</div>
                        <h4>Farm to Table</h4>
                        <p>We source fresh ingredients from local farms</p>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon">👨‍🍳</div>
                        <h4>Expert Chefs</h4>
                        <p>Our culinary team brings years of experience</p>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon">🌟</div>
                        <h4>Award Winning</h4>
                        <p>Recognized for excellence in dining</p>
                    </div>
                </div>
            </div>
            
            <div class="about-image">
                <img src="assets/images/restaurant-interior.jpg" alt="Restaurant Interior" />
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials">
    <div class="container">
        <h2>What Our Guests Say</h2>
        <div class="testimonials-grid">
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"Absolutely amazing experience! The food was incredible and the service was top-notch. Can't wait to come back!"</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👤</div>
                    <div class="author-info">
                        <h4>Sarah Johnson</h4>
                        <span>Food Blogger</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"The best restaurant in town! Every dish is a work of art. The atmosphere is perfect for date nights."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👤</div>
                    <div class="author-info">
                        <h4>Michael Chen</h4>
                        <span>Local Resident</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"Outstanding quality and presentation. The chef's special was beyond expectations. Highly recommend!"</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">👤</div>
                    <div class="author-info">
                        <h4>Emily Rodriguez</h4>
                        <span>Food Critic</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hours & Location Section -->
<section id="hours-location">
    <div class="container">
        <div class="hours-location-grid">
            <div class="hours-section">
                <h2>Opening Hours</h2>
                <div class="hours-list">
                    <?php foreach ($restaurant_info['hours'] as $day => $time): ?>
                        <div class="hours-item">
                            <span class="day"><?= htmlspecialchars($day) ?></span>
                            <span class="time"><?= htmlspecialchars($time) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="reservation-cta">
                    <p>Make a reservation to secure your table</p>
                    <a href="reservations.php" class="btn btn-primary">Book Now</a>
                </div>
            </div>
            
            <div class="location-section">
                <h2>Visit Us</h2>
                <div class="location-info">
                    <div class="location-item">
                        <div class="location-icon">📍</div>
                        <div>
                            <h4>Address</h4>
                            <p><?= htmlspecialchars($restaurant_info['contact']['address']) ?></p>
                        </div>
                    </div>
                    
                    <div class="location-item">
                        <div class="location-icon">📞</div>
                        <div>
                            <h4>Phone</h4>
                            <p><a href="tel:<?= htmlspecialchars($restaurant_info['contact']['phone']) ?>"><?= htmlspecialchars($restaurant_info['contact']['phone']) ?></a></p>
                        </div>
                    </div>
                    
                    <div class="location-item">
                        <div class="location-icon">✉️</div>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:<?= htmlspecialchars($restaurant_info['contact']['email']) ?>"><?= htmlspecialchars($restaurant_info['contact']['email']) ?></a></p>
                        </div>
                    </div>
                </div>
                
                <div class="map-placeholder">
                    <div class="map-content">
                        <div class="map-icon">🗺️</div>
                        <p>Interactive map coming soon</p>
                        <a href="#" class="btn btn-outline">Get Directions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <h2>Get in Touch</h2>
        <p class="section-subtitle">We'd love to hear from you</p>
        
        <div class="contact-grid">
            <div class="contact-form">
                <h3>Send us a Message</h3>
                <form action="contact.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Your Phone">
                    </div>
                    <div class="form-group">
                        <select name="subject" required>
                            <option value="">Select Subject</option>
                            <option value="reservation">Reservation Inquiry</option>
                            <option value="feedback">Feedback</option>
                            <option value="catering">Catering Request</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info">
                <h3>Quick Contact</h3>
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="method-icon">📞</div>
                        <div>
                            <h4>Call Us</h4>
                            <p><?= htmlspecialchars($restaurant_info['contact']['phone']) ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">✉️</div>
                        <div>
                            <h4>Email Us</h4>
                            <p><?= htmlspecialchars($restaurant_info['contact']['email']) ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">💬</div>
                        <div>
                            <h4>Social Media</h4>
                            <p>Follow us for updates and special offers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section id="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for special offers, events, and culinary insights</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit" class="btn btn-accent">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?= htmlspecialchars($restaurant_info['name']) ?></h3>
                <p><?= htmlspecialchars($restaurant_info['description']) ?></p>
                <div class="social-links">
                    <a href="#" target="_blank" aria-label="Facebook">📘</a>
                    <a href="#" target="_blank" aria-label="Instagram">📷</a>
                    <a href="#" target="_blank" aria-label="Twitter">🐦</a>
                    <a href="#" target="_blank" aria-label="TikTok">🎵</a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservations.php">Reservations</a></li>
                    <li><a href="order.php">Order Online</a></li>
                    <li><a href="#about">About Us</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Contact Info</h4>
                <ul>
                    <li>📍 <?= htmlspecialchars($restaurant_info['contact']['address']) ?></li>
                    <li>📞 <?= htmlspecialchars($restaurant_info['contact']['phone']) ?></li>
                    <li>✉️ <?= htmlspecialchars($restaurant_info['contact']['email']) ?></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Hours</h4>
                <ul>
                    <?php foreach (array_slice($restaurant_info['hours'], 0, 3) as $day => $time): ?>
                        <li><?= htmlspecialchars($day) ?>: <?= htmlspecialchars($time) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($restaurant_info['name']) ?>. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Accessibility</a>
            </div>
        </div>
    </div>
</footer>

<script>
// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = 'none';
    }
});

// Newsletter form submission
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;
    alert('Thank you for subscribing! We\'ll keep you updated with our latest offers.');
    this.reset();
});

// Contact form submission
document.querySelector('.contact-form form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Thank you for your message! We\'ll get back to you soon.');
    this.reset();
});
</script>

</body>
</html>