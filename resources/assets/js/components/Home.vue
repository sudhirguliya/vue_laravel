<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Webinar App</div>

                    <div class="card-body">
                        <h2>{{ welcome }}</h2>
                        <p>Simplicity of Use - Sign up is easy , using it is easier. No downloads Integrates with your own website.</p>
                        <p>As an avid teacher and consultant to students willing to pursue their studies overseas, I get queries from all over the country but geographical limitations did not enable me to offer my services to people outside my city. GoConsult solved that problem from me. Now I teach and advise students not just from India but all over the globe</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
        computed: {
            welcome() {
                return this.$store.getters.welcome
            }
        }
    }
</script>
