document.addEventListener('livewire:navigated', function(){
    if (localStorage.theme == 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});