document.addEventListener('DOMContentLoaded', function () {

    function calculateRanks(items) {
        let lastPoints = null;
        let lastRank = 0;
    
        return items.map((item, index) => {
            const points = parseInt(item.points);
        
            if (points === lastPoints) {
                return { ...item, rank: lastRank, tied: true };
            }
        
            const rank = index + 1;
            lastPoints = points;
            lastRank = rank;
        
            return { ...item, rank, tied: false };
        });
    }
    
    const container = document.getElementById('houseContainer'); // your 2x2 grid container
    const POLL_INTERVAL = 5000;

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

    // FLIP animation on <a> elements
    function flipReorder(links) {
        const firstRects = links.map(link => link.getBoundingClientRect());

        // Append links in new order
        links.forEach(link => container.appendChild(link));

        const lastRects = links.map(link => link.getBoundingClientRect());

        // Apply invert transform
        links.forEach((link, i) => {
            const dx = firstRects[i].left - lastRects[i].left;
            const dy = firstRects[i].top - lastRects[i].top;

            link.style.transition = 'none';
            link.style.transform = `translate(${dx}px, ${dy}px)`;
        });

        // Force reflow
        void container.offsetWidth;

        // Animate to new positions
        requestAnimationFrame(() => {
            links.forEach(link => {
                link.style.transition = 'transform 0.5s ease';
                link.style.transform = '';
            });
        });
    }

    async function updateAndReorder() {
        const data = await fetchHousePoints();
        if (!data) return;

        // Select <a> wrappers
        const links = Array.from(container.querySelectorAll('a'));
        const cards = links.map(link => link.querySelector('.house'));

        // Update points inside each card
        cards.forEach(card => {
            const houseKey = card.id;
            if (data[houseKey]) {
                const pointsEl = card.querySelector('h2');
                pointsEl.innerText = `Points: ${data[houseKey].points}`;
                card.dataset.points = data[houseKey].points;
            }
        });

        // Sort links by card points descending
        const prevOrder = links.map(l => l.querySelector('.house').id).join(',');
        links.sort((a, b) => b.querySelector('.house').dataset.points - a.querySelector('.house').dataset.points);
        const newOrder = links.map(l => l.querySelector('.house').id).join(',');

        if (prevOrder !== newOrder) {
            flipReorder(links);
        }

        // Build structured data
        const structured = links.map(link => {
            const card = link.querySelector('.house');
            return {
                link,
                card,
                id: card.id,
                points: parseInt(card.dataset.points)
            };
        });

        // Already sorted earlier, so just rank them
        const ranked = calculateRanks(structured);

        ranked.forEach(({ card, rank, tied }) => {
            const rankEl = card.querySelector('h1:first-of-type');
        
            const suffix =
                rank === 1 ? 'st' :
                rank === 2 ? 'nd' :
                rank === 3 ? 'rd' : 'th';
        
            rankEl.innerText = `${tied ? '=' : ''}${rank}${suffix}`;
        });
    }

    updateAndReorder();
    setInterval(updateAndReorder, POLL_INTERVAL);
});