
<div x-data="{
    dateStart: null,
    dateEnd: null,
    getRequestAvailabilityButton: () => return document.getElementsByClassName('fc-requestAvailability-button')[0]
}" >
    <div x-init="new Calendar($refs.calendar, {
    plugins: [interactionPlugin, dayGridPlugin],
    initialView: 'dayGridMonth',
    editable: true,
    selectable: true,
    viewDidMount: function () {
        document.getElementsByClassName('fc-requestAvailability-button')[0].disabled = true;
    },
    dateClick: function (info) {
        dateStart = info.dateStr;
        document.getElementsByClassName('fc-requestAvailability-button')[0].disabled = false;
    },
    select: function (info) {
        dateStart = info.startStr;
        dateEnd = info.endStr;
        document.getElementsByClassName('fc-requestAvailability-button')[0].disabled = false;
    },
    headerToolbar: {
        left: 'title',
        right: 'requestAvailability, prev, next, today'
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
        <livewire:calendar.modal.request-availability />
    </x-modal>
</div>
