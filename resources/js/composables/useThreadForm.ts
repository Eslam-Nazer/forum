import { Thread } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ThreadForm } from '@/types/forms';
import { useRecaptcha } from '@/composables/useRecaptcha';

export function useThreadForm(thread?: Thread) {
    const { executeRecaptcha, isLoaded } = useRecaptcha();

    const form = useForm<ThreadForm>({
        title: thread?.title ?? '',
        body: thread?.body ?? '',
        channel_id: thread?.channel.id ?? '',
        recaptcha_token: ''
    });

    const store = async (url: string) => {
        form.recaptcha_token = await executeRecaptcha('create_thread');

        return form.post(url, {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                form.recaptcha_token = '';
            },
            onError: () => {
                form.recaptcha_token = '';
            }
        });
    };

    const update = async (url: string) => {
        form.recaptcha_token = await executeRecaptcha('update_thread');

        return form.patch(url, {
            preserveScroll: true,
            onFinish: () => {
                form.recaptcha_token = '';
            }
        });
    };

    return {
        form,
        store,
        update,
        isRecaptchaLoaded: isLoaded
    };
}
