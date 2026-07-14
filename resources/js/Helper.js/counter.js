import { ref } from "vue";

export function useCounter() {
    const count = ref(0);

    const start = (target, speed = 20) => {
        count.value = 0;

        const interval = setInterval(() => {
            count.value++;

            if (count.value >= target) {
                count.value = target;
                clearInterval(interval);
            }
        }, speed);
    };

    return {
        count,
        start,
    };
}