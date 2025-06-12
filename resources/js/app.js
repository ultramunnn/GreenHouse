import './bootstrap';
import '../css/app.css';

// Windows-specific optimizations
if (navigator.platform.indexOf('Win') > -1) {
    document.addEventListener('DOMContentLoaded', function() {
        const style = document.createElement('style');
        style.textContent = `
            .fi-loading-indicator,
            .fi-topbar-progress,
            .fi-progress-bar,
            .fi-progress,
            progress,
            [role="progressbar"],
            .nprogress-bar,
            .nprogress-custom-parent,
            .nprogress-busy,
            .nprogress {
                display: none !important;
                animation: none !important;
                transition: none !important;
                background: none !important;
                background-image: none !important;
            }
            [style*="linear-gradient"] {
                background: none !important;
                background-image: none !important;
            }
        `;
        document.head.appendChild(style);
    });

    const removeLoadingElements = () => {
        document.querySelectorAll(
            '.fi-loading-indicator, .fi-topbar-progress, .fi-progress-bar, .fi-progress, progress, [role="progressbar"], .nprogress-bar, .nprogress-custom-parent, .nprogress-busy, .nprogress, [style*="linear-gradient"]'
        ).forEach(el => {
            el.style.display = 'none';
            el.style.animation = 'none';
            el.style.transition = 'none';
            el.style.background = 'none';
            el.style.backgroundImage = 'none';
        });
    };
    const observer = new MutationObserver(removeLoadingElements);
    observer.observe(document.body, { childList: true, subtree: true });
    removeLoadingElements();

    // Optimize Livewire updates
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.sent', (message, component) => {
            // Disable loading states for Windows
            message.updateCallbacks = message.updateCallbacks.filter(callback => {
                return !callback.method.startsWith('loading');
            });
        });
    });
}

