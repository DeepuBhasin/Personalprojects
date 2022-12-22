<template>
<div :class="{'collapsed-bar':collapsed, 'open-bar': !collapsed}">
    <!-- {{sidebarwidth}} -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" :style="{width: sidebarwidth}">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar text-left">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!-- <div class="image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div> -->

                <a @click="toggleSidebar" class="text-center" style="display: block;width: 100%;font-size: 16px;color: #fff;"><strong>D'cluttr</strong></a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <Collapsemenu :list="{
                         title : 'General Management', to : '' , parentIcon : true, arrowIcon : true, parentClass : 'fa-solid fa-gears nav-icon', permission : true,
                        children : [
                            {title : 'General Settings' , to : '/generalsetting', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.general_settings},
                            {title : 'Forms Management' , to : '/formbuilder', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.forms_management},
                            {title : 'Category Management' , to : '/categorymanagement', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.category_management},
                            {title : 'Plans Management' , to : '/plans', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.plans_management},
                            {title : 'Section Management' , to : '/viewsection', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : false},
                            {title : 'Permission Group' , to : '/viewroles', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.permission_group},
                            
                        ],
                    }" />
                    <Collapsemenu :list="{
                         title : 'Manage Users', to : '' , parentIcon : true, arrowIcon : true, parentClass : 'fa-solid fa-users-gear nav-icon', permission : pagePermission.user_management || pagePermission.staff_users,
                        children : [
                            {title : 'Market Place Users' , to : '/marketplaceusers', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.user_management},
                            {title : 'Staff Users' , to : '/staffusers', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.staff_users  },
                        ],
                    }" />
                     <Collapsemenu :list="{
                         title : 'Logistics Management', to : '' , parentIcon : true, arrowIcon : true, parentClass : 'nav-icon fa-solid fa-truck-fast', permission : true,
                        children : [
                            {title : 'Inspection Agents' , to : '/inspectionagents', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : true},
                            {title : 'Logistics Staff' , to : '/logisticsstaff', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : true},
                        ],
                    }" />
                    <Collapsemenu :list="{
                         title : 'Product Market Place', to : '/productmarketplace' , parentIcon : true, arrowIcon : false, parentClass : 'nav-icon fa-brands fa-product-hunt', permission : true,
                    }" />
                    <Collapsemenu :list="{
                         title : 'Services', to : '/services' , parentIcon : true, arrowIcon : false, parentClass : 'nav-icon fa-solid fa-screwdriver-wrench', permission : pagePermission.services,
                    }" />
                    <Collapsemenu :list="{
                         title : 'Support Section', to : '' , parentIcon : true, arrowIcon : true, parentClass : 'nav-icon fa fa-headset', permission : pagePermission.ticket_category ||  pagePermission.customer_support,
                        children : [
                            {title : 'Ticket Category' , to : '/viewticketcategory', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.ticket_category},
                            {title : 'Customer Support' , to : '/customersupport', childIcon : false, childClass : 'far fa-circle nav-icon' ,permission : pagePermission.customer_support},
                        ],
                    }" />
                     <Collapsemenu :list="{
                         title : 'Promotion Campaigns', to : '/promotioncampaigns' , parentIcon : true, arrowIcon : false, parentClass : 'nav-icon fa-solid fa-screwdriver-wrench', permission : pagePermission.promotion_campaigns,
                    }" />
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
</template>
<script>
import { mapState } from "vuex";
import {collapsed,sidebarWidth,toggleSidebar,} from '@/components/Sidebar/state'
import Collapsemenu from './Collapsemenu.vue'
export default {
    name: 'Sidbar',
    components: {
        Collapsemenu
    },
    data() {
        return {
            name: sidebarWidth,
            collapsed: collapsed,
            sidebarwidth: sidebarWidth,
            toggleSidebar,
        }
    },
    computed:{
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      staff_users :  state.permission?.staff_users?.includes('page')  ? true : false,
                      general_settings :  state.permission?.general_settings?.includes('page')  ? true : false,
                      forms_management :  state.permission?.forms_management?.includes('page')  ? true : false,
                      plans_management :  state.permission?.plans_management?.includes('page')  ? true : false,
                      permission_group :  state.permission?.permission_group?.includes('page')  ? true : false,
                      user_management :  state.permission?.user_management?.includes('page')  ? true : false,
                      category_management :  state.permission?.category_management?.includes('page')  ? true : false,
                      ticket_category :  state.permission?.ticket_category?.includes('page')  ? true : false,
                      services :  state.permission?.services?.includes('page')  ? true : false,
                      customer_support :  state.permission?.customer_support?.includes('page')  ? true : false,
                      promotion_campaigns :  state.permission?.promotion_campaigns?.includes('page')  ? true : false,
                  };
              }
        })
    }
}
</script>
