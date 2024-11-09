import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
Alpine.start();
Livewire.start()
