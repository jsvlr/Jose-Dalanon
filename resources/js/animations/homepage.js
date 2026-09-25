import { animate, stagger, createTimeline } from 'animejs';

export function initHomepageAnimations() {
    const badge = document.querySelector('[data-animate="badge"]');
    const name = document.querySelector('[data-animate="name"]');
    const role = document.querySelector('[data-animate="role"]');
    const description = document.querySelector('[data-animate="description"]');
    const socials = document.querySelectorAll('[data-animate="social"]');
    const portrait = document.querySelector('[data-animate="portrait"]');

    if(!badge || !name) return;

    animate([badge, name, role, description, ...socials, portrait], { opacity: 0, duration: 0 });

    createTimeline({ defaults: { ease: 'outExpo', duration: 700 } })
        .add(badge, { opacity: [0, 1], translateY: [-10, 0] })
        .add(name, { opacity: [0, 1], translateY: [30, 0] }, '-=400')
        .add(role, { opacity: [0, 1], translateX: [-15, 0] }, '-=350')
        .add(description, { opacity: [0, 1], translateY: [15, 0] }, '-=350')
        .add(socials, { opacity: [0, 1], translateY: [10, 0], delay: stagger(100) }, '-=300')
        .add(portrait, { opacity: [0, 1], scale: [0.85, 1] }, '-=600');

};