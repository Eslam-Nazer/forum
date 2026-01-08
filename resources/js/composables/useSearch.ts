import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

type UseSearchOptions = {
    url: string;
    preserveState?: boolean;
    replace?: boolean;
}

export function useSearch<T extends Record<string, any>>(
    initialData: T,
    options: UseSearchOptions
) {
    const form = useForm(initialData);

    const canSubmit = computed(() => {
        return Object.values(form.data()).some(
            value => String(value).trim() !== '' && String(value).length > 2
        );
    });

    const submit = () => {
        if (!canSubmit.value) {
            return;
        }

        form.get(options.url, {
            preserveState: options.preserveState ?? true,
            replace: options.replace ?? true
        });
    };

    return {
        form,
        canSubmit,
        submit
    }
}
