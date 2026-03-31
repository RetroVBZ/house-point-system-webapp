// ANNOYING CODE EW

document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('houseContainer'); // 2x2 grid container
    const POLL_INTERVAL = 5000; // 5 seconds

    // Helper: fetch points from server
    async function fetchHousePoints() {
        try {
            const res = await fetch('/home/points');
            if (!res.ok) throw new Error('Network response was not ok');
            return await res.json();
        } catch (err) {
            console.error('Error fetching house points:', err);
            return null;
        }
    }

    // FLIP animation: First-Last-Invert-Play
    function flipReorder(cards) {
        if (!cards || cards.length === 0) return;

        // 1️⃣ Record current positions
        const firstRects = cards.map(card => card.getBoundingClientRect());

        // 2️⃣ Append cards in new order (DOM reflow)
        cards.forEach(card => container.appendChild(card));

        // 3️⃣ Record new positions
        const lastRects = cards.map(card => card.getBoundingClientRect());

        // 4️⃣ Apply invert transform
        cards.forEach((card, i) => {
            const dx = firstRects[i].left - lastRects[i].left;
            const dy = firstRects[i].top - lastRects[i].top;

            card.style.transition = 'none'; // disable transition temporarily
            card.style.transform = `translate(${dx}px, ${dy}px)`;
        });

        // Force browser reflow
        void container.offsetWidth;

        // 5️⃣ Play animation to new position
        requestAnimationFrame(() => {
            cards.forEach(card => {
                card.style.transition = 'transform 0.5s ease';
                card.style.transform = ''; // smooth animation to new position
            });
        });
    }

    // Update points and reorder cards
    async function updateAndReorder() {
        const data = await fetchHousePoints();
        if (!data) return;

        const cards = Array.from(container.querySelectorAll('.house'));

        // Update points inside each card & store in dataset
        cards.forEach(card => {
            const houseKey = card.id; // IDs: meghna, teesta, jamuna, padma
            if (data[houseKey]) {
                const pointsEl = card.querySelector('h2');
                if (pointsEl) pointsEl.innerText = `Points: ${data[houseKey].points}`;
                card.dataset.points = data[houseKey].points;
            }
        });

        // Sort cards by points descending
        const prevOrder = cards.map(c => c.id).join(',');
        cards.sort((a, b) => b.dataset.points - a.dataset.points);
        const newOrder = cards.map(c => c.id).join(',');

        // Animate only if order changed
        if (prevOrder !== newOrder) {
            flipReorder(cards);
        }

        // Update rank numbers
        cards.forEach((card, i) => {
            const h1Rank = card.querySelector('h1:first-of-type');
            if (h1Rank) h1Rank.innerText = `${i + 1}${i === 0 ? 'st' : i === 1 ? 'nd' : i === 2 ? 'rd' : 'th'}`;
        });
    }

    // Initial update
    updateAndReorder();

    // Poll every 5 seconds
    setInterval(updateAndReorder, POLL_INTERVAL);
});