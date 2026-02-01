<header class="main-header">
    <!-- 3D Rotating Earth Globe Background -->
    <div class="globe-background">
        <canvas id="globe-canvas"></canvas>
        
        <!-- Ambient particles -->
        <div class="globe-particles" id="globe-particles"></div>
    </div>
    
    <!-- Existing content overlay -->
    <div class="header-content-overlay">
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/images/dialdynamiclogo.png" alt="Dial Dynamic logo" class="site-logo">
                        <span>Dial Dynamic</span>
                    </a>
                </div>
                
                <ul class="nav-menu">
                    <li><a href="#about-connected">About us</a></li>
                    <li><a href="#solutions">Solutions</a></li>
                    <li><a href="#slideshow">Our Team</a></li>
                </ul>
                
                <button class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        
        <div class="hero">
            <div class="container">
                <h1 class="hero-title">Powering Connections: Telecom Solutions & Digital Infrastructure</h1>
                <p class="hero-subtitle">
                    Where every business conversation becomes meaningful, measurable, and growth-driven.
                </p>
                <a href="#contact" class="btn-primary">
                    <i class="fas fa-comment-alt"></i> Start a Conversation
                </a>
            </div>
        </div>
    </div>
    
    <!-- Globe JavaScript -->
    <script>
        // Create ambient particles
        function createGlobeParticles() {
            const particlesContainer = document.getElementById('globe-particles');
            if (!particlesContainer) return;
            
            // Clear existing particles
            particlesContainer.innerHTML = '';
            
            // Create more particles for better visibility
            for (let i = 0; i < 120; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size (larger particles)
                const size = Math.random() * 4 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                
                // Random animation properties
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.animationDuration = Math.random() * 4 + 3 + 's';
                
                // Random color variations (blue/white)
                const colorVariation = Math.random();
                if (colorVariation < 0.7) {
                    particle.style.backgroundColor = 'rgba(100, 200, 255, 0.7)'; // Bright blue
                } else if (colorVariation < 0.9) {
                    particle.style.backgroundColor = 'rgba(180, 230, 255, 0.9)'; // Bright white-blue
                } else {
                    particle.style.backgroundColor = 'rgba(255, 255, 255, 0.8)'; // White
                }
                
                // Add glow effect
                particle.style.boxShadow = '0 0 8px rgba(100, 200, 255, 0.8)';
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Globe Canvas Setup
        function setupGlobe() {
            const canvas = document.getElementById('globe-canvas');
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            let animationId;
            
            // Make canvas responsive to window size
            function resizeCanvas() {
                const header = document.querySelector('.main-header');
                if (!header) return;
                
                const headerRect = header.getBoundingClientRect();
                canvas.width = headerRect.width;
                canvas.height = headerRect.height;
                
                // Reposition canvas for header layout
                const canvasContainer = document.querySelector('.globe-background');
                if (canvasContainer) {
                    canvasContainer.style.width = headerRect.width + 'px';
                    canvasContainer.style.height = headerRect.height + 'px';
                }
            }
            
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);
            
            // CHANGED: Moved globe to the left (from 85% to 70%)
            const getCenterX = () => canvas.width * 0.80; // Position more to the center-left
            const getCenterY = () => canvas.height * 0.5;
            const getRadius = () => Math.min(canvas.width, canvas.height) * 0.30; // Increased radius
            
            let rotation = 0;
            
            // Earth geometry - continents
            const continents = [
                // North America
                [
                    {lat: 70, lon: -100}, {lat: 60, lon: -135}, {lat: 55, lon: -130},
                    {lat: 50, lon: -125}, {lat: 49, lon: -95}, {lat: 45, lon: -75},
                    {lat: 30, lon: -80}, {lat: 25, lon: -95}, {lat: 20, lon: -105},
                    {lat: 30, lon: -115}, {lat: 35, lon: -118}
                ],
                // South America
                [
                    {lat: -2, lon: -80}, {lat: -5, lon: -75}, {lat: -10, lon: -60},
                    {lat: -20, lon: -55}, {lat: -35, lon: -60}, {lat: -50, lon: -70},
                    {lat: -40, lon: -75}, {lat: -20, lon: -80}, {lat: -5, lon: -80}
                ],
                // Europe
                [
                    {lat: 70, lon: 25}, {lat: 65, lon: 30}, {lat: 60, lon: 10},
                    {lat: 55, lon: 35}, {lat: 50, lon: 5}, {lat: 45, lon: 0},
                    {lat: 42, lon: 10}, {lat: 40, lon: 30}, {lat: 36, lon: 10}
                ],
                // Africa
                [
                    {lat: 32, lon: 10}, {lat: 25, lon: 35}, {lat: 15, lon: 42},
                    {lat: 0, lon: 40}, {lat: -15, lon: 35}, {lat: -30, lon: 30},
                    {lat: -35, lon: 20}, {lat: -25, lon: 15}, {lat: 10, lon: 0}
                ],
                // Asia
                [
                    {lat: 75, lon: 100}, {lat: 70, lon: 140}, {lat: 60, lon: 150},
                    {lat: 50, lon: 142}, {lat: 45, lon: 135}, {lat: 35, lon: 140},
                    {lat: 25, lon: 120}, {lat: 10, lon: 105}, {lat: 20, lon: 95},
                    {lat: 30, lon: 80}, {lat: 40, lon: 70}, {lat: 50, lon: 60},
                    {lat: 60, lon: 70}
                ],
                // Australia
                [
                    {lat: -12, lon: 130}, {lat: -10, lon: 142}, {lat: -18, lon: 148},
                    {lat: -28, lon: 153}, {lat: -38, lon: 145}, {lat: -35, lon: 138},
                    {lat: -32, lon: 125}, {lat: -20, lon: 115}, {lat: -15, lon: 125}
                ]
            ];
            
            // Strategic connection nodes (major hub cities)
            const nodes = [
                {lat: 40.7, lon: -74},     // New York
                {lat: 51.5, lon: -0.1},    // London
                {lat: 35.7, lon: 139.7},   // Tokyo
                {lat: -33.9, lon: 151.2},  // Sydney
                {lat: 1.3, lon: 103.8},    // Singapore
                {lat: 55.8, lon: 37.6},    // Moscow
                {lat: 31.2, lon: 121.5},   // Shanghai
                {lat: 52.5, lon: 13.4},    // Berlin
                {lat: 25.3, lon: 55.3},    // Dubai
                {lat: 34.1, lon: -118.2},  // Los Angeles
                {lat: -23.5, lon: -46.6},  // São Paulo
                {lat: 19.4, lon: -99.1}    // Mexico City
            ];
            
            // Organized connections
            const connections = [
                {start: nodes[0], end: nodes[1]},  // NY-London
                {start: nodes[0], end: nodes[7]},  // NY-Berlin
                {start: nodes[9], end: nodes[1]},  // LA-London
                {start: nodes[2], end: nodes[9]},  // Tokyo-LA
                {start: nodes[2], end: nodes[0]},  // Tokyo-NY
                {start: nodes[3], end: nodes[2]},  // Sydney-Tokyo
                {start: nodes[4], end: nodes[2]},  // Singapore-Tokyo
                {start: nodes[4], end: nodes[6]},  // Singapore-Shanghai
                {start: nodes[6], end: nodes[2]},  // Shanghai-Tokyo
                {start: nodes[1], end: nodes[7]},  // London-Berlin
                {start: nodes[1], end: nodes[5]},  // London-Moscow
                {start: nodes[7], end: nodes[5]},  // Berlin-Moscow
                {start: nodes[8], end: nodes[1]},  // Dubai-London
                {start: nodes[8], end: nodes[4]},  // Dubai-Singapore
                {start: nodes[0], end: nodes[11]}, // NY-Mexico
                {start: nodes[10], end: nodes[11]}, // Sao Paulo-Mexico
                {start: nodes[9], end: nodes[11]}  // LA-Mexico
            ];
            
            connections.forEach(conn => {
                conn.pulseOffset = Math.random() * Math.PI * 2;
            });
            
            // Particle sparks - more for better visibility
            const sparks = [];
            connections.forEach(conn => {
                for (let i = 0; i < 4; i++) {
                    sparks.push({
                        connection: conn,
                        progress: Math.random(),
                        speed: 0.0015 + Math.random() * 0.002,
                        size: Math.random() * 2 + 1.5
                    });
                }
            });
            
            // Utility functions
            function latLonToVector(lat, lon, r) {
                const phi = (90 - lat) * (Math.PI / 180);
                const theta = (lon + 180) * (Math.PI / 180);
                
                return {
                    x: -r * Math.sin(phi) * Math.cos(theta),
                    y: r * Math.cos(phi),
                    z: r * Math.sin(phi) * Math.sin(theta)
                };
            }
            
            function rotateY(x, y, z, angle) {
                const cos = Math.cos(angle);
                const sin = Math.sin(angle);
                return {
                    x: x * cos - z * sin,
                    y: y,
                    z: x * sin + z * cos
                };
            }
            
            function project(x, y, z, centerX, centerY, radius) {
                const perspective = 450;
                const scale = perspective / (perspective + z);
                return {
                    x: centerX + x * scale,
                    y: centerY - y * scale,
                    z: z,
                    scale: scale,
                    visible: z > -radius * 1.2
                };
            }
            
            function interpolateLatLon(start, end, t) {
                return {
                    lat: start.lat + (end.lat - start.lat) * t,
                    lon: start.lon + (end.lon - start.lon) * t
                };
            }
            
            // Draw function
            function draw() {
                const centerX = getCenterX();
                const centerY = getCenterY();
                const radius = getRadius();
                
                // Clear canvas with transparent background
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                rotation += 0.002;
                
                // Draw globe base (subtle sphere)
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                const globeGradient = ctx.createRadialGradient(
                    centerX, centerY, radius * 0.3,
                    centerX, centerY, radius * 1.1
                );
                globeGradient.addColorStop(0, 'rgba(20, 60, 120, 0.1)');
                globeGradient.addColorStop(1, 'rgba(10, 40, 90, 0.05)');
                ctx.fillStyle = globeGradient;
                ctx.fill();
                
                // Draw latitude lines (more visible)
                for (let lat = -75; lat <= 75; lat += 15) {
                    ctx.beginPath();
                    let firstPoint = true;
                    for (let lon = -180; lon <= 180; lon += 4) {
                        const vec = latLonToVector(lat, lon, radius);
                        const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                        const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);
                        
                        if (proj.visible) {
                            if (firstPoint) {
                                ctx.moveTo(proj.x, proj.y);
                                firstPoint = false;
                            } else {
                                ctx.lineTo(proj.x, proj.y);
                            }
                        } else {
                            firstPoint = true;
                        }
                    }
                    ctx.strokeStyle = 'rgba(80, 160, 240, 0.4)'; // Increased opacity
                    ctx.lineWidth = 1.2; // Thicker lines
                    ctx.stroke();
                }
                
                // Draw longitude lines (more visible)
                for (let lon = -180; lon <= 180; lon += 15) {
                    ctx.beginPath();
                    let firstPoint = true;
                    for (let lat = -90; lat <= 90; lat += 4) {
                        const vec = latLonToVector(lat, lon, radius);
                        const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                        const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);
                        
                        if (proj.visible) {
                            if (firstPoint) {
                                ctx.moveTo(proj.x, proj.y);
                                firstPoint = false;
                            } else {
                                ctx.lineTo(proj.x, proj.y);
                            }
                        } else {
                            firstPoint = true;
                        }
                    }
                    ctx.strokeStyle = 'rgba(80, 160, 240, 0.4)'; // Increased opacity
                    ctx.lineWidth = 1.2; // Thicker lines
                    ctx.stroke();
                }
                
                // Draw connections with animated pulses (more visible)
                connections.forEach(conn => {
                    const startVec = latLonToVector(conn.start.lat, conn.start.lon, radius);
                    const endVec = latLonToVector(conn.end.lat, conn.end.lon, radius);
                    
                    const startRot = rotateY(startVec.x, startVec.y, startVec.z, rotation);
                    const endRot = rotateY(endVec.x, endVec.y, endVec.z, rotation);
                    
                    const startProj = project(startRot.x, startRot.y, startRot.z, centerX, centerY, radius);
                    const endProj = project(endRot.x, endRot.y, endRot.z, centerX, centerY, radius);
                    
                    if (startProj.visible && endProj.visible) {
                        ctx.beginPath();
                        ctx.moveTo(startProj.x, startProj.y);
                        
                        const steps = 20;
                        for (let i = 1; i <= steps; i++) {
                            const t = i / steps;
                            const mid = interpolateLatLon(conn.start, conn.end, t);
                            const midVec = latLonToVector(mid.lat, mid.lon, radius + 8);
                            const midRot = rotateY(midVec.x, midVec.y, midVec.z, rotation);
                            const midProj = project(midRot.x, midRot.y, midRot.z, centerX, centerY, radius);
                            ctx.lineTo(midProj.x, midProj.y);
                        }
                        
                        const pulse = Math.sin(Date.now() * 0.001 + conn.pulseOffset) * 0.4 + 0.6;
                        // Brighter and more visible connection lines
                        ctx.strokeStyle = `rgba(100, 180, 255, ${0.4 + pulse * 0.4})`;
                        ctx.lineWidth = 2; // Thicker lines
                        ctx.shadowBlur = 8;
                        ctx.shadowColor = 'rgba(100, 180, 255, 0.5)';
                        ctx.stroke();
                        ctx.shadowBlur = 0; // Reset shadow for other drawings
                    }
                });
                
                // Draw continents with more visible glow
                continents.forEach(continent => {
                    ctx.beginPath();
                    let firstPoint = true;
                    let visiblePoints = [];
                    
                    continent.forEach(point => {
                        const vec = latLonToVector(point.lat, point.lon, radius + 1);
                        const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                        const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);
                        
                        if (proj.visible) {
                            visiblePoints.push(proj);
                            if (firstPoint) {
                                ctx.moveTo(proj.x, proj.y);
                                firstPoint = false;
                            } else {
                                ctx.lineTo(proj.x, proj.y);
                            }
                        }
                    });
                    
                    if (visiblePoints.length > 2) {
                        ctx.closePath();
                        // More visible continent fill
                        ctx.fillStyle = 'rgba(70, 150, 230, 0.35)';
                        ctx.fill();
                        // Brighter continent outlines
                        ctx.strokeStyle = 'rgba(140, 200, 255, 0.8)';
                        ctx.lineWidth = 2;
                        ctx.stroke();
                    }
                });
                
                // Draw nodes - more visible
                nodes.forEach(node => {
                    const vec = latLonToVector(node.lat, node.lon, radius + 2);
                    const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                    const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);
                    
                    if (proj.visible) {
                        const pulse = Math.sin(Date.now() * 0.002) * 0.4 + 0.8;
                        
                        // Larger outer glow
                        const gradient = ctx.createRadialGradient(proj.x, proj.y, 0, proj.x, proj.y, 15 * pulse);
                        gradient.addColorStop(0, 'rgba(140, 220, 255, 0.9)');
                        gradient.addColorStop(0.3, 'rgba(100, 180, 240, 0.7)');
                        gradient.addColorStop(1, 'rgba(80, 160, 220, 0)');
                        
                        ctx.fillStyle = gradient;
                        ctx.beginPath();
                        ctx.arc(proj.x, proj.y, 15 * pulse, 0, Math.PI * 2);
                        ctx.fill();
                        
                        // Bright core
                        ctx.fillStyle = 'rgba(200, 240, 255, 1)';
                        ctx.beginPath();
                        ctx.arc(proj.x, proj.y, 4 * proj.scale, 0, Math.PI * 2);
                        ctx.fill();
                        
                        // Add glow effect
                        ctx.shadowBlur = 10;
                        ctx.shadowColor = 'rgba(100, 200, 255, 0.8)';
                        ctx.fill();
                        ctx.shadowBlur = 0;
                    }
                });
                
                // Draw animated sparks - more visible
                sparks.forEach(spark => {
                    spark.progress += spark.speed;
                    if (spark.progress > 1) spark.progress = 0;
                    
                    const pos = interpolateLatLon(spark.connection.start, spark.connection.end, spark.progress);
                    const vec = latLonToVector(pos.lat, pos.lon, radius + 4);
                    const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                    const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);
                    
                    if (proj.visible) {
                        const gradient = ctx.createRadialGradient(proj.x, proj.y, 0, proj.x, proj.y, spark.size * 5);
                        gradient.addColorStop(0, 'rgba(200, 240, 255, 1)');
                        gradient.addColorStop(0.5, 'rgba(140, 220, 255, 0.8)');
                        gradient.addColorStop(1, 'rgba(100, 180, 240, 0)');
                        
                        ctx.fillStyle = gradient;
                        ctx.beginPath();
                        ctx.arc(proj.x, proj.y, spark.size * 5, 0, Math.PI * 2);
                        ctx.fill();
                        
                        // Add trail effect
                        ctx.shadowBlur = spark.size * 3;
                        ctx.shadowColor = 'rgba(100, 200, 255, 0.7)';
                        ctx.fill();
                        ctx.shadowBlur = 0;
                    }
                });
                
                animationId = requestAnimationFrame(draw);
            }
            
            // Start animation
            draw();
            
            // Cleanup function
            return () => {
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                window.removeEventListener('resize', resizeCanvas);
            };
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            createGlobeParticles();
            setupGlobe();
        });
        
        // Reinitialize on window resize
        window.addEventListener('resize', function() {
            createGlobeParticles();
        });

        // Typing Animation for Hero Subtitle
