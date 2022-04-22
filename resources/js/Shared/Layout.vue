<template>
    <section class="p-6 bg-gray-100">
        <header class="flex justify-between">
            <h1 class="font-bold text-lg">
                My App
            </h1>

            <Nav />
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-4xl mx-auto">
            <slot />
        </div>
    </section>
</template>

<script>
import Nav from "./Nav";

export default {
    components: { Nav },
    name: "Layout",
}
</script>

<style scoped>

</style>
