<template>
<div class="content-wrapper" style="min-height: 242px;">
  <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{header}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/dashboard">Home</router-link>
                        </li>
                        <slot name="breadCrumbsLinks">
                            
                        </slot>
                    </ol>
                </div>
            </div>
        </div>
    </div>
      <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header" v-if="titleBoolen">

                    <slot name="title"></slot>
                </div>
                <div class="card-body" :class="paddingClass">
                    <slot name="body"></slot>
                </div>
            </div>
        </div>
    </section>
</div>    
</template>

<script>
export default {
    name : 'SectionHeader',
    props:{
        header : String,
        paddingClass : String,
        titleBoolen :  Boolean,
    }
}
</script>
<style>
</style>