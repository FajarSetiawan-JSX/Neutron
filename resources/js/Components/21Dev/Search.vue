<script setup>
import { ref, nextTick } from 'vue'
import { Search, X } from 'lucide-vue-next'

const props = defineProps({
    placeholder: {
        type: String,
        default: 'Search...',
    },

    modelValue: {
        type: String,
        default: '',
    },
})

const emit = defineEmits([
    'update:modelValue',
    'search',
])

const isExpanded = ref(false)
const query = ref(props.modelValue)
const inputRef = ref(null)

const expand = async () => {
    isExpanded.value = true

    await nextTick()

    inputRef.value?.focus()
}

const collapse = () => {
    isExpanded.value = false
    query.value = ''

    emit('update:modelValue', '')
}

const handleInput = (event) => {
    query.value = event.target.value

    emit('update:modelValue', query.value)
}

const handleSubmit = () => {
    if (!query.value.trim()) return

    emit('search', query.value.trim())
}
</script>

<template>
    <div class="relative h-12">

        <!-- =========================
             COLLAPSED SEARCH BUTTON
        ========================== -->
        <Transition
            enter-active-class="search-icon-enter-active"
            enter-from-class="search-icon-enter-from"
            enter-to-class="search-icon-enter-to"

            leave-active-class="search-icon-leave-active"
            leave-from-class="search-icon-leave-from"
            leave-to-class="search-icon-leave-to"
        >
            <button
                v-if="!isExpanded"
                type="button"
                class="
                    flex h-12 w-12
                    items-center justify-center
                    rounded-full
                    border border-border
                    bg-card
                    text-foreground
                    transition-colors
                    hover:bg-muted
                "
                @click="expand"
            >
                <Search class="h-5 w-5" />
            </button>
        </Transition>


        <!-- =========================
             EXPANDED SEARCH
        ========================== -->
        <Transition
            enter-active-class="search-form-enter-active"
            enter-from-class="search-form-enter-from"
            enter-to-class="search-form-enter-to"

            leave-active-class="search-form-leave-active"
            leave-from-class="search-form-leave-from"
            leave-to-class="search-form-leave-to"
        >
            <form
                v-if="isExpanded"
                class="
                    absolute
                    left-0 top-0
                    w-[320px]
                    max-w-[calc(100vw-2rem)]
                "
                @submit.prevent="handleSubmit"
            >

                <div
                    class="
                        flex h-12 w-full
                        items-center gap-2
                        overflow-hidden
                        rounded-full
                        border border-border
                        bg-card/80
                        backdrop-blur-md
                    "
                >

                    <!-- Search -->
                    <div class="ml-4 flex shrink-0 items-center">
                        <Search
                            class="h-4 w-4 text-muted-foreground"
                        />
                    </div>


                    <!-- Input -->
                    <input
                        ref="inputRef"
                        :value="query"
                        :placeholder="placeholder"
                        type="text"
                        class="
                            h-12
                            min-w-0
                            flex-1
                            bg-transparent
                            text-sm
                            text-foreground
                            outline-none
                            border-0
                            focus:ring-0
                            placeholder:text-muted-foreground
                        "
                        @input="handleInput"
                    />


                    <!-- Close -->
                    <Transition
                        appear
                        enter-active-class="close-enter-active"
                        enter-from-class="close-enter-from"
                        enter-to-class="close-enter-to"
                    >
                        <button
                            type="button"
                            class="
                                mr-2
                                flex h-8 w-8
                                shrink-0
                                items-center justify-center
                                rounded-full
                                transition-colors
                                hover:bg-muted
                            "
                            @click="collapse"
                        >
                            <X class="h-4 w-4" />
                        </button>
                    </Transition>

                </div>

            </form>
        </Transition>

    </div>
</template>


<style scoped>
/*
|--------------------------------------------------------------------------
| Search Icon
|--------------------------------------------------------------------------
*/

.search-icon-enter-active {
    transition:
        transform 220ms cubic-bezier(0.34, 1.56, 0.64, 1),
        opacity 160ms ease;
}

.search-icon-enter-from {
    transform: scale(0);
    opacity: 0;
}

.search-icon-enter-to {
    transform: scale(1);
    opacity: 1;
}

.search-icon-leave-active {
    transition:
        transform 150ms ease-in,
        opacity 120ms ease-in;
}

.search-icon-leave-from {
    transform: scale(1);
    opacity: 1;
}

.search-icon-leave-to {
    transform: scale(0);
    opacity: 0;
}


/*
|--------------------------------------------------------------------------
| Search Form
|--------------------------------------------------------------------------
*/

.search-form-enter-active {
    transition:
        width 420ms cubic-bezier(0.34, 1.56, 0.64, 1),
        opacity 180ms ease-out;
}

.search-form-enter-from {
    width: 48px;
    opacity: 0;
}

.search-form-enter-to {
    width: 320px;
    opacity: 1;
}

.search-form-leave-active {
    transition:
        width 280ms cubic-bezier(0.4, 0, 0.2, 1),
        opacity 180ms ease-in;
}

.search-form-leave-from {
    width: 320px;
    opacity: 1;
}

.search-form-leave-to {
    width: 48px;
    opacity: 0;
}


/*
|--------------------------------------------------------------------------
| Close Button
|--------------------------------------------------------------------------
*/

.close-enter-active {
    transition:
        transform 180ms cubic-bezier(0.34, 1.56, 0.64, 1),
        opacity 150ms ease;
}

.close-enter-from {
    transform: scale(0);
    opacity: 0;
}

.close-enter-to {
    transform: scale(1);
    opacity: 1;
}
</style>