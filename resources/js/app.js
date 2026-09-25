import { initHomepageAnimations } from "./animations/homepage";

document.addEventListener('DOMContentLoaded', initHomepageAnimations);
document.addEventListener('livewire:navigated', initHomepageAnimations);