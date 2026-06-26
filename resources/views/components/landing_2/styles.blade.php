<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300&family=DM+Serif+Display:ital@0;1&display=swap');

    :root {
        --navy:        #0a1628;
        --navy-mid:    #122040;
        --navy-light:  #1e3a6e;
        --orange:      #e85d04;
        --orange-light:#ff6b1a;
        --cream:       #f8f5f0;
        --steel:       #4a5568;
        --steel-light: #718096;
        --white:       #ffffff;
        --border:      rgba(232,93,4,0.25);
    }

    body { font-family: 'DM Sans', sans-serif; }

    .font-display  { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.04em; }
    .font-serif-d  { font-family: 'DM Serif Display', serif; }

    /* ---- Marquee ---- */
    @keyframes marquee {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-track { animation: marquee 28s linear infinite; }
    .marquee-track:hover { animation-play-state: paused; }

    /* ---- Reveal on scroll ---- */
    .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.7s ease, transform 0.7s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* ---- Service card hover ---- */
    .svc-card { transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
    .svc-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px rgba(10,22,40,0.18); border-color: var(--orange); }

    /* ---- Equipment card ---- */
    .eq-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .eq-card:hover { transform: scale(1.03); box-shadow: 0 20px 40px rgba(10,22,40,0.22); }

    /* ---- Counter number ---- */
    .stat-number { font-family: 'Bebas Neue', sans-serif; }

    /* ---- Diagonal divider ---- */
    .clip-diagonal { clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%); }
    .clip-diagonal-rev { clip-path: polygon(0 0, 100% 5%, 100% 100%, 0 100%); }

    /* ---- Safety badge ---- */
    .badge-glow { box-shadow: 0 0 0 1px rgba(232,93,4,0.4), 0 8px 24px rgba(232,93,4,0.15); }

    /* ---- Noise grain overlay ---- */
    .grain::after {
        content: '';
        position: absolute; inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        pointer-events: none; z-index: 1;
    }

    /* ---- Geometric accent lines ---- */
    .geo-line { position: absolute; border: 1px solid rgba(232,93,4,0.15); }
</style>