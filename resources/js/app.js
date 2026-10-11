import { initHomepageAnimations } from "./animations/homepage";

// Syntax Highlighter
import hljs from "highlight.js";
import 'highlight.js/styles/github-dark.css';

document.addEventListener('DOMContentLoaded', initHomepageAnimations);
document.addEventListener('livewire:navigated', function(){
    initHomepageAnimations;
    document.querySelectorAll('.prose pre code').forEach((el) => hljs.highlightElement(el));
});