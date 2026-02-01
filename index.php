<?php
// Dial Dynamic Ltd. - Premium Experience
// Show call on every page load by default.
// If user answers or declines, redirect to connected state.

session_start();
$callAction = isset($_GET['action']) ? $_GET['action'] : null;
if ($callAction === 'answer' || $callAction === 'decline') {
    header('Location: index.php?connected=true');
    exit;
}

$justConnected = isset($_GET['connected']) && $_GET['connected'] == 'true';
$showCall = !$justConnected; // show call unless user was just routed after action
$showWebsite = $justConnected;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dial Dynamic Ltd. | Meaningful Business Dialogue</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- Meta Tags for SEO -->
    <meta name="description" content="Dial Dynamic Ltd. transforms business communication into meaningful, growth-driven dialogue. Experience connection redefined.">
    <meta name="keywords" content="business communication, dialogue solutions, customer engagement, dynamic connectivity">
    <meta property="og:title" content="Dial Dynamic Ltd. - Meaningful Business Dialogue">
    <meta property="og:description" content="Transform your business communication into meaningful dialogue.">
    <meta property="og:image" content="assets/images/og-image.jpg">

    <style>

        /* DDialer Logo Styles */
        .ddialer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .ddialer-logo-icon {
            font-size: 3.5rem;
            color: #00d9ff !important;
            animation: spin 8s linear infinite;
            margin-bottom: 0 !important;
        }

        .ddialer-logo-text {
            font-weight: 900;
            font-size: 2.5rem;
            background: linear-gradient(90deg, #00d9ff, #4A6FA5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(0, 217, 255, 0.3);
        }

        /* Animation only */
        @keyframes spin {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* DDHOSTER Logo Styles - Optimized for card */
        .ddhoster-logo-container {
            position: relative;
            width: 100%;
            height: auto;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        /* Logo Text Group - Always side by side */
        .ddhoster-logo-group {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            gap: 8px;
            z-index: 10;
        }

        /* DD Letters - Initial blue color */
        .ddhoster-letters {
            display: flex;
            position: relative;
            z-index: 10;
        }

        .ddhoster-letter {
            width: 45px;
            height: 60px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            border-radius: 10px;
            margin: 0 3px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            font-weight: 900;
            color: white;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            box-shadow:
                0 10px 20px rgba(14, 165, 233, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .ddhoster-letter::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
            animation: shine 4s infinite linear;
            z-index: 1;
        }

        .ddhoster-letter span {
            position: relative;
            z-index: 2;
        }

        .ddhoster-letter:first-child {
            transform: rotate(-5deg);
            animation: floatLeft 5s ease-in-out infinite;
        }

        .ddhoster-letter:last-child {
            transform: rotate(5deg);
            animation: floatRight 5s ease-in-out infinite 0.5s;
        }

        /* HOSTER text with cyan color */
        .ddhoster-text {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(90deg, #22d3ee, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 5px 15px rgba(34, 211, 238, 0.3);
            letter-spacing: 1px;
            margin-left: 3px;
            padding-bottom: 5px;
            position: relative;
            animation: textGlow 3s infinite ease-in-out;
            white-space: nowrap;
        }

        .ddhoster-text::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #22d3ee, #06b6d4);
            border-radius: 2px;
            animation: underlinePulse 3s infinite ease-in-out;
        }

        /* Hosting Server Icon - Always side by side */
        .ddhoster-server-icon {
            position: relative;
            width: 55px;
            height: 80px;
            margin-left: 15px;
            z-index: 5;
        }

        .ddhoster-server-body {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            border-radius: 8px;
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .ddhoster-server-body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 15px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 0 0;
        }

        .ddhoster-server-slots {
            position: absolute;
            top: 20px;
            left: 6px;
            right: 6px;
            bottom: 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ddhoster-server-slot {
            height: 6px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 2px;
            position: relative;
            overflow: hidden;
        }

        .ddhoster-server-slot::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 40%;
            background: linear-gradient(90deg, #0ea5e9, #22d3ee);
            animation: slotLoad 2.5s infinite ease-in-out;
        }

        .ddhoster-server-leds {
            position: absolute;
            bottom: 8px;
            right: 6px;
            display: flex;
            gap: 3px;
        }

        .ddhoster-server-led {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #0ea5e9;
            box-shadow: 0 0 6px #0ea5e9;
            animation: ledBlink 1.5s infinite;
        }

        .ddhoster-server-led:nth-child(2) {
            animation-delay: 0.5s;
            background: #22d3ee;
            box-shadow: 0 0 6px #22d3ee;
        }

        .ddhoster-server-led:nth-child(3) {
            animation-delay: 1s;
            background: #3b82f6;
            box-shadow: 0 0 6px #3b82f6;
        }

        /* Data connections */
        .ddhoster-data-connections {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        .ddhoster-connection-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, #0ea5e9, #22d3ee, transparent);
            transform-origin: left;
            opacity: 0;
            z-index: 1;
        }

        .ddhoster-data-dot {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #22d3ee;
            box-shadow: 0 0 6px #22d3ee;
            opacity: 0;
            z-index: 2;
        }

        /* Animation keyframes for DDHOSTER */
        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        @keyframes floatLeft {

            0%,
            100% {
                transform: translateY(0) rotate(-5deg);
            }

            50% {
                transform: translateY(-8px) rotate(-7deg);
            }
        }

        @keyframes floatRight {

            0%,
            100% {
                transform: translateY(0) rotate(5deg);
            }

            50% {
                transform: translateY(-8px) rotate(7deg);
            }
        }

        @keyframes textGlow {

            0%,
            100% {
                filter: drop-shadow(0 5px 10px rgba(34, 211, 238, 0.3));
            }

            50% {
                filter: drop-shadow(0 5px 15px rgba(34, 211, 238, 0.5));
            }
        }

        @keyframes underlinePulse {

            0%,
            100% {
                opacity: 0.7;
                width: 100%;
            }

            50% {
                opacity: 1;
                width: 105%;
            }
        }

        @keyframes slotLoad {
            0% {
                left: -40%;
            }

            100% {
                left: 140%;
            }
        }

        @keyframes ledBlink {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 1;
            }
        }

        /* Hide the solution-tag for DDHOSTER since it's in the logo */
        .solutions-section .branch-card .feature.flip-card .flip-front .solution-tag {
            display: none;
        }

        /* Center content in flip-front for DDHOSTER */
        .solutions-section .branch-card .feature.flip-card .flip-front {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .call-ring {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 2px solid rgba(0, 238, 255, 0.6);
            border-radius: 50%;
            pointer-events: none;
            animation: ringPulse 1.5s ease-out infinite;
        }

        @keyframes ringPulse {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Progress Circle Styles */
        .progress-circle-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .progress-circle-container:hover {
            transform: scale(1.05);
        }

        .progress-circle {
            width: 60px;
            height: 60px;
            transform: rotate(-90deg);
        }

        .progress-circle-bar {
            fill: none;
            stroke: #00d9ff;
            stroke-width: 4;
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transform-origin: center;
            transition: stroke-dashoffset 0.3s ease;
            filter: drop-shadow(0 0 8px rgba(0, 217, 255, 0.5));
        }

        .progress-background {
            fill: rgba(10, 15, 35, 0.7);
            stroke: rgba(255, 255, 255, 0.1);
            stroke-width: 4;
            stroke-dasharray: none;
        }

        .scroll-to-top {
            position: absolute;
            height: 100%;
            width: 100%;
            background: linear-gradient(135deg, #0a0f23, #1a1f33);
            border-radius: 50%;
            cursor: pointer;
            transition: opacity 0.3s ease, background-color 0.3s ease;
            z-index: 9997;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            border: 2px solid rgba(0, 217, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 217, 255, 0.2);
        }

        .scroll-to-top:hover {
            background: linear-gradient(135deg, #1a1f33, #2a2f43);
            border-color: rgba(0, 217, 255, 0.5);
        }

        .scroll-to-top svg {
            display: block;
            width: 20px;
            height: 20px;
            stroke: #00d9ff;
            stroke-width: 2.5;
            transition: all 0.3s ease;
        }

        .scroll-to-top:hover svg {
            stroke: #ffffff;
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .progress-circle-container {
                bottom: 20px;
                right: 20px;
            }

            .progress-circle {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .progress-circle-container {
                bottom: 15px;
                right: 15px;
            }

            .progress-circle {
                width: 45px;
                height: 45px;
            }
        }
    </style>
</head>

<body class="<?php echo $justConnected ? 'connected-state' : ''; ?>">
    <!-- Premium Loading Animation (only for call/popup state) -->
    <?php if ($showCall): ?>
        <div class="premium-loader" id="premium-loader">
            <div class="loader-content">
                <div class="loader-spinner"></div>
                <div class="loader-text">INITIALIZING DIAL DYNAMIC LTD.</div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Dynamic Content based on user interaction -->
    <?php if ($showCall): ?>
        <!-- Premium Black Hole Call Experience -->
        <div id="call-experience">
            <?php include 'includes/call-interface.php'; ?>
        </div>
    <?php else: ?>
        <!-- Progress Circle -->
        <div class="progress-circle-container">
            <svg class="progress-circle" viewBox="0 0 100 100">
                <circle class="progress-background" cx="50" cy="50" r="45"></circle>
                <circle class="progress-circle-bar" cx="50" cy="50" r="45"></circle>
            </svg>
            <div class="scroll-to-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 19V5M5 12l7-7 7 7" />
                </svg>
            </div>
        </div>

        <!-- Main Website Content -->
        <div id="website-content">
            <?php include 'includes/website-header.php'; ?>
            <main>
                <?php if ($justConnected): ?>
                    <!-- Premium Greeting Overlay -->
                    <div id="greeting-overlay" class="greeting-overlay">
                        <div class="greeting-card">
                            <div class="greeting-logo" aria-hidden="true"></div>
                            <div class="greeting-content">
                                <h2><i class="fas fa-check-circle"></i> Connection Established</h2>
                                <p class="lead">Welcome to the future of business communication.</p>
                            </div>
                            <div class="greeting-footer">Dial Dynamic Ltd. is now active</div>
                        </div>
                    </div>

                    <!-- Main Welcome Section -->
                    <!-- CONNECTION WELCOME SECTION WITH HANGING LIGHT -->
                    <section class="connection-welcome" id="connectionWelcome">
                        <!-- Hanging Light Background -->
                        <div class="hanging-light-bg" id="hangingLightBg">
                            <div class="hl-ceiling"></div>
                            <div class="hl-light-cord"></div>
                            <div class="hl-light-fixture">
                                <div class="hl-light-dome">
                                    <div class="hl-light-inner"></div>
                                    <div class="hl-light-bulb"></div>
                                </div>
                            </div>
                            <div class="hl-light-glow"></div>
                            <div class="hl-pull-cord-container" id="hlPullCord">
                                <div class="hl-pull-cord"></div>
                                <div class="hl-pull-handle"></div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="container">
                            <h1><i class="fas fa-plug"></i> Dial Dynamic Ltd.</h1>
                            <p class="subtitle">At Dial Dynamic Ltd., we are in the business of connection. We build the critical bridges that allow modern businesses to communicate with their audience and thrive online. From powering meaningful customer conversations to securing a reliable digital presence, we provide the essential, integrated tools that companies need to grow with confidence and clarity. Our mission is simple: to be the trusted partner you rely on for every facet of your public voice.</p>

                            <div class="feature-panel">
                                <div class="feature-grid">
                                    <div class="feature flip-card">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <i class="fas fa-bolt"></i>
                                                <h3>Instant Connection</h3>
                                            </div>
                                            <div class="flip-back">
                                                <p>Establish contact the moment it matters. Our platforms ensure your calls, messages, and websites are delivered without delay. Experience zero lag in customer outreach and flawless uptime for your digital presence, so you're always open for business.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="feature flip-card">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <i class="fas fa-chart-line"></i>
                                                <h3>Growth Analytics</h3>
                                            </div>
                                            <div class="flip-back">
                                                <p>Decisions driven by data, not guesswork. Gain deep insights into campaign performance, customer behavior, and website traffic through intuitive dashboards. Measure what works, optimize what doesn't, and confidently scale your success.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="feature flip-card">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <i class="fas fa-shield-alt"></i>
                                                <h3>Secure Channel</h3>
                                            </div>
                                            <div class="flip-back">
                                                <p>Built on a foundation of trust. We protect your conversations and your data with end-to-end encryption and proactive security measures. Operate with peace of mind knowing your communications and customer information are safeguarded at every step.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- About Section -->
                    <section id="about-connected" class="container about-section" style="margin-top:2.5rem; padding-bottom:2.5rem;">
                        <h2 style="font-size:1.8rem; margin-bottom:0.5rem; text-align:center;">About Dial Dynamic Ltd.</h2>

                        <div class="about-row">
                            <div class="about-block left">
                                <h3 style="font-size:1.2rem; margin-bottom:1rem; text-align:center; color:var(--primary);">Our Story: The Connection Behind the Call</h3>
                                <p class="about-text">Dial Dynamic Ltd. began with a simple observation: businesses were forced to juggle multiple vendors for their communication needs and their online presence. This fragmented approach created complexity, gaps in security, and missed opportunities.

                                    We founded Dial Dynamic to bridge that gap. Our mission was to become a singular, reliable source for the tools modern businesses need to thrive—both in how they talk to their customers and how they present themselves to the world. From our roots in telecommunication, we grew organically, launching DDialer to master the art of connection, and later, DDHoster to master the foundation of a digital footprint.

                                    Today, we are more than a service provider; we are a strategic partner for businesses looking to streamline their operations, secure their assets, and scale their growth with confidence.</p>
                            </div>

                            <div class="about-block right">
                                <h3 style="font-size:1.2rem; margin-bottom:1rem; text-align:center; color:var(--primary);">Our Vision & Values: What We Stand For</h3>
                                <p class="about-text">Our Vision:
                                    To be the most trusted partner for businesses seeking seamless, integrated, and powerful solutions for communication and digital growth.

                                    Our Core Values:

                                    Reliability as Standard: We build systems that don't just work; they endure. Your uptime, your connectivity, and your peace of mind are our primary metrics.

                                    Partnership Over Transaction: We succeed only when you do. Our approach is collaborative, focused on understanding your goals and tailoring solutions that drive your success.

                                    Clarity in Complexity: We demystify technology. Through intuitive tools, transparent pricing, and clear communication, we empower you to make informed decisions.

                                    Innovation with Purpose: We continuously evolve our platforms, not for the sake of change, but to solve real business challenges and unlock new opportunities for our clients.</p>
                            </div>
                        </div>
                    </section>

                    <!-- 3D Slideshow Section -->
                    <section id="slideshow" class="team">
                        <h1 style="margin-bottom: 70px; text-align: center; color: white; font-size: 3rem;">Our Team</h1>
                        <div class="entire-content">
                            <div class="content-carrousel">
                                <figure class="shadow">
                                    <img src="assets/images/rafael4.jpg" />
                                    <div class="member-card">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <div class="member-info">
                                                    <p><strong>Name:</strong> Rafael Rafin</p>
                                                    <p><strong>Department:</strong> Engineer</p>
                                                    <p><strong>Designation:</strong> Software Engineer</p>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <div class="member-about">
                                                    <p>Passionate about technology and innovation. Leading the team with dedication and commitment to excellence.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <figure class="shadow">
                                    <img src="assets/images/sayeb2.webp" />
                                    <div class="member-card">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <div class="member-info">
                                                    <p><strong>Name:</strong> MD Sayeb </p>
                                                    <p><strong>Department:</strong> Engineer</p>
                                                    <p><strong>Designation:</strong> Software Engineer</p>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <div class="member-about">
                                                    <p>Dedicated developer with a passion for creating innovative solutions and writing clean code.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <figure class="shadow">
                                    <img src="assets/images/fharhana1.jpg" />
                                    <div class="member-card">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <div class="member-info">
                                                    <p><strong>Name:</strong> Farhana Islam</p>
                                                    <p><strong>Department:</strong> Sales</p>
                                                    <p><strong>Designation:</strong> Sales Executive</p>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <div class="member-about">
                                                    <p>Creative designer focused on creating beautiful and user-friendly interfaces for amazing experiences.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <figure class="shadow">
                                    <img src="assets/images/sanjida.jpg" />
                                    <div class="member-card">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <div class="member-info">
                                                    <p><strong>Name:</strong> Sanjida Sultana</p>
                                                    <p><strong>Department:</strong> Customer Relations</p>
                                                    <p><strong>Designation:</strong> Customer Relations Executive</p>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <div class="member-about">
                                                    <p>Experienced project manager ensuring smooth workflow and successful project delivery for the team.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <!-- <figure class="shadow"><img src="https://images.pexels.com/photos/54630/japanese-cherry-trees-flowers-spring-japanese-flowering-cherry-54630.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" /></figure>
                                <figure class="shadow"><img src="https://images.pexels.com/photos/131046/pexels-photo-131046.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" /></figure>
                                <figure class="shadow"><img src="https://images.pexels.com/photos/302515/pexels-photo-302515.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" /></figure>
                                <figure class="shadow"><img src="https://images.pexels.com/photos/301682/pexels-photo-301682.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" /></figure>
                                <figure class="shadow"><img src="https://images.pexels.com/photos/933054/pexels-photo-933054.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" /></figure> -->
                            </div>
                        </div>
                    </section>
                    <!-- Our Solutions Section (Tree Structure) -->
                    <section class="solutions-section" id="solutions">
                        <div class="container">
                            <h2 class="solutions-title">Our Solutions</h2>
                            <p class="solutions-subtitle">Comprehensive communication and digital infrastructure solutions for modern businesses</p>

                            <div class="solutions-tree">
                                <!-- Main Trunk (Logo) -->
                                <div class="tree-trunk">
                                    <div class="tree-logo-container">
                                        <img src="assets/images/dialdynamiclogo.png" alt="Dial Dynamic Ltd." class="tree-logo">
                                        <div class="tree-trunk-line"></div>
                                    </div>
                                </div>

                                <!-- Branches Container -->
                                <div class="tree-branches">
                                    <!-- Left Branch -->
                                    <div class="branch branch-left">
                                        <div class="branch-line branch-line-left"></div>
                                        <div class="branch-connector branch-connector-left"></div>
                                        <div class="branch-card">
                                            <div class="feature flip-card">
                                                <div class="flip-inner">
                                                    <div class="flip-front">
                                                        <!-- DDialer Logo -->
                                                        <div class="ddialer-logo">
                                                            <i class="fas fa-phone-alt ddialer-logo-icon"></i>
                                                            <div class="ddialer-logo-text">DDialer</div>
                                                        </div>
                                                        <p class="solution-tag">Communication Suite</p>
                                                    </div>
                                                    <div class="flip-back">
                                                        <p>A focused communications product suite offering automated dialing and messaging services for businesses of all sizes.</p>
                                                        <ul class="solution-features">
                                                            <li><i class="fas fa-check-circle"></i> Individual Dialer</li>
                                                            <li><i class="fas fa-check-circle"></i> Bulk SMS Campaigns</li>
                                                            <li><i class="fas fa-check-circle"></i> Call Center Swift</li>
                                                            <li><i class="fas fa-check-circle"></i> Small Business Suite</li>
                                                        </ul>
                                                        <!-- DDialer Button -->
                                                        <a href="https://ddialer.xyz/" target="_blank" class="solution-btn ddialer-btn">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            Visit DDialer
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Branch -->
                                    <div class="branch branch-right">
                                        <div class="branch-line branch-line-right"></div>
                                        <div class="branch-connector branch-connector-right"></div>
                                        <div class="branch-card">
                                            <div class="feature flip-card">
                                                <div class="flip-inner">
                                                    <div class="flip-front">
                                                        <!-- DDHOSTER Logo -->
                                                        <div class="ddhoster-logo-container">
                                                            <div class="ddhoster-logo-group">
                                                                <!-- DD Letters (Blue) -->
                                                                <div class="ddhoster-letters">
                                                                    <div class="ddhoster-letter" id="ddhosterDD1"><span>D</span></div>
                                                                    <div class="ddhoster-letter" id="ddhosterDD2"><span>D</span></div>
                                                                </div>

                                                                <!-- HOSTER Text (Cyan) -->
                                                                <div class="ddhoster-text">hoster</div>
                                                            </div>

                                                            <!-- Hosting Server Icon - Always side by side -->
                                                            <div class="ddhoster-server-icon">
                                                                <div class="ddhoster-server-body" id="ddhosterServerBody">
                                                                    <div class="ddhoster-server-slots">
                                                                        <div class="ddhoster-server-slot"></div>
                                                                        <div class="ddhoster-server-slot"></div>
                                                                        <div class="ddhoster-server-slot"></div>
                                                                        <div class="ddhoster-server-slot"></div>
                                                                        <div class="ddhoster-server-slot"></div>
                                                                    </div>
                                                                    <div class="ddhoster-server-leds">
                                                                        <div class="ddhoster-server-led"></div>
                                                                        <div class="ddhoster-server-led"></div>
                                                                        <div class="ddhoster-server-led"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Data connections -->
                                                            <div class="ddhoster-data-connections" id="ddhosterConnections"></div>
                                                        </div>
                                                    </div>
                                                    <div class="flip-back">
                                                        <p>A domain & hosting platform delivering reliable hosting, domain registration, and managed DNS services for businesses and developers.</p>
                                                        <ul class="solution-features">
                                                            <li><i class="fas fa-check-circle"></i> Web Hosting</li>
                                                            <li><i class="fas fa-check-circle"></i> Domain Registration</li>
                                                            <li><i class="fas fa-check-circle"></i> Managed DNS</li>
                                                            <li><i class="fas fa-check-circle"></i> SSL Certificates</li>
                                                        </ul>
                                                        <!-- DDHoster Button -->
                                                        <a href="https://ddhoster.com/" target="_blank" class="solution-btn ddhoster-btn">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            Visit DDHoster
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <!-- Third Solution - NirvorLife (Centered Below) -->
                                <div class="solution-center">
                                    <div class="solution-center-card">
                                        <div class="feature flip-card">
                                            <div class="flip-inner">
                                                <div class="flip-front">
                                                    <!-- NirvorLife Logo -->
                                                    <div class="nirvorlife-logo">
                                                        <img src="assets/images/nirvor.png" alt="NirvorLife Logo" class="nirvorlife-logo-img">
                                                        <!-- <div class="nirvorlife-logo-text">NirvorLife</div> -->
                                                    </div>
                                                    <!-- <p class="solution-tag">Finance Tracker</p> -->
                                                </div>
                                                <div class="flip-back">
                                                    <p>A comprehensive income and expense tracking mobile application designed to help individuals and families manage their finances effortlessly.</p>
                                                    <ul class="solution-features">
                                                        <li><i class="fas fa-check-circle"></i> Income Tracking</li>
                                                        <li><i class="fas fa-check-circle"></i> Expense Management</li>
                                                        <li><i class="fas fa-check-circle"></i> Budget Planning</li>
                                                        <li><i class="fas fa-check-circle"></i> Financial Reports</li>
                                                    </ul>
                                                    <!-- NirvorLife Button -->
                                                    <a href="https://nirvorlife.com/" target="_blank" class="solution-btn nirvorlife-btn">
                                                        <i class="fas fa-external-link-alt"></i>
                                                        Visit NirvorLife
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="solutions-footer">
                                    <p> All our solutions work seamlessly together to provide a complete communication and digital infrastructure package for your business.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php else: ?>
                <?php endif; ?>

                <!-- Additional sections would go here -->
            </main>

            <!-- Updated Footer with Globe Background -->
            <footer class="footer">
                <!-- 3D Rotating Earth Globe Background for Footer -->
                <div class="footer-globe-background">
                    <canvas id="footer-globe-canvas"></canvas>
                    <div class="footer-globe-particles" id="footer-globe-particles"></div>
                </div>

                <!-- Footer Content Overlay -->
                <div class="footer-content-overlay">
                    <div class="footer-container">
                        <div class="footer-inner">
                            <div class="footer-left">
                                <div class="footer-brand">
                                    <img src="assets/images/dialdynamiclogo.png" alt="Dial Dynamic Ltd." class="footer-logo">
                                    <h3>Dial Dynamic Ltd.</h3>
                                </div>
                                <p class="footer-about-text">
                                    Transforming business communication into meaningful, growth-driven dialogue.
                                    Experience connection redefined with our integrated solutions.
                                </p>
                                <div class="footer-social">
                                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                </div>
                                <button class="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                                    <i class="fas fa-arrow-up"></i> Back to Top
                                </button>
                            </div>

                            <div class="footer-mid">
                                <div class="footer-links">
                                    <h4>Quick Links</h4>
                                    <ul>
                                        <li><a href="#about-connected">About Us</a></li>
                                        <li><a href="#">Our Solutions</a></li>
                                        <li><a href="#contact">Contact</a></li>
                                        <li><a href="#">Blog</a></li>
                                    </ul>
                                </div>
                                <div class="footer-policy">
                                    <h4>Legal</h4>
                                    <ul>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Terms of Service</a></li>
                                        <li><a href="#">Cookie Policy</a></li>
                                        <li><a href="#">GDPR Compliance</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="footer-right">
                                <div class="footer-contact">
                                    <h4>Contact Us</h4>
                                    <p><i class="fas fa-map-marker-alt"></i> 124/48, Block-A, Road-9 West Dhanmondi, Bosila, Mohammadpur, Dhaka-1207</p>
                                    <p><i class="fas fa-phone"></i> +88 09617 14 11 44</p>
                                    <p><i class="fas fa-envelope"></i> support@ddialer.xyz</p>
                                    <p><i class="fas fa-clock"></i> Sat-Thurs: 10AM-6PM</p>
                                </div>
                            </div>
                        </div>

                        <div class="footer-bottom">
                            <div class="footer-bottom-inner">
                                <div class="stripe"></div>
                                <p>&copy; <?php echo date('Y'); ?> Dial Dynamic Ltd. All rights reserved. | Transforming Business Communication Worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    <?php endif; ?>

    <!-- JavaScript -->
    <script src="assets/js/script.js"></script>

    <?php if ($showCall): ?>
        <script>
            // Auto-play ambient audio for call experience
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    const intro = document.getElementById('intro-audio');
                    if (intro) {
                        intro.volume = 0.2;
                        intro.play().catch(e => console.log("Audio requires interaction"));
                    }
                }, 2000);
            });
        </script>
    <?php endif; ?>

    <?php if (!$showCall): ?>
        <!-- HANGING LIGHT TOGGLE SCRIPT -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let isLightOn = false;
                const pullCord = document.getElementById('hlPullCord');
                const lightBg = document.getElementById('hangingLightBg');
                const welcomeSection = document.getElementById('connectionWelcome');

                if (pullCord && lightBg && welcomeSection) {
                    pullCord.addEventListener('click', function() {
                        isLightOn = !isLightOn;

                        if (isLightOn) {
                            lightBg.classList.add('light-on');
                            welcomeSection.classList.add('light-active');
                        } else {
                            lightBg.classList.remove('light-on');
                            welcomeSection.classList.remove('light-active');
                        }

                        // Swing animation for rope
                        this.style.transform = 'rotate(5deg)';
                        setTimeout(() => {
                            this.style.transform = 'rotate(-5deg)';
                            setTimeout(() => {
                                this.style.transform = 'rotate(0deg)';
                            }, 100);
                        }, 100);
                    });
                }
            });
        </script>

        <!-- Progress Circle JavaScript -->
        <script>
            // Progress circle functionality
            function updateProgressCircle() {
                const progressElement = document.querySelector('.progress-circle-bar');
                const scrollToTopElement = document.querySelector('.scroll-to-top');
                const totalHeight = document.body.scrollHeight - window.innerHeight;
                let progress = (window.pageYOffset / totalHeight) * 283;
                progress = Math.min(progress, 283);
                progressElement.style.strokeDashoffset = 283 - progress;

                // Show scroll-to-top button when at the bottom of the page
                if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
                    scrollToTopElement.style.opacity = '1';
                } else {
                    scrollToTopElement.style.opacity = '0';
                }
            }

            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Initialize progress circle on page load
            document.addEventListener('DOMContentLoaded', function() {
                const scrollToTopElement = document.querySelector('.scroll-to-top');
                const progressCircleContainer = document.querySelector('.progress-circle-container');

                if (scrollToTopElement) {
                    // Add click event to the entire progress circle container
                    progressCircleContainer.addEventListener('click', scrollToTop);
                    
                    // Also add click event to the scroll-to-top element for backward compatibility
                    scrollToTopElement.addEventListener('click', scrollToTop);
                }

                updateProgressCircle();
                window.addEventListener('scroll', updateProgressCircle);
                window.addEventListener('resize', updateProgressCircle);
            });
        </script>

    <?php endif; ?>

</body>

</html>