function initTypingAnimation() {
    const subtitleElement = document.querySelector('.hero-subtitle');
    if (!subtitleElement) return;
    
    const originalText = subtitleElement.textContent;
    const text = "Where every business conversation becomes meaningful, measurable, and growth-driven.";
    
    // Clear the subtitle
    subtitleElement.innerHTML = '';
    
    // Create container for typing text
    const typingContainer = document.createElement('span');
    typingContainer.className = 'typing-container';
    typingContainer.id = 'typing-text';
    
    // Create cursor
    const cursor = document.createElement('span');
    cursor.className = 'typing-cursor';
    
    // Append elements
    subtitleElement.appendChild(typingContainer);
    subtitleElement.appendChild(cursor);
    
    // Method 1: Simple typing animation
    let i = 0;
    let speed = 50; // milliseconds per character
    
    function typeWriter() {
        if (i < text.length) {
            typingContainer.textContent += text.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
            
            // When typing is complete, keep cursor blinking for a while then hide
            if (i === text.length) {
                setTimeout(() => {
                    cursor.style.animation = 'none';
                    setTimeout(() => {
                        cursor.style.opacity = '0';
                        cursor.style.transition = 'opacity 0.5s';
                    }, 2000);
                }, 1000);
            }
        }
    }
    
    // Start typing after a delay
    setTimeout(typeWriter, 1000);
}

