import { computed, ref, shallowRef } from "vue";

export const SIDEBAR_WIDTH = 180;
export const SIDEBAR_WIDTH_COLLAPSED = 30;

export const collapsed = shallowRef(false);
export const toggleSidebar =  () => {
    collapsed.value = !collapsed.value ;
}

export const sidebarWidth = computed(
    ()=>`${collapsed.value?SIDEBAR_WIDTH_COLLAPSED:SIDEBAR_WIDTH}`
) 
