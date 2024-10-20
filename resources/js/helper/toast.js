import { usePage } from '@inertiajs/inertia-vue3';
import { useToast } from 'vue-toastification';
import { watch } from 'vue';

const toast = {
  flash: () => {
    const toast = useToast();
    const toastSession = usePage().props.value.toast;
    console.log(usePage().props.value.toast);

    if (toastSession) {
      toast[toastSession.status](toastSession.message);
    }

    watch(
      () => usePage().props.value.toast,
      (newToastSession, oldToastSession) => {
        if (newToastSession !== oldToastSession) {
          if (newToastSession) {
            toast[newToastSession.status](newToastSession.message);
          }
        }

        usePage().props.value.toast = null
      }
    );
  },
  error: (message) => {
    const toast = useToast();

    toast.error(message);
  }
};

export default toast;