// Alternative: Character-by-character reveal animation
function initCharByCharTyping() {
    const subtitleElement = document.querySelector('.hero-subtitle');
    if (!subtitleElement) return;
    
    const text = subtitleElement.textContent;
    subtitleElement.innerHTML = '';
    
    // Split text into characters and wrap each in span
    const chars = text.split('');
    chars.forEach((char, index) => {
        const charSpan = document.createElement('span');
        charSpan.className = 'char';
        charSpan.textContent = char === ' ' ? '\u00A0' : char; // Preserve spaces
        charSpan.style.animationDelay = `${index * 0.05}s`;
        subtitleElement.appendChild(charSpan);
    });
    
    // Add blinking cursor at the end
    const cursor = document.createElement('span');
    cursor.className = 'typing-cursor';
    cursor.style.animationDelay = `${chars.length * 0.05 + 1}s`;
    subtitleElement.appendChild(cursor);
    
    // Hide cursor after animation
    setTimeout(() => {
        cursor.style.animation = 'none';
        cursor.style.opacity = '0.5';
    }, chars.length * 50 + 2000);
}

// Alternative: Multi-line typing for longer text
function initMultiLineTyping() {
    const subtitleElement = document.querySelector('.hero-subtitle');
    if (!subtitleElement) return;
    
    const text = subtitleElement.textContent;
    subtitleElement.innerHTML = '';
    
    // Split text into lines (adjust based on your content)
    const lines = [
        "Where every business conversation",
        "becomes meaningful, measurable,",
        "and growth-driven."
    ];
    
    lines.forEach((line, lineIndex) => {
        const lineDiv = document.createElement('div');
        lineDiv.className = 'line';
        lineDiv.textContent = line;
        lineDiv.style.animationDelay = `${lineIndex * 1.5}s`;
        lineDiv.style.animationDuration = `${2 + lineIndex * 0.5}s`;
        subtitleElement.appendChild(lineDiv);
    });
}

