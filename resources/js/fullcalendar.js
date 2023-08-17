import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        events: [
            { title: 'Acara 1', date: '2023-08-16' },
            { title: 'Acara 2', date: '2023-08-17' },
            // Tambahkan acara lainnya sesuai kebutuhan
        ]
    });
    calendar.render();
});