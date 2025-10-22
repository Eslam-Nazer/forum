import { nextTick, onMounted, onUnmounted } from 'vue';

export function useHashScroll() {
    async function scrollToHash(): Promise<void> {
        const hash = window.location.hash;
        if (hash) {
            await nextTick();

            const element = document.getElementById(hash.slice(1));

            if (element) {
                let offset =
                    element.getBoundingClientRect().top + window.scrollY - 100;
                window.scrollTo({
                    top: offset,
                    behavior: 'smooth',
                });
            }
        }
    }

    onMounted(() => {
        scrollToHash();
        window.addEventListener('hashchange', scrollToHash);
    });

    onUnmounted(() => {
        window.removeEventListener('hashchange', scrollToHash);
    });
}