// Call on DOM load
document.addEventListener('DOMContentLoaded', function() {
    // Choose one of the typing methods:
    initTypingAnimation(); // Simple typing
    // OR: initCharByCharTyping(); // Character reveal
    // OR: initMultiLineTyping(); // Multi-line typing
});
    </script>
    
    <!-- Globe-specific styles (added inline to avoid modifying main CSS) -->
    <style>
        /* Globe background container */
        .globe-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
            background: linear-gradient(135deg, #000428 0%, #001F3F 40%, #004e92 100%);
        }
        
        #globe-canvas {
            position: absolute;
            width: 100%;
            height: 100%;
            display: block;
        }
        
        /* Ambient particles - more visible */
        .globe-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            animation: float 5s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) translateX(0); 
                opacity: 0.4; 
            }
            25% { 
                transform: translateY(-20px) translateX(5px); 
                opacity: 0.8; 
            }
            50% { 
                transform: translateY(-10px) translateX(-5px); 
                opacity: 1; 
            }
            75% { 
                transform: translateY(-15px) translateX(3px); 
                opacity: 0.7; 
            }
        }
        
        /* Additional particle animations */
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        /* Some particles with different animation */
        .particle:nth-child(3n) {
            animation: float 4s infinite ease-in-out, twinkle 2s infinite;
        }
        
        .particle:nth-child(5n) {
            animation: float 6s infinite ease-in-out;
        }
        
        /* Header content overlay - more transparent to show globe */
        .header-content-overlay {
            position: relative;
            z-index: 3;
            background: rgba(10, 26, 42, 0.4); /* More transparent */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Adjust existing header styles for overlay */
        .main-header {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }
        
        .navbar {
            background: rgba(10, 26, 42, 0.7); /* Slightly transparent */
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 2rem;
        }
        
        .hero-title, .hero-subtitle {
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.7);
        }
        
        /* FIXED: Changed text color to white instead of gradient/transparent */
        .hero-title {
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #ffffff !important; /* Force white text */
            background: none !important; /* Remove gradient background */
            -webkit-background-clip: initial !important;
            background-clip: initial !important;
        }
        
        /* FIXED: Changed text color to white */
        .hero-subtitle {
            font-size: 1.5rem;
            color: #ffffff !important; /* Force white text */
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.6;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.8);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .globe-background {
                background: linear-gradient(135deg, #000428 0%, #001F3F 60%, #004e92 100%);
            }
            
            .hero-title {
                font-size: 2.8rem;
                color: #ffffff !important;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
                color: #ffffff !important;
            }
            
            .header-content-overlay {
                background: rgba(10, 26, 42, 0.6); /* Slightly less transparent on mobile */
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
                color: #ffffff !important;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
                color: #ffffff !important;
            }
        }
    </style>
</header>