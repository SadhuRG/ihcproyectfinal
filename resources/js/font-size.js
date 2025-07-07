document.addEventListener('DOMContentLoaded', () => {
    let fontSizeLevel = parseInt(localStorage.getItem('fontSizeLevel')) || 0;
    const htmlElement = document.querySelector('html');
    const fontSizeLabel = document.getElementById('font-size-label');
    const fontSizeBtn = document.getElementById('font-size-btn');

    const labels = ['A', 'A+', 'A++', 'A+++'];

    function applyFontSize(level) {
        htmlElement.style.transition = 'font-size 0.3s ease'; // Animación suave
        htmlElement.style.fontSize = (100 + level * 10) + '%';
        localStorage.setItem('fontSizeLevel', level);
        fontSizeLabel.textContent = labels[level]; // Cambia la etiqueta del botón
    }

    fontSizeBtn?.addEventListener('click', () => {
        fontSizeLevel = (fontSizeLevel + 1) % 4; // 0%, 10%, 20%, 30% -> vuelve a A
        applyFontSize(fontSizeLevel);
    });

    // Aplica tamaño al cargar
    applyFontSize(fontSizeLevel);

    // Toggle menú móvil
    document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
});
