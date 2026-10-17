<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Advanced Events Calendar</title>
<link rel="icon" type="image/png" href="{{ asset('images/School logo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<style>
body {
    background: #eef4ff;
    font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
    margin: 0;
    padding: 20px 15px;
    min-height: 100vh;
    color: #253858;
}

/* Medium Header */
.header-box {
    text-align: center;
    margin: 0 auto 18px;
    max-width: 1000px;
    background: #1746a2;
    color: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 5px 16px rgba(23, 70, 162, 0.12);
}

.header-box img {
    width: 58px;
    height: 58px;
    object-fit: contain;
    border-radius: 7px;
    background: white;
    padding: 4px;
    margin-bottom: 7px;
}

.header-box h3 {
    font-size: 19px;
    font-weight: 700;
    margin: 3px 0 5px;
}

.header-box h5 {
    font-size: 13px;
    font-weight: 500;
    margin: 0;
    color: #dbeafe;
}

/* Medium Calendar */
#calendar {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    padding: 16px;
    border: 1px solid #dce6f7;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(23, 70, 162, 0.08);
}

.fc .fc-toolbar-title {
    font-size: 19px;
    color: #1746a2;
    font-weight: 700;
}

.fc .fc-button {
    background: #1746a2 !important;
    border-color: #1746a2 !important;
    font-size: 12px !important;
    padding: 6px 10px !important;
}

.fc .fc-col-header-cell {
    background: #1746a2;
    padding: 7px 0;
}

.fc .fc-col-header-cell-cushion {
    color: white;
    font-size: 12px;
    text-decoration: none;
}

.fc .fc-daygrid-day-number {
    color: #334155;
    font-size: 12px;
    padding: 5px;
    text-decoration: none;
}

.fc .fc-day-today {
    background: #e8f0ff !important;
}

.fc .fc-event {
    border: none;
    border-radius: 4px;
    padding: 2px 4px;
    font-size: 11px;
}

@media (max-width: 768px) {
    body {
        padding: 12px 8px;
    }

    .header-box {
        padding: 12px;
    }

    #calendar {
        padding: 8px;
    }

    .fc .fc-toolbar {
        flex-wrap: wrap;
        gap: 8px;
    }

    .fc .fc-toolbar-title {
        font-size: 16px;
    }
}


</style>
</head>

<body>

<div class="header-box">
    <img src="{{ asset('images/School logo.png') }}">
    <h3>Sunrise Public School</h3>
    <h5>📅 Events & Holidays Calendar (2026–2027)</h5>
</div>

<div id="calendar"></div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    function formatDateLocal(date) {
        let y = date.getFullYear();
        let m = String(date.getMonth()+1).padStart(2,'0');
        let d = String(date.getDate()).padStart(2,'0');
        return `${y}-${m}-${d}`;
    }

    function getAllSundays(year) {
        let arr = [];
        let d = new Date(year,0,1);

        while(d.getFullYear() === year){
            if(d.getDay() === 0){
                arr.push({
                    title:'Sunday Holiday',
                    start:formatDateLocal(d),
                    color:'#ef4444',
                    description:'Weekly holiday'
                });
            }
            d.setDate(d.getDate()+1);
        }
        return arr;
    }

    function getSecondSaturdays(year){
        let arr = [];
        for(let m=0;m<12;m++){
            let count=0;
            for(let d=1; d<=31; d++){
                let date = new Date(year,m,d);
                if(date.getMonth()!==m) break;

                if(date.getDay()===6){
                    count++;
                    if(count===2){
                        arr.push({
                            title:'Half Day',
                            start:formatDateLocal(date),
                            color:'#facc15',
                            description:'School Half Day'
                        });
                        break;
                    }
                }
            }
        }
        return arr;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        events: [

            { title:'Annual Function', start:'2026-05-10', color:'#3b82f6', description:'School annual program' },
            { title:'Sports Day', start:'2026-05-15', color:'#22c55e', description:'Outdoor activities' },
            { title:'Exam Start', start:'2026-05-20', color:'#f97316', description:'Final exams begin' },

            { title:'Independence Day', start:'2026-08-15', color:'#ef4444', description:'National holiday' },
            { title:'Diwali', start:'2026-11-08', color:'#ef4444', description:'Festival of lights' },
            { title:'Christmas', start:'2026-12-25', color:'#ef4444', description:'Holiday' },
            { title:'Republic Day', start:'2027-01-26', color:'#ef4444', description:'National holiday' },

            ...getAllSundays(2026),
            ...getAllSundays(2027),
            ...getSecondSaturdays(2026),
            ...getSecondSaturdays(2027)

        ],

        eventDidMount: function(info) {
            if (info.event.extendedProps.description) {
                info.el.setAttribute("title", info.event.extendedProps.description);
            }
        }

    });

    calendar.render();
});
</script>

</body>
</html>