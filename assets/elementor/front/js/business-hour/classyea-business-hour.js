/****** Design Six *****/
document.addEventListener('DOMContentLoaded', () => {
    //grave day
    let classyea_day = document.querySelectorAll('.classyea-businessHour-box-455 .classyea-businessHour-item .classyea-businessHour-day');
    const _day = new Date();
    const current_day = _day.getDay();
    classyea_day.forEach(day => {
        let item_day = day.dataset.day;
        if (item_day == current_day) {
            day.parentElement.classList.add('classyea-current-day');
        }
    })
})