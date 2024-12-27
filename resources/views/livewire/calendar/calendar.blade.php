@php
    use Illuminate\Support\Js;
@endphp

<div x-data="{
    dateStart: null,
    dateEnd: null,
    getRequestAvailabilityButton: () => document.getElementsByClassName('fc-requestAvailability-button')[0],
    isEventOverlapping: function (calendar) {
        return calendar.getEvents().some(event => {
            const eventStart = event.start.toISOString().split('T')[0];
            const eventEnd = event.end ? event.end.toISOString().split('T')[0] : eventStart;

            return (this.dateStart >= eventStart && this.dateStart < eventEnd)
                || (this.dateEnd > eventStart && this.dateEnd < eventEnd);
        });
    }
}">
    <div x-init="new Calendar($refs.calendar, {
    plugins: [interactionPlugin, dayGridPlugin],
    initialView: 'dayGridMonth',
    timeZone: 'UTC',
    validRange: {
        start: new Date().toISOString().split('T')[0]
    },
    events: {{ Js::from($events) }},
    editable: false,
    selectable: true,
    viewDidMount: function () {
        getRequestAvailabilityButton().disabled = true;
    },
    select: function (info) {
        dateEnd = info.endStr;
        dateStart = info.startStr;

        getRequestAvailabilityButton().disabled = isEventOverlapping(this);
    },
    headerToolbar: {
        left: 'title',
        right: 'requestAvailability, prev, next, today'
    },
    eventContent: function (info) {
        let eventContainer = document.createElement('div');
        let title = document.createElement('span');
        title.innerText = info.event.title;
        eventContainer.appendChild(title);

        if (info.event.extendedProps.user_id && info.event.extendedProps.user_id === {{ Js::from($userId) }}) {
            let cancelButton = document.createElement('span');
            cancelButton.innerHTML = '&times;';
            cancelButton.classList.add(
                'cursor-pointer',
                'text-red-500',
                'hover:text-red-700',
                'float-end',
                'mr-1',
                'font-bold',
            );
            eventContainer.appendChild(cancelButton);

            cancelButton.addEventListener('click', function(e) {
                e.stopPropagation();
                if (confirm('Are you sure you want to cancel this request?')) {
                    var event = info.event;
                    $wire.cancelEvent(event.id);
                }
            });
        }

        return { domNodes: [eventContainer] };
    },
    customButtons: {
        requestAvailability: {
            text: 'Request Availability',
            click: function() {
                if (dateStart) {
                    Alpine.store('requestAvailabilityDateStart', dateStart );
                    Alpine.store('requestAvailabilityDateEnd', dateEnd );
                    $dispatch('open-modal', { 'name': 'requestAvailability' });
                }
            },
        }
    },
}).render()">
        <div x-ref="calendar"></div>
    </div>

    <x-modal name="requestAvailability">
        <x-slot:title>
            Request Availability for:

            <span class="font-bold" x-text="$store.requestAvailabilityDateStart"></span>
            <template x-if="$store.requestAvailabilityDateEnd">
                <span class="font-bold" x-text="' - ' + $store.requestAvailabilityDateEnd"></span>
            </template>
        </x-slot:title>

        <livewire:request-availability.request-availability-form/>
    </x-modal>
</div>
