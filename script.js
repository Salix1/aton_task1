const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

// сравнение сортируемых значений
const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' 
    ? Number(v1.split(' ',1)) - Number(v2.split(' ',1))
    : console.error('bad data')
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));


let sortBtns = document.querySelectorAll(".sort-btn"),
    table = document.querySelector("table"),
    notFound = document.querySelector('.notFound');

// проверка на то, пуста ли таблица
function checkEmptiness() {
    if ((table.querySelectorAll(".display-none").length == (table.querySelectorAll("tr").length)) || (table.querySelectorAll("tr").length == 0)) {
        notFound.classList.remove('nf-display-none');
        table.classList.add('nf-display-none');
    } else {
        notFound.classList.add('nf-display-none');
        table.classList.remove('nf-display-none');
    }
}

sortBtns.forEach((el) => {
    el.addEventListener('click', ((e) => {
        let previousBtn = document.querySelector(".sort-btn-clicked"),
            // определение направления сортировки
            asc = e.target.dataset.ascending ? true : false;
        // приведение уже нажатой кнопки к обычному стилю
        if (previousBtn) {
            previousBtn.classList.remove("sort-btn-clicked");
            previousBtn.querySelector('.item-order-icon').src = "img/sort-outline.svg";
            previousBtn.querySelector('.sort-icon').classList.remove('sort-icon-active');
            previousBtn.dataset.ascending = '';
            previousBtn.querySelector('.item-order-icon').classList.remove('item-order-icon-asc');
        }
        e.target.classList.add("sort-btn-clicked");
        e.target.querySelector('.item-order-icon').src = "img/sort-filled.svg";
        e.target.querySelector('.sort-icon').classList.add('sort-icon-active');
        asc ? e.target.querySelector('.item-order-icon').classList.add('item-order-icon-asc') : e.target.querySelector('.item-order-icon').classList.remove('item-order-icon-asc')
        const table = document.querySelector('table'),
              col = e.target.dataset.column;
        // вызов сортировки
        Array.from(table.querySelectorAll('tr')).sort(comparer(col, asc)).forEach(tr => table.appendChild(tr));
        scroll({
            top: 150,
            left: 0,
            behavior: "smooth",
        });
        asc ? e.target.dataset.ascending = '' : e.target.dataset.ascending = 'true';
    }))
})

let navbar = document.querySelector("nav"),
    navPlaceholder = document.querySelector(".nav-placeholder");

// фиксация хедера с сортировкой на верху экрана
document.addEventListener("scroll", (event) => {
    if (window.scrollY >= 150) {
        navbar.classList.add("nav-fixed");
        navPlaceholder.classList.add("display-block");
    } else {
        navbar.classList.remove("nav-fixed");
        navPlaceholder.classList.remove("display-block");
    }
})

// функция фильтрации данных в таблице
function filter() {
  let input, filter, i, txtValue;
  input = document.querySelector('.filter-input');
  filter = input.value.toUpperCase();
  products = document.querySelectorAll('.product-name');

  for (i = 0; i < products.length; i++) {
    txtValue = products[i].textContent || products[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      products[i].parentElement.classList.remove('display-none');
    } else {
      products[i].parentElement.classList.add('display-none');
    }
  }
    scroll({
        top: 150,
        left: 0,
        behavior: "smooth",
    });
  checkEmptiness();
}

document.querySelector('.filter-input').addEventListener('keyup', filter);