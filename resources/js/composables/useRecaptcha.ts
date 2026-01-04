import { onMounted, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

declare global {
    interface Window {
        grecaptcha: any;
    }
}

export function useRecaptcha() {
    const page = usePage();
    const siteKey = (page.props.recaptcha as { site_key: string })?.site_key;
    const isLoaded = ref(false);

    const loadRecaptcha = () => {
        if (document.getElementById('recaptcha-script')) {
            isLoaded.value = true;
            return;
        }

        const script = document.createElement('script');
        script.id = 'recaptcha-script';
        script.src = `https://www.google.com/recaptcha/api.js?render=${siteKey}`;
        script.async = true;
        script.defer = true;
        script.onload = () => {
            isLoaded.value = true;
        };
        document.head.appendChild(script);
    };

    const executeRecaptcha = async (action: string = 'submit'): Promise<string> => {
        return new Promise((resolve, reject) => {
            if (!isLoaded.value) {
                reject('reCAPTCHA not loaded');
                return;
            }

            window.grecaptcha.ready(() => {
                window.grecaptcha
                    .execute(siteKey, { action })
                    .then((token: string) => {
                        resolve(token);
                    })
                    .catch((error: any) => {
                        reject(error);
                    });
            });
        });
    };

    onMounted(() => {
        loadRecaptcha();
    });

    return {
        isLoaded,
        executeRecaptcha,
        siteKey
    };
}
