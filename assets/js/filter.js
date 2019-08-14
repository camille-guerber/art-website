let cards = $('.card');
let buttons = $('.filter-btn');

buttons.click(function (b) {
    var key = b.target.dataset.key;
    if(key === 'all') {
        cards.each(function (c) {
            cards[c].attributes.class.value = 'card animated fadeIn';
        });
    } else {
        cards.each(function (c) {
            let hashtags = cards[c].attributes.keys.value.split(' ').filter(Boolean);
            hashtags.forEach(function (h) {
                if(h === key) {
                    cards[c].attributes.class.value = 'card animated fadeIn';
                } else {
                    cards[c].attributes.class.value = 'd-none';
                }
            })
        });
    }
});