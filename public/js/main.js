window.addEventListener('DOMContentLoaded', () => {
  console.log('Initialising page');
  const auto = new autoComplete({
    selector: '.window input',
    source: (term, callback) => {
      getSuggestions(term).then(a => callback(a));
    },
    offsetTop: 0,
    minChars: 2,
    delay: 20,
    renderItem: (item, search) => {
      search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
      let re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");

      return `<div class="autocomplete-suggestion" data-aid="${item[1]}" data-val="${search}">${item[0].replace(re, "<b>$1</b>")}</div>`;
    },
    onSelect: (e, term, item) => {
      const animeId = item.dataset.aid;
      location.href = '/torrents/' + animeId + '/' + encodeURI(item.textContent.trim());
    }
  })
});

async function getSuggestions(term) {
  const resp = await fetch('/api/title?limit=20&q=' + encodeURIComponent(term));

  const obj = await resp.json();

  return obj.result.map(a => [a.title, a.id]);
}