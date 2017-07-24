<div id="date">
    <select onchange="changeDays()" name="years" id="years" size="1">
        <option value="" disabled selected>Year</option>
    </select>
    <select onchange="changeDays()" name="months" id="months" size="1">
        <option value="" disabled selected>Month</option>
    </select>
    <select id="days" name="days" size="1">
        <option value="" disabled selected>Day</option>
    </select>
</div>
<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position-x: 100%;
        background-position-y: 5px;
        border:2px white solid;
        font-size: 20px;
        color:#34495e;
        background-color: aliceblue;
        font-family: "DejaVu Sans";
        padding-right: 2rem;
    }

    #years {
        width:160px;
    }

    #months {
        width:160px;
    }

    #days {
        width:82px;
    }
</style>
<script>
    var years = document.getElementById('years')
    var months = document.getElementById('months');
    var days = document.getElementById('days');
    var monthsArray = [ 'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'];
    var monthDays = [31,28,31,30,31,30,31,31,30,31,30,31];

    for (i=1900;i<=2017;i++){
        var option = document.createElement('option');
        option.text = i;
        years.add(option);
    }

    monthsArray.forEach(function (element) {
        var option = document.createElement('option');
        option.text = element;
        months.add(option);
    });

    for (i=1;i<=31;i++){
        var option = document.createElement('option');
        option.text = i;
        days.add(option);
    }

    function changeDays() {
        var day = monthDays[monthsArray.indexOf(months.value)];
        if ((parseInt(years.value) % 4 === 0 && 0 !== parseInt(years.value) % 100)||(0 === parseInt(years.value) % 400)) {
            if (months.value === 1) {
                day = 29;
            }
        }
        for (i=1;i<=day;i++) {
            var option = document.createElement('option');
            option.text = i;
            days.add(option);
        }

    }
</script>