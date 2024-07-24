import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
document.addEventListener('DOMContentLoaded', async function() {
    const tokenAuth = localStorage.getItem('authToken');
    

    const calendarEl = document.querySelector('#calendar');

    if (calendarEl == null) return;

    try {
        // Ajouter des en-têtes à l'appel d'API
        const { data } = await axios.get('/api/lessons', {
            headers: {
                'Authorization': `Bearer ${tokenAuth}`
            }
        });

        // Transformer les données API en format d'événements FullCalendar
        const events = data.map(lesson => ({
            id: lesson.id,
            title: lesson.title,
            color: 'green', // Vous pouvez ajuster la couleur ou la logique en fonction de vos besoins
            start: `${lesson.date}T${lesson.start_time}`, // Format: YYYY-MM-DDTHH:MM:SS
            end: `${lesson.date}T${lesson.end_time}` // Format: YYYY-MM-DDTHH:MM:SS
        }));

        const calendar = new Calendar(calendarEl, {
            plugins: [ timeGridPlugin, interactionPlugin ], // Assurez-vous que les plugins sont importés
            initialView: 'timeGridWeek',
            slotMinTime: "08:00:00",
            slotMaxTime: "20:00:00",
            eventClick: async function(info) {
                try {
                    const { data } = await axios.put('/api/subscribe', {
                        id: info.event.id,
                    }, {
                        headers: {
                            'Authorization': `Bearer ${tokenAuth}`
                        }
                    });

                    info.el.style.borderColor = data.attached === true ? 'green' : 'yellow';
                } catch (error) {
                    console.error('Erreur lors de l\'abonnement à la leçon:', error);
                }
            },
            events: events,
        });
        console.log('events', events);

        calendar.setOption('locale', 'fr');
        calendar.render();
    } catch (error) {
        console.error('Erreur lors de la récupération des leçons:', error);
    }
});


