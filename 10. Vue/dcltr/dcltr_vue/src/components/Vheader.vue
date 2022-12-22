<template>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" @click="" role="button"><i class="fas fa-bars"></i></a>
        </li> -->
        <li class="nav-item d-none d-sm-inline-block">

        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <!-- <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a> -->
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="assets/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="assets/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="assets/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <router-link to="" class="nav-link" data-toggle="dropdown" href="#" @click="toggleCollapseNotification" title="Settings">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ notificationCount }}</span>
            </router-link>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" :class="{showNotification:showNotificationValue}">
                <span class="dropdown-item dropdown-header">5 Notifications  </span>
                <button class="btn btn-success btn-xs btn-block" @click="markAllAsComplete">Mark all as complete </button>
                <template v-for="(item,key) in notificationArray" :key="item.id">
                   <template v-if="key < 5">
                        <div class="dropdown-divider"></div>
                        <router-link :to="`/product/${item.data.product_id}/${item.id}`" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> {{item.data.message}} <br/>
                            <small>{{convertDate(item.created_at)}}</small>
                            <br/>
                        </router-link>
                   </template>
                </template>
                <div class="dropdown-divider"></div>
                <router-link to="/seeAllNotification" class="dropdown-item dropdown-footer">See All Notifications</router-link>
            </div>
        </li>
        <li class="nav-item dropdown">
            <router-link to="" class="nav-link" data-toggle="dropdown" href="#" @click="toggleCollapse" title="Settings">
                <i class="fas fa-user"></i>
            </router-link>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" :class="{show:showValue}">
                <span class="dropdown-item dropdown-header text-left"><strong>Hello {{firstname}}</strong></span>
                <div class="dropdown-divider"></div>
                <router-link to="/myprofile" href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> My Profile
                </router-link>
                <router-link to="/bankdetails" href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> Bank Details
                </router-link>
                <div class="dropdown-divider"></div>
                <router-link to="/changepassword" href="#" class="dropdown-item">
                    <i class="fas fa-key"></i> Change Password
                </router-link>
                <div class="dropdown-divider"></div>
                <router-link to="" class="dropdown-item" @click="logout">
                    <i class="fas fa-arrow-right-from-bracket"></i> Logout
                </router-link>
            </div>
        </li>
    </ul>
</nav>
</template>

<script>
import {getRequest, putRequest} from '@/store/api.js'
import {getDateTime} from '@/Utils/index.js';
import {mapActions,mapState} from 'vuex'
export default {
    name: 'Vheader.vue',
    data() {
        return {
            notificationCount : 0,
            showValue: false,
            showNotificationValue : false,
            notificationArray : []
        }
    },
    methods: {
        async markAllAsComplete(){
            await putRequest('admin/markNotificationsAsRead');
            await this.getNotifcationCount();
        },
        async getNotifcationCount(){
           let response =  await getRequest('admin/unreadNotificationsCount');
           this.notificationCount = response.unreadNotificationsCount;
        },
        convertDate(dt){
            return getDateTime(dt);
        },
        ...mapActions('users', ['logoutUser']),
        toggleCollapse() {
            this.showValue = !this.showValue
        },
        toggleCollapseNotification (){
            this.showNotificationValue = !this.showNotificationValue
        },
        logout() {
            
            this.logoutUser().then(() => {
                    this.$router.push({name : 'Login'});
                }).catch((err) => {
                    this.show(err.message, 3000)
                })
        }
    },
      computed: {
          ...mapState('users', {
              firstname : (state) => state.userName,
          }),
    },
    async mounted(){
        this.notificationArray= await getRequest('admin/notification');
        this.getNotifcationCount();
    }
}
</script>

<style>
.showNotification {
    display: block !important;
}

.show {
    display: block !important;
}
</style>
