import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_KEY,
    cluster: import.meta.env.VITE_PUSHER_CLUSTER,
    forceTLS: true
});

window.Echo.channel('leaderboard')
    .listen('HousePointsUpdated', (e) => {
        const houseEl = document.getElementById(e.house.name); // make sure your div IDs match house names
        if(houseEl){
            houseEl.querySelector('h2').innerText = `Points: ${e.house.points} Tr. ${houseEl.dataset.teacher}`;
        }
    });