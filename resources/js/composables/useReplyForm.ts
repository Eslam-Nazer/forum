import { Reply } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ReplyForm } from '@/types/forms';

export function useReplyForm(reply?: Reply) {

    const form = useForm<ReplyForm>({
        body: reply?.body ?? ''
    });

    const store = (url: string) => {
        return form.post(url, {
            preserveScroll: true,
            onSuccess: () => form.reset()
        });
    };

    const update = async (url: string, success?: () => void) => {
        return form.patch(url, {
            preserveScroll: true,
            onSuccess: () => {
                if (success !== undefined) {
                    success();
                }
            }
        });
    };

    const destroy = (url: string) => {
        return form.delete(url, {
            preserveScroll: true
        });
    };

    return {
        form,
        store,
        update,
        destroy
    };
}
