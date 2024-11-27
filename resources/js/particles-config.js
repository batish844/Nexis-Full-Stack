
    particlesJS('particles-js', {
    particles: {
        number: {
            value: 150,
            density: { enable: true, value_area: 800 }
        },
        color: { value: "#0000FF" }, // Blue circles
        shape: {
            type: "circle",
            stroke: { width: 0, color: "#000000" }
        },
        opacity: {
            value: 0.7, 
            random: true,
            anim: { enable: true, speed: 2, opacity_min: 0.2, sync: false }
        },
        size: {
            value: 5, 
            random: true,
            anim: { enable: false }
        },
        line_linked: { // Blue connecting lines
            enable: true,
            distance: 100,
            color: "#0000FF",
            opacity: 0.7,
            width: 1
        },
        move: {
            enable: true,
            speed: 2, 
            direction: "none",
            random: false,
            straight: false,
            out_mode: "out"
        }
    },
    interactivity: {
        events: {
            onhover: { enable: true, mode: "repulse" },
            onclick: { enable: true, mode: "push" }
        },
        modes: {
            repulse: { distance: 150, duration: 0.4 },
            push: { particles_nb: 6 }
        }
    }
});
