<template>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <slot name="title"></slot>
                </div>
                <div class="card-body  p-0">
                    <div class="row">
                        <slot name="body"></slot>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
