<template>
    <div v-if="warningZone" id="warning" class="alert alert-warning text-center">
        <strong>Are you still working ?</strong>
    </div>
   <slot v-if="loading">
         
    </slot>
</template>

<script>
export default {
    name: 'App',
    data(){
        return {
            loading : false,
            permissions : {},
            events : ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],
            warningTimer : null,
            logoutTimer : null,
            warningZone : false ,
        }
    },
    inject: ['show', 'hide'],
    methods: {
        setTimers : function(){
            this.warningTimer = setTimeout(this.warningMessage,(15*60)*1000);   
            this.logoutTimer = setTimeout(this.logoutUser,(30*60)*1000);
            this.warningZone = false;
        },
        warningMessage : function(){
            let token = localStorage.getItem('token');
            if(token != null)
            {
                this.warningZone = true;
            } 
        }, 
        logoutUser : function() {
            let token = localStorage.getItem('token');
            if(token != null && this.warningZone == true)
            {
                alert('You are logut automatically from application');
                localStorage.clear();
                this.$router.push('/login');
            }
            
        },
        resetTimer : function(){
            clearTimeout(this.warningTimer);
            clearTimeout(this.logoutTimer);
            this.setTimers();
        }
    },
    mounted() {
         this.events.forEach(function(event){
            window.addEventListener(event, this.resetTimer)
        }, this);
        
        this.setTimers();

        let token = localStorage.getItem('token');
        if (!token) {
            this.loading =  true;
            this.$router.push('/login');
        } else {
            this.$store.dispatch('users/getAdminDetails', token).then(result=>{
                if(result.auth){
                    this.loading = true; 
                    this.permissions = result.permissions;
                }
                
            }).catch((err) => {
                if (err.response.status !== 200){
                     localStorage.clear();
                }
                this.show(err.message, 'error', 3000)
                this.$router.push('/login');
            })
        }
    },
    destroyed() {
         this.events.forEach(function(event){
            window.removeEventListener(event, this.resetTimer)
        }, this);
        this.resetTimer();

    },
    created() {
        document.title = "D'cluttr";
    },
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    /*text-align: center;*/
    color: #2c3e50;
    margin-top: 60px;
}

.capital {
    text-transform: capitalize;
}

.text-center{
    text-align: center;
}
.promotionTable tr th{
    min-width: 100px;
}
.promotionTable tr th:first-child{
    min-width: 40px;
}
.promotionTable tr td:last-child{
    width: 230px;
}

</style>
