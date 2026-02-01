// Main JavaScript for Dial Dynamic Ltd. - Premium Edition

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== PREMIUM LOADER =====
    const loader = document.getElementById('premium-loader');
    if (loader) {
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
                initPremiumExperience();
            }, 800);
        }, 1500);
    } else {
        initPremiumExperience();
    }
    
    function initPremiumExperience() {
        // ===== MOBILE MENU TOGGLE =====
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
            });
        }
        
        // ===== PREMIUM BLACK HOLE ANIMATION =====
        const callContainer = document.querySelector('#call-container');
        if (callContainer && callContainer.classList.contains('future-root')) {
            initPremiumBlackHole();
        }
        
        // ===== CALL BUTTONS =====
        const answerBtn = document.getElementById('answer-btn');
        const declineBtn = document.getElementById('decline-btn');
        
        if (answerBtn) {
            answerBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href') || '?action=answer';
                this.dataset.orig = this.innerHTML;
                this.innerText = 'Embarking...';
                this.classList.add('disabled');
                setTimeout(() => window.location.href = href, 700);
            });
        }
        
        if (declineBtn) {
            declineBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href') || '?action=decline';
                this.dataset.orig = this.innerHTML;
                this.innerText = 'Decline';
                this.classList.add('disabled');
                setTimeout(() => window.location.href = href, 350);
            });
        }
        
        // ===== PREMIUM BUTTONS IN BLACK HOLE =====
        const premiumAcceptBtn = document.querySelector('.btn-accept-premium');
        const premiumDeclineBtn = document.querySelector('.btn-decline-light');
        
        if (premiumAcceptBtn) {
            premiumAcceptBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href') || '?action=answer';
                
                // Premium button feedback
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>ESTABLISHING CONNECTION...</span>';
                this.classList.add('connecting');
                
                // Animate card launch
                const card = document.querySelector('.premium-note');
                card.style.animation = 'cardLaunch 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                
                // Animate black hole warp
                const hole = document.querySelector('.premium-hole');
                if (hole) {
                    hole.style.animation = 'warpSpeed 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                }
                
                // Redirect after premium sequence
                setTimeout(() => {
                    window.location.href = href;
                }, 1800);
            });
        }
        
        if (premiumDeclineBtn) {
            premiumDeclineBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href') || '?action=decline';
                
                // Premium decline feedback
                this.innerHTML = '<i class="fas fa-ban"></i><span>TRANSMISSION TERMINATED</span>';
                this.classList.add('terminated');
                
                // Animate card fade out
                const card = document.querySelector('.premium-note');
                card.style.animation = 'cardFadeOut 1s ease forwards';
                
                // Animate black hole collapse
                const hole = document.querySelector('.premium-hole');
                if (hole) {
                    hole.style.animation = 'blackholeCollapse 1s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                }
                
                // Redirect
                setTimeout(() => {
                    window.location.href = href;
                }, 1200);
            });
        }
        
        // ===== SMOOTH SCROLLING =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        
                        if (navMenu.classList.contains('active')) {
                            navMenu.classList.remove('active');
                        }
                    }
                }
            });
        });
        
        // ===== PREMIUM AUDIO CONTROL =====
        window.playRingtone = function() {
            const ringtone = document.getElementById('ringtone');
            if (ringtone) {
                ringtone.volume = 0.4;
                ringtone.play().catch(e => {
                    console.log("Audio play requires user interaction");
                });
            }
        };
        
        window.pauseRingtone = function() {
            const ringtone = document.getElementById('ringtone');
            if (ringtone) {
                ringtone.pause();
                ringtone.currentTime = 0;
            }
        };
        
        window.playPremiumSound = function(type) {
            const audio = new Audio();
            switch(type) {
                case 'click':
                    audio.src = 'assets/audio/click.mp3';
                    break;
                case 'hover':
                    audio.src = 'assets/audio/hover.mp3';
                    break;
                case 'success':
                    audio.src = 'assets/audio/success.mp3';
                    break;
                default:
                    return;
            }
            audio.volume = 0.3;
            audio.play().catch(e => console.log("Audio requires interaction"));
        };
        
        // ===== PREMIUM INTERACTIONS =====
        document.querySelectorAll('.btn-accept-premium, .btn-answer').forEach(btn => {
            btn.addEventListener('mouseenter', () => window.playPremiumSound('hover'));
            btn.addEventListener('click', () => window.playPremiumSound('click'));
        });
        
        // ===== PARALLAX EFFECT =====
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax');
            
            parallaxElements.forEach(element => {
                const rate = element.getAttribute('data-rate') || 0.5;
                const movement = -(scrolled * rate);
                element.style.transform = `translateY(${movement}px)`;
            });
        });
        
        // ===== INTERSECTION OBSERVER FOR ANIMATIONS =====
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Observe About blocks and trigger left/right fade-in on enter, fade-out on leave
        const aboutBlocks = document.querySelectorAll('#about-connected .about-block');
        if (aboutBlocks.length) {
            const aboutObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    } else {
                        entry.target.classList.remove('in-view');
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -80px 0px' });

            aboutBlocks.forEach(b => aboutObserver.observe(b));
        }

        // Enable click/tap flip for feature cards (useful for touch devices)
        const flipCards = document.querySelectorAll('.feature.flip-card');
        if (flipCards.length) {
            flipCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Prevent flipping if user clicked a link inside
                    if (e.target.closest('a')) return;
                    card.classList.toggle('flipped');
                });
                // Accessibility: allow keyboard toggle
                card.setAttribute('tabindex', '0');
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        card.classList.toggle('flipped');
                    }
                });
            });
        }
        
        // ===== GREETING OVERLAY AUTO-HIDE =====
        const greeting = document.getElementById('greeting-overlay');
        if (greeting) {
            const SHOW_MS = 1000; // show for 1 second
            setTimeout(() => {
                greeting.classList.add('hide');
                window.playPremiumSound('success');
                setTimeout(() => greeting.remove(), 300); // remove shortly after hiding
            }, SHOW_MS);
        }
        
        // ===== CONSOLE WELCOME MESSAGE =====
        console.log('%c🚀 DIAL DYNAMIC LTD. - PREMIUM EXPERIENCE', 'color: #409CFF; font-size: 20px; font-weight: bold; text-shadow: 0 0 10px #409CFF');
        console.log('%c🌌 Premium black hole interface activated', 'color: #64C8FF; font-size: 14px;');
        console.log('%c🔊 Immersive audio system ready', 'color: #FF2D5C; font-size: 14px;');
    }
    
    // ===== PREMIUM BLACK HOLE ANIMATION FUNCTION =====
    function initPremiumBlackHole() {
        const root = document.querySelector('.future-root');
        if (!root) return;
        
        // Check for reduced motion
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduceMotion) {
            const hole = root.querySelector('.future-hole');
            const card = root.querySelector('.future-card');
            
            setTimeout(() => {
                if (hole) hole.classList.add('open');
                if (card) card.classList.add('arrived');
            }, 300);
            return;
        }
        
        // Create animated star field
        createStarField();
        
        // Animate black hole opening
        setTimeout(() => {
            const hole = root.querySelector('.premium-hole');
            if (hole) hole.classList.add('open');
        }, 100);
        
        // Animate company note arrival
        setTimeout(() => {
            const note = root.querySelector('.premium-note');
            if (note) note.classList.add('arrived');
        }, 800);
        
        // Create canvas particles
        const canvas = document.createElement('canvas');
        canvas.className = 'blackhole-canvas';
        root.appendChild(canvas);
        const ctx = canvas.getContext('2d');
        
        let w, h, cx, cy, rafId;
        let particles = [];
        let starParticles = [];
        
        function resize() {
            w = canvas.width = root.clientWidth;
            h = canvas.height = root.clientHeight;
            cx = w / 2;
            cy = h / 2.6;
            initParticles();
        }
        
        function initParticles() {
            particles = [];
            starParticles = [];
            
            // Create accretion particles
            const particleCount = Math.min(180, Math.floor((w * h) / 8000));
            for (let i = 0; i < particleCount; i++) {
                const angle = Math.random() * Math.PI * 2;
                const distance = Math.random() * 300 + 100;
                particles.push({
                    angle: angle,
                    distance: distance,
                    speed: (0.002 + Math.random() * 0.005) * (distance / 400),
                    size: Math.random() * 1.5 + 0.5,
                    hue: 200 + Math.random() * 40,
                    alpha: Math.random() * 0.5 + 0.3
                });
            }
            
            // Create star particles
            const starCount = Math.min(60, Math.floor((w * h) / 12000));
            for (let i = 0; i < starCount; i++) {
                starParticles.push({
                    x: cx,
                    y: cy,
                    vx: (Math.random() - 0.5) * 4,
                    vy: (Math.random() - 0.5) * 4,
                    life: 1,
                    decay: 0.002 + Math.random() * 0.003,
                    size: Math.random() * 2 + 1,
                    hue: 180 + Math.random() * 60
                });
            }
        }
        
        function render(t) {
            ctx.clearRect(0, 0, w, h);
            
            // Draw particle accretion disk
            particles.forEach(p => {
                p.angle += p.speed;
                p.distance = Math.max(50, p.distance * 0.9995);
                
                const x = cx + Math.cos(p.angle) * p.distance;
                const y = cy + Math.sin(p.angle) * p.distance * 0.7;
                
                const gradient = ctx.createRadialGradient(x, y, 0, x, y, p.size * 3);
                gradient.addColorStop(0, `hsla(${p.hue}, 80%, 70%, ${p.alpha})`);
                gradient.addColorStop(1, 'transparent');
                
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(x, y, p.size * 2, 0, Math.PI * 2);
                ctx.fill();
            });
            
            // Draw flying star particles
            starParticles.forEach((p, i) => {
                p.x += p.vx;
                p.y += p.vy;
                p.life -= p.decay;
                
                if (p.life <= 0) {
                    p.x = cx;
                    p.y = cy;
                    p.vx = (Math.random() - 0.5) * 4;
                    p.vy = (Math.random() - 0.5) * 4;
                    p.life = 1;
                    p.size = Math.random() * 2 + 1;
                }
                
                const gradient = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size * 4);
                gradient.addColorStop(0, `hsla(${p.hue}, 100%, 80%, ${p.life})`);
                gradient.addColorStop(1, 'transparent');
                
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size * 2, 0, Math.PI * 2);
                ctx.fill();
                
                // Draw trail
                ctx.strokeStyle = `hsla(${p.hue}, 80%, 70%, ${p.life * 0.3})`;
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(p.x - p.vx * 2, p.y - p.vy * 2);
                ctx.lineTo(p.x, p.y);
                ctx.stroke();
            });
            
            // Draw central glow
            const glow = ctx.createRadialGradient(cx, cy, 0, cx, cy, Math.max(w, h) * 0.4);
            glow.addColorStop(0, 'rgba(100, 180, 255, 0.05)');
            glow.addColorStop(0.5, 'rgba(50, 100, 150, 0.02)');
            glow.addColorStop(1, 'transparent');
            ctx.fillStyle = glow;
            ctx.fillRect(0, 0, w, h);
            
            rafId = requestAnimationFrame(render);
        }
        
        function start() {
            resize();
            rafId = requestAnimationFrame(render);
        }
        
        window.addEventListener('resize', resize);
        start();
        
        // Auto-redirect after 30 seconds if no interaction
        const redirectTimer = setTimeout(() => {
            window.location.href = 'index.php?action=decline';
        }, 30000);
        
        // Clear timer on interaction
        root.addEventListener('click', () => clearTimeout(redirectTimer));
        
        // Cleanup
        window.addEventListener('beforeunload', () => {
            clearTimeout(redirectTimer);
            cancelAnimationFrame(rafId);
            window.removeEventListener('resize', resize);
        });
    }
    
    // ===== CREATE ANIMATED STAR FIELD =====
    function createStarField() {
        const starField = document.querySelector('.star-field');
        if (!starField) return;
        
        for (let i = 0; i < 120; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            
            const size = Math.random() * 3 + 1;
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            const delay = Math.random() * 5;
            const duration = Math.random() * 3 + 2;
            
            star.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${x}%;
                top: ${y}%;
                animation-delay: ${delay}s;
                animation-duration: ${duration}s;
                opacity: ${Math.random() * 0.5 + 0.3};
            `;
            
            starField.appendChild(star);
        }
    }
    
    // ===== SPARKLE EFFECTS =====
    document.addEventListener('mouseover', function(e) {
        if (e.target.classList.contains('btn-accept-premium')) {
            createSparkles(e.target);
        }
    });
    
    function createSparkles(element) {
        if (!element.classList.contains('sparkling')) {
            element.classList.add('sparkling');
            
            const sparkleCount = 8;
            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                
                const rect = element.getBoundingClientRect();
                const x = Math.random() * rect.width;
                const y = Math.random() * rect.height;
                
                sparkle.style.cssText = `
                    left: ${x}px;
                    top: ${y}px;
                    transform: scale(${Math.random() * 0.5 + 0.5});
                    animation-delay: ${Math.random() * 0.3}s;
                `;
                
                element.appendChild(sparkle);
                
                setTimeout(() => {
                    sparkle.remove();
                }, 600);
            }
            
            setTimeout(() => {
                element.classList.remove('sparkling');
            }, 600);
        }
    }
});

// Auto-start ringtone for call experience
if (document.querySelector('#call-container') && !document.querySelector('.future-root')) {
    setTimeout(function() {
        const ringtone = document.getElementById('ringtone');
        if (ringtone) {
            ringtone.volume = 0.4;
            ringtone.play().catch(e => {
                console.log("Autoplay prevented. Interaction required.");
            });
        }
    }, 1000);
}

//  DDHOSTER Logo JavaScript 
 document.addEventListener('DOMContentLoaded', function() {
            const ddhosterLogoContainer = document.querySelector('.ddhoster-logo-container');
            if (!ddhosterLogoContainer) return;

            const connections = ddhosterLogoContainer.querySelector('#ddhosterConnections');
            const dd1 = ddhosterLogoContainer.querySelector('#ddhosterDD1');
            const dd2 = ddhosterLogoContainer.querySelector('#ddhosterDD2');
            const serverBody = ddhosterLogoContainer.querySelector('#ddhosterServerBody');
            const logoGroup = ddhosterLogoContainer.querySelector('.ddhoster-logo-group');
            const serverIcon = ddhosterLogoContainer.querySelector('.ddhoster-server-icon');
            
            // Calculate connection points dynamically
            function getConnectionPoints() {
                const containerRect = ddhosterLogoContainer.getBoundingClientRect();
                const logoGroupRect = logoGroup.getBoundingClientRect();
                const serverRect = serverIcon.getBoundingClientRect();
                
                // Calculate positions relative to container
                const containerLeft = containerRect.left;
                const containerTop = containerRect.top;
                
                // DD letters position (right side of the last D)
                const ddLetters = ddhosterLogoContainer.querySelectorAll('.ddhoster-letter');
                const lastDD = ddLetters[ddLetters.length - 1];
                const ddRect = lastDD.getBoundingClientRect();
                
                const ddRight = {
                    x: ddRect.right - containerLeft + 2,
                    y: ddRect.top - containerTop + (ddRect.height / 2)
                };
                
                // Server position (left side)
                const serverLeft = {
                    x: serverRect.left - containerLeft,
                    y: serverRect.top - containerTop + (serverRect.height / 2)
                };
                
                // Hoster text position (right side)
                const hosterText = ddhosterLogoContainer.querySelector('.ddhoster-text');
                const hosterRect = hosterText.getBoundingClientRect();
                
                const hosterRight = {
                    x: hosterRect.right - containerLeft,
                    y: hosterRect.top - containerTop + (hosterRect.height / 2)
                };
                
                return { ddRight, serverLeft, hosterRight };
            }
            
            // Trigger color change on DD letters
            function triggerDDColorChange(letter) {
                letter.style.animation = 'none';
                void letter.offsetWidth; // Trigger reflow
                letter.style.animation = '';
                letter.style.transform = letter.style.transform + ' scale(1.1)';
                setTimeout(() => {
                    if (letter === dd1) {
                        letter.style.transform = 'translateY(0) rotate(-5deg)';
                    } else if (letter === dd2) {
                        letter.style.transform = 'translateY(0) rotate(5deg)';
                    }
                }, 300);
            }
            
            // Trigger color change on server
            function triggerServerColorChange() {
                serverBody.style.animation = 'none';
                void serverBody.offsetWidth; // Trigger reflow
                serverBody.style.animation = '';
                serverBody.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    serverBody.style.transform = 'scale(1)';
                }, 300);
            }
            
            // Create continuous data flow
            function createDataFlow() {
                const { ddRight, serverLeft, hosterRight } = getConnectionPoints();
                
                // Create connections from DD to Server
                createConnection(ddRight, serverLeft, 'server', 0);
                
                // Create connections from Hoster to Server (with delay)
                setTimeout(() => {
                    createConnection(hosterRight, serverLeft, 'server', 0);
                }, 400);
                
                // Create connections from Server to DD (with delay)
                setTimeout(() => {
                    createConnection(serverLeft, ddRight, 'dd', 0);
                }, 800);
                
                // Repeat the flow with varied timing
                setTimeout(createDataFlow, 3000 + Math.random() * 1000);
            }
            
            // Create a single connection
            function createConnection(start, end, targetType, delay) {
                setTimeout(() => {
                    // Create the connection line
                    const line = document.createElement('div');
                    line.className = 'ddhoster-connection-line';
                    
                    // Calculate line properties
                    const dx = end.x - start.x;
                    const dy = end.y - start.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    const angle = Math.atan2(dy, dx) * 180 / Math.PI;
                    
                    line.style.width = `${distance}px`;
                    line.style.left = `${start.x}px`;
                    line.style.top = `${start.y}px`;
                    line.style.transform = `rotate(${angle}deg)`;
                    
                    connections.appendChild(line);
                    
                    // Animate line appearance
                    setTimeout(() => {
                        line.style.opacity = '0.4';
                        line.style.transition = 'opacity 0.3s ease';
                    }, 100);
                    
                    // Create data dot moving along the line
                    const dot = document.createElement('div');
                    dot.className = 'ddhoster-data-dot';
                    
                    dot.style.left = `${start.x}px`;
                    dot.style.top = `${start.y}px`;
                    dot.style.opacity = '0.8';
                    
                    connections.appendChild(dot);
                    
                    // Animate dot along the path
                    const duration = 1000 + Math.random() * 400;
                    
                    const animation = dot.animate([
                        { transform: 'translate(0, 0) scale(1)', opacity: 0.8 },
                        { transform: `translate(${dx}px, ${dy}px) scale(0.5)`, opacity: 0 }
                    ], {
                        duration: duration,
                        easing: 'ease-in-out'
                    });
                    
                    // When dot reaches destination, trigger color change
                    setTimeout(() => {
                        if (targetType === 'dd') {
                            // Randomly select which D to change
                            const ddLetter = Math.random() > 0.5 ? dd2 : dd1;
                            triggerDDColorChange(ddLetter);
                        } else if (targetType === 'server') {
                            triggerServerColorChange();
                        }
                    }, duration - 100);
                    
                    // Remove dot after animation
                    animation.onfinish = () => {
                        if (dot.parentNode) {
                            dot.parentNode.removeChild(dot);
                        }
                    };
                    
                    // Remove line after animation
                    setTimeout(() => {
                        line.style.opacity = '0';
                        setTimeout(() => {
                            if (line.parentNode) {
                                line.parentNode.removeChild(line);
                            }
                        }, 500);
                    }, duration + 200);
                    
                }, delay);
            }
            
            // Initialize animations
            createDataFlow();
            
            // Interactive hover effects
            [dd1, dd2].forEach((letter) => {
                letter.addEventListener('mouseenter', function() {
                    triggerDDColorChange(this);
                });
                
                letter.addEventListener('touchstart', function(e) {
                    e.preventDefault();
                    triggerDDColorChange(this);
                });
            });
            
            serverBody.addEventListener('mouseenter', function() {
                triggerServerColorChange();
            });
            
            serverBody.addEventListener('touchstart', function(e) {
                e.preventDefault();
                triggerServerColorChange();
            });
            
            // Click to manually trigger connection
            ddhosterLogoContainer.addEventListener('click', function(e) {
                e.stopPropagation();
                triggerDDColorChange(dd1);
                triggerDDColorChange(dd2);
                triggerServerColorChange();
            });
            
            // Touch support for mobile
            ddhosterLogoContainer.addEventListener('touchstart', function(e) {
                e.preventDefault();
                e.stopPropagation();
                triggerDDColorChange(dd1);
                triggerDDColorChange(dd2);
                triggerServerColorChange();
            });
        });


            // <!-- Footer Globe JavaScript -->
        
            // Create ambient particles for footer
            function createFooterGlobeParticles() {
                const particlesContainer = document.getElementById('footer-globe-particles');
                if (!particlesContainer) return;

                // Clear existing particles
                particlesContainer.innerHTML = '';

                // Create particles for footer
                for (let i = 0; i < 80; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'footer-particle';

                    // Random size
                    const size = Math.random() * 3 + 1;
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
                        particle.style.backgroundColor = 'rgba(100, 200, 255, 0.6)'; // Bright blue
                    } else if (colorVariation < 0.9) {
                        particle.style.backgroundColor = 'rgba(180, 230, 255, 0.8)'; // Bright white-blue
                    } else {
                        particle.style.backgroundColor = 'rgba(255, 255, 255, 0.7)'; // White
                    }

                    // Add glow effect
                    particle.style.boxShadow = '0 0 6px rgba(100, 200, 255, 0.6)';

                    particlesContainer.appendChild(particle);
                }
            }

            // Footer Globe Canvas Setup
            function setupFooterGlobe() {
                const canvas = document.getElementById('footer-globe-canvas');
                if (!canvas) return;

                const ctx = canvas.getContext('2d');
                let animationId;

                // Make canvas responsive to footer size
                function resizeFooterCanvas() {
                    const footer = document.querySelector('.footer');
                    if (!footer) return;

                    const footerRect = footer.getBoundingClientRect();
                    canvas.width = footerRect.width;
                    canvas.height = footerRect.height;

                    // Reposition canvas for footer layout
                    const canvasContainer = document.querySelector('.footer-globe-background');
                    if (canvasContainer) {
                        canvasContainer.style.width = footerRect.width + 'px';
                        canvasContainer.style.height = footerRect.height + 'px';
                    }
                }

                resizeFooterCanvas();
                window.addEventListener('resize', resizeFooterCanvas);

                // Position globe in footer
                const getCenterX = () => canvas.width * 0.85;
                const getCenterY = () => canvas.height * 0.6;
                const getRadius = () => Math.min(canvas.width, canvas.height) * 0.25;

                let rotation = 0;

                // Earth geometry - continents (same as header)
                const continents = [
                    // North America
                    [{
                            lat: 70,
                            lon: -100
                        }, {
                            lat: 60,
                            lon: -135
                        }, {
                            lat: 55,
                            lon: -130
                        },
                        {
                            lat: 50,
                            lon: -125
                        }, {
                            lat: 49,
                            lon: -95
                        }, {
                            lat: 45,
                            lon: -75
                        },
                        {
                            lat: 30,
                            lon: -80
                        }, {
                            lat: 25,
                            lon: -95
                        }, {
                            lat: 20,
                            lon: -105
                        },
                        {
                            lat: 30,
                            lon: -115
                        }, {
                            lat: 35,
                            lon: -118
                        }
                    ],
                    // South America
                    [{
                            lat: -2,
                            lon: -80
                        }, {
                            lat: -5,
                            lon: -75
                        }, {
                            lat: -10,
                            lon: -60
                        },
                        {
                            lat: -20,
                            lon: -55
                        }, {
                            lat: -35,
                            lon: -60
                        }, {
                            lat: -50,
                            lon: -70
                        },
                        {
                            lat: -40,
                            lon: -75
                        }, {
                            lat: -20,
                            lon: -80
                        }, {
                            lat: -5,
                            lon: -80
                        }
                    ],
                    // Europe
                    [{
                            lat: 70,
                            lon: 25
                        }, {
                            lat: 65,
                            lon: 30
                        }, {
                            lat: 60,
                            lon: 10
                        },
                        {
                            lat: 55,
                            lon: 35
                        }, {
                            lat: 50,
                            lon: 5
                        }, {
                            lat: 45,
                            lon: 0
                        },
                        {
                            lat: 42,
                            lon: 10
                        }, {
                            lat: 40,
                            lon: 30
                        }, {
                            lat: 36,
                            lon: 10
                        }
                    ],
                    // Africa
                    [{
                            lat: 32,
                            lon: 10
                        }, {
                            lat: 25,
                            lon: 35
                        }, {
                            lat: 15,
                            lon: 42
                        },
                        {
                            lat: 0,
                            lon: 40
                        }, {
                            lat: -15,
                            lon: 35
                        }, {
                            lat: -30,
                            lon: 30
                        },
                        {
                            lat: -35,
                            lon: 20
                        }, {
                            lat: -25,
                            lon: 15
                        }, {
                            lat: 10,
                            lon: 0
                        }
                    ],
                    // Asia
                    [{
                            lat: 75,
                            lon: 100
                        }, {
                            lat: 70,
                            lon: 140
                        }, {
                            lat: 60,
                            lon: 150
                        },
                        {
                            lat: 50,
                            lon: 142
                        }, {
                            lat: 45,
                            lon: 135
                        }, {
                            lat: 35,
                            lon: 140
                        },
                        {
                            lat: 25,
                            lon: 120
                        }, {
                            lat: 10,
                            lon: 105
                        }, {
                            lat: 20,
                            lon: 95
                        },
                        {
                            lat: 30,
                            lon: 80
                        }, {
                            lat: 40,
                            lon: 70
                        }, {
                            lat: 50,
                            lon: 60
                        },
                        {
                            lat: 60,
                            lon: 70
                        }
                    ],
                    // Australia
                    [{
                            lat: -12,
                            lon: 130
                        }, {
                            lat: -10,
                            lon: 142
                        }, {
                            lat: -18,
                            lon: 148
                        },
                        {
                            lat: -28,
                            lon: 153
                        }, {
                            lat: -38,
                            lon: 145
                        }, {
                            lat: -35,
                            lon: 138
                        },
                        {
                            lat: -32,
                            lon: 125
                        }, {
                            lat: -20,
                            lon: 115
                        }, {
                            lat: -15,
                            lon: 125
                        }
                    ]
                ];

                // Strategic connection nodes (major hub cities)
                const nodes = [{
                        lat: 40.7,
                        lon: -74
                    }, // New York
                    {
                        lat: 51.5,
                        lon: -0.1
                    }, // London
                    {
                        lat: 35.7,
                        lon: 139.7
                    }, // Tokyo
                    {
                        lat: -33.9,
                        lon: 151.2
                    }, // Sydney
                    {
                        lat: 1.3,
                        lon: 103.8
                    }, // Singapore
                    {
                        lat: 55.8,
                        lon: 37.6
                    }, // Moscow
                    {
                        lat: 31.2,
                        lon: 121.5
                    }, // Shanghai
                    {
                        lat: 52.5,
                        lon: 13.4
                    }, // Berlin
                    {
                        lat: 25.3,
                        lon: 55.3
                    }, // Dubai
                    {
                        lat: 34.1,
                        lon: -118.2
                    }, // Los Angeles
                    {
                        lat: -23.5,
                        lon: -46.6
                    }, // São Paulo
                    {
                        lat: 19.4,
                        lon: -99.1
                    } // Mexico City
                ];

                // Organized connections
                const connections = [{
                        start: nodes[0],
                        end: nodes[1]
                    }, // NY-London
                    {
                        start: nodes[0],
                        end: nodes[7]
                    }, // NY-Berlin
                    {
                        start: nodes[9],
                        end: nodes[1]
                    }, // LA-London
                    {
                        start: nodes[2],
                        end: nodes[9]
                    }, // Tokyo-LA
                    {
                        start: nodes[2],
                        end: nodes[0]
                    }, // Tokyo-NY
                    {
                        start: nodes[3],
                        end: nodes[2]
                    }, // Sydney-Tokyo
                    {
                        start: nodes[4],
                        end: nodes[2]
                    }, // Singapore-Tokyo
                    {
                        start: nodes[4],
                        end: nodes[6]
                    }, // Singapore-Shanghai
                    {
                        start: nodes[6],
                        end: nodes[2]
                    }, // Shanghai-Tokyo
                    {
                        start: nodes[1],
                        end: nodes[7]
                    }, // London-Berlin
                    {
                        start: nodes[1],
                        end: nodes[5]
                    }, // London-Moscow
                    {
                        start: nodes[7],
                        end: nodes[5]
                    }, // Berlin-Moscow
                    {
                        start: nodes[8],
                        end: nodes[1]
                    }, // Dubai-London
                    {
                        start: nodes[8],
                        end: nodes[4]
                    }, // Dubai-Singapore
                    {
                        start: nodes[0],
                        end: nodes[11]
                    }, // NY-Mexico
                    {
                        start: nodes[10],
                        end: nodes[11]
                    }, // Sao Paulo-Mexico
                    {
                        start: nodes[9],
                        end: nodes[11]
                    } // LA-Mexico
                ];

                connections.forEach(conn => {
                    conn.pulseOffset = Math.random() * Math.PI * 2;
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

                // Draw function for footer globe
                function drawFooterGlobe() {
                    const centerX = getCenterX();
                    const centerY = getCenterY();
                    const radius = getRadius();

                    // Clear canvas with transparent background
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    rotation += 0.0015; // Slower rotation for footer

                    // Draw globe base (subtle sphere)
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                    const globeGradient = ctx.createRadialGradient(
                        centerX, centerY, radius * 0.3,
                        centerX, centerY, radius * 1.1
                    );
                    globeGradient.addColorStop(0, 'rgba(20, 60, 120, 0.08)');
                    globeGradient.addColorStop(1, 'rgba(10, 40, 90, 0.03)');
                    ctx.fillStyle = globeGradient;
                    ctx.fill();

                    // Draw latitude lines
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
                        ctx.strokeStyle = 'rgba(80, 160, 240, 0.3)';
                        ctx.lineWidth = 1;
                        ctx.stroke();
                    }

                    // Draw longitude lines
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
                        ctx.strokeStyle = 'rgba(80, 160, 240, 0.3)';
                        ctx.lineWidth = 1;
                        ctx.stroke();
                    }

                    // Draw connections with animated pulses
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

                            const steps = 15;
                            for (let i = 1; i <= steps; i++) {
                                const t = i / steps;
                                const mid = interpolateLatLon(conn.start, conn.end, t);
                                const midVec = latLonToVector(mid.lat, mid.lon, radius + 6);
                                const midRot = rotateY(midVec.x, midVec.y, midVec.z, rotation);
                                const midProj = project(midRot.x, midRot.y, midRot.z, centerX, centerY, radius);
                                ctx.lineTo(midProj.x, midProj.y);
                            }

                            const pulse = Math.sin(Date.now() * 0.001 + conn.pulseOffset) * 0.4 + 0.6;
                            ctx.strokeStyle = `rgba(100, 180, 255, ${0.3 + pulse * 0.3})`;
                            ctx.lineWidth = 1.5;
                            ctx.stroke();
                        }
                    });

                    // Draw continents with subtle glow
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
                            ctx.fillStyle = 'rgba(70, 150, 230, 0.25)';
                            ctx.fill();
                            ctx.strokeStyle = 'rgba(140, 200, 255, 0.6)';
                            ctx.lineWidth = 1.5;
                            ctx.stroke();
                        }
                    });

                    // Draw nodes
                    nodes.forEach(node => {
                        const vec = latLonToVector(node.lat, node.lon, radius + 2);
                        const rotated = rotateY(vec.x, vec.y, vec.z, rotation);
                        const proj = project(rotated.x, rotated.y, rotated.z, centerX, centerY, radius);

                        if (proj.visible) {
                            const pulse = Math.sin(Date.now() * 0.002) * 0.4 + 0.8;

                            // Outer glow
                            const gradient = ctx.createRadialGradient(proj.x, proj.y, 0, proj.x, proj.y, 12 * pulse);
                            gradient.addColorStop(0, 'rgba(140, 220, 255, 0.7)');
                            gradient.addColorStop(0.3, 'rgba(100, 180, 240, 0.5)');
                            gradient.addColorStop(1, 'rgba(80, 160, 220, 0)');

                            ctx.fillStyle = gradient;
                            ctx.beginPath();
                            ctx.arc(proj.x, proj.y, 12 * pulse, 0, Math.PI * 2);
                            ctx.fill();

                            // Bright core
                            ctx.fillStyle = 'rgba(200, 240, 255, 0.9)';
                            ctx.beginPath();
                            ctx.arc(proj.x, proj.y, 3 * proj.scale, 0, Math.PI * 2);
                            ctx.fill();
                        }
                    });

                    animationId = requestAnimationFrame(drawFooterGlobe);
                }

                // Start animation
                drawFooterGlobe();

                // Cleanup function
                return () => {
                    if (animationId) {
                        cancelAnimationFrame(animationId);
                    }
                    window.removeEventListener('resize', resizeFooterCanvas);
                };
            }

            // Initialize footer globe when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                createFooterGlobeParticles();
                setupFooterGlobe();
            });

            // Reinitialize on window resize
            window.addEventListener('resize', function() {
                createFooterGlobeParticles();
            });
        