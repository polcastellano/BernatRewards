<template>
    <div class="layout-wrapper" :class="containerClass">
        <app-topbar></app-topbar>

        <div class="layout-sidebar">
            <app-sidebar></app-sidebar>
        </div>
        <div class="layout-main-container p-0">
            <section>
                <h1>asdddddddddddddddddddddsass</h1>
                <h1>sssssssssssssssssssss</h1>
            </section>

            <Suspense>
                <router-view></router-view>
            </Suspense>
            <!-- que hace esto ^^^^^^^ -->

            <app-footer></app-footer>
        </div>

    </div>
</template>

<script setup>
import { computed, watch, ref } from 'vue';
import { useRoute } from "vue-router";

import AppTopbar from '@/layouts/AppTopbar.vue';
import AppFooter from '@/layouts/AppFooter.vue';
import AppSidebar from '@/layouts/AppSidebar.vue';
import { useLayout } from '@/composables/layout';

const route = useRoute();

const { onMenuToggle,layoutConfig, layoutState, isSidebarActive } = useLayout();

const outsideClickListener = ref(null);

watch(isSidebarActive, (newVal) => {
    if (newVal) {
        bindOutsideClickListener();
    } else {
        unbindOutsideClickListener();
    }
});

const containerClass = computed(() => {
    return {
        'layout-overlay': layoutConfig.menuMode.value === 'overlay',
        'layout-static': layoutConfig.menuMode.value === 'static',
        'layout-static-inactive': layoutState.staticMenuDesktopInactive.value && layoutConfig.menuMode.value === 'static',
        'layout-overlay-active': layoutState.overlayMenuActive.value,
        'layout-mobile-active': layoutState.staticMenuMobileActive.value,
    };
});
const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                layoutState.overlayMenuActive.value = false;
                layoutState.staticMenuMobileActive.value = false;
                layoutState.menuHoverActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    const sidebarEl = document.querySelector('.layout-sidebar');
    const topbarEl = document.querySelector('.layout-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};

</script>

<style lang="scss" scoped>

ol {
    margin: 0 !important; 
    padding: 0;
    list-style-type: none;
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}

.layout-sidebar{
    padding: 0;
}

</style>
