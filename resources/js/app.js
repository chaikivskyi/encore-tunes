import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/swiper-bundle.css';

import Alpine from 'alpinejs';

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
Alpine.start();
