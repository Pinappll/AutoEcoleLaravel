import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', async function() {
    const calendarEl = document.querySelector('#calendar');

    if (calendarEl == null) return;

    try {
        // Récupérer le token du local storage (ou d'un autre endroit où vous l'avez stocké)
        const token = localStorage.getItem('token');

        // Ajouter des en-têtes à l'appel d'API
        const { data } = await axios.get('/api/lessons', {
            headers: {
                'Authorization': `Bearer d3180c045effcfdb16b537249042ccf7cec9d088d2b297c1455132f5fa82996d`
            }
        });

        // Transformer les données API en format d'événements FullCalendar
        const events = data.data.map(lesson => ({
            id: lesson.id,
            title: lesson.title,
            color: 'green', // Vous pouvez ajuster la couleur ou la logique en fonction de vos besoins
            start: `${lesson.date}T${lesson.start_time}`, // Format: YYYY-MM-DDTHH:MM:SS
            end: `${lesson.date}T${lesson.end_time}` // Format: YYYY-MM-DDTHH:MM:SS
        }));

        const calendar = new Calendar(calendarEl, {
            plugins: [timeGridPlugin],
            initialView: 'timeGridWeek',
            slotMinTime: "08:00:00",
            slotMaxTime: "20:00:00",
            eventClick: async function(info) {
                const { data } = await axios.put('/api/subscribe', {
                    id: info.event.id,
                }, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                info.el.style.borderColor = data.attached === true ? 'green' : 'yellow';
            },
            events: events,
        });

        calendar.setOption('locale', 'fr');
        calendar.render();
    } catch (error) {
        console.error('Erreur lors de la récupération des leçons:', error);
    }
});
