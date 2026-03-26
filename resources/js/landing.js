document.addEventListener('DOMContentLoaded', () => {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target){
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Fade-in animation for features
    const features = document.querySelectorAll('.feature-card');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('opacity-100','translate-y-0');
            }
        });
    },{
        threshold: 0.2
    });

    features.forEach(f => {
        f.classList.add('opacity-0','translate-y-10','transition','duration-700');
        observer.observe(f);
    });
});
