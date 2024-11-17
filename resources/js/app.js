import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
Livewire.start();
