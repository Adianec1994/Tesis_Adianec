<template>
  <v-card>
    <v-card-title class="grey lighten-1">
      <h3 class="display-1 mb-0">{{ $t('Bienvenido') }}</h3>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <template>
        <v-carousel cycle height="390" hide-delimiter-background show-arrows-on-hover>
          <v-carousel-item v-for="(item,i) in items" :key="i" :src="item.src"
              reverse-transition="fade-transition" transition="fade-transition">
          </v-carousel-item>
        </v-carousel>
      </template>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'home-view',
  metaInfo () {
    return { title: this.$t('home') }
  },
  data (){
    return{
      items: [
        {
          src:'/img/geysel1.jpg',
        },
        {
          src:'/img/geysel2.jpg',
        },
        {
          src:'/img/geysel3.jpg',
        },
        {
          src:'/img/geysel4.jpg',
        },
        {
          src:'/img/geysel5.jpg',
        },
        {
          src:'/img/geysel6.jpg',
        },
        {
          src:'/img/geysel7.jpg',
        },
      ],
    }
  },
}
</script>
