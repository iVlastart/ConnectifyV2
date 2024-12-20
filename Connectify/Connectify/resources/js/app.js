import './bootstrap';

// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
//import 'swiper/css/navigation';
import 'swiper/css/pagination';

// init Swiper:
/*const swiper = new Swiper('.swiper', {
  // configure Swiper to use modules
  modules: [Navigation, Pagination],
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});*/
window.Swiper=Swiper;
window.Navigation=Navigation;
window.Pagination=Pagination;

import { livewire_hot_reload } from 'virtual:livewire-hot-reload'
import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'
livewire_hot_reload();

window.Alpine = Alpine;
 
Alpine.plugin(intersect)
Alpine.start();