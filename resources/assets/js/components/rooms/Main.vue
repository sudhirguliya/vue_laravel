<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Rooms</div>

                    <div class="card-body">
                        <transition name="moveInUp">
                            <router-view></router-view>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style type="text/css">
    .moveInUp-enter-active{
      animation: fadeIn 1s ease-in;
    }
    @keyframes fadeIn{
      0%{
        opacity: 0;
      }
      50%{
        opacity: 0.5;
      }
      100%{
        opacity: 1;
      }
    }

    .moveInUp-leave-active{
      animation: moveInUp .3s ease-in;
    }
    @keyframes moveInUp{
     0%{
      transform: translateY(0);
     }
      100%{
      transform: translateY(-400px);
     }
    }
</style>
<script>
    export default {
        name: 'rooms-main'
    }
</script>