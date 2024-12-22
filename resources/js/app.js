import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction';

Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;
window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.interactionPlugin = interactionPlugin;
Livewire.start();
