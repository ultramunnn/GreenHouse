import './bootstrap';
import '../css/app.css';

// Performance optimizations
document.addEventListener('DOMContentLoaded', function() {
    // Disable all animations and transitions
    const style = document.createElement('style');
    style.textContent = `
        * {
            animation: none !important;
            transition: none !important;
        }
    `;
    document.head.appendChild(style);

    // Remove loading indicators and progress bars
    const removeLoadingElements = () => {
        const elements = document.querySelectorAll(
            '.fi-loading-indicator, .fi-topbar-progress, .fi-progress-bar, ' +
            '.fi-progress, progress, [role="progressbar"], ' +
            '.nprogress-bar, .nprogress-custom-parent, .nprogress-busy, .nprogress, ' +
            '[style*="linear-gradient"], .animate-pulse, .animate-spin'
        );
        elements.forEach(el => {
            if (el) {
                el.style.display = 'none';
                el.style.animation = 'none';
                el.style.transition = 'none';
                el.style.background = 'none';
                el.style.backgroundImage = 'none';
            }
        });
    };

    // Create observer to remove loading elements dynamically
    const observer = new MutationObserver(() => {
        removeLoadingElements();
    });

    // Start observing the document with the configured parameters
    observer.observe(document.body, { 
        childList: true, 
        subtree: true,
        attributes: true,
        attributeFilter: ['class', 'style']
    });

    // Initial cleanup
    removeLoadingElements();
});

// Optimize Livewire
document.addEventListener('livewire:load', function() {
    // Disable loading states
    Livewire.hook('message.sent', (message) => {
        message.updateCallbacks = message.updateCallbacks.filter(callback => {
            return !callback.method.includes('loading');
        });
    });

    // Optimize updates
    Livewire.hook('message.processed', () => {
        // Remove loading indicators after updates
        document.querySelectorAll('[wire\\:loading]').forEach(el => {
            el.style.display = 'none';
        });
    });

    // Disable progressive loading
    if (window.Alpine) {
        Alpine.store('filament').isNavigating = false;
    }
});

