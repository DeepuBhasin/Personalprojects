<template>
<li class="nav-item" v-if="list.permission">
    <router-link :to="list.to" class="nav-link" @click="toggleCollapse">

        <i v-if="list.parentIcon" :class="list.parentClass"></i>
        <i v-else :class="list.childClass"></i>
        <p> {{list.title}} 
            <i v-if="list.arrowIcon" :class="`right fas fa-angle-${ showValue ? 'down': 'left'} `"></i></p>
    </router-link>
    <ul v-if="list.children?.length" class="nav nav-treeview" :class="{show:showValue}">
        <Collapsemenu v-for="child in list.children" :key="child.title" :list="child">
        </Collapsemenu>
    </ul>
</li>
</template>

<script>
export default {
    name: 'Collapasemenu',
    props: {
        list: Object
    },
    data() {
        return {
            showValue: false
        }
    },
    methods: {

        toggleCollapse() {

            this.showValue = !this.showValue
        }
    }
}
</script>

<style>
.show {
    display: block !important;
}
</style>
