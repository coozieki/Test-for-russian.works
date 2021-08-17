<template>
    <div class="calendar">
        <div class="calendar-selected">
            {{ formattedCurrentDate }}
        </div>
        <div class="calendar-header">
            <div class="calendar-header__month">
                <div class="calendar-header__arrow-left" @click="leftArrowClick">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </div>
                <div class="calendar-header__month-title">
                    {{ monthsTitles[locale][monthId] }} {{ year }}
                </div>
                <div class="calendar-header__arrow-right" @click="rightArrowClick">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-body__column" v-bind:key="index" v-for="index in 7">
                <div class="calendar-body__week-day">
                    {{ weekDaysTitles[locale][index] }}
                </div>
                <div class="calendar-body__column-items">
                    <div v-bind:key="day" v-for="day in days[index]"
                         :class="{'calendar-body__column-item': true, 'column-item-hidden': day === '', 'active': isDayActive(day) }"
                         @click="showSelectedDate(day)">
                        {{ day }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        date: {
            type: String,
            default: new Date(Date.now()).toDateString()
        },
        locale: {
            type: String,
            default: 'en'
        }
    },
    data() {
        return {
            selectedDate: "",
            selectedDay: "",
            monthId: 7,
            year: 2021,
            days: {
            },
            weekDaysTitles: {
                en: {
                    1: 'Sun',
                    2: 'Mon',
                    3: 'Tue',
                    4: 'Wed',
                    5: 'Thu',
                    6: 'Fri',
                    7: 'Sat'
                },
                ru: {
                    1: 'Вос',
                    2: 'Пон',
                    3: 'Вто',
                    4: 'Сре',
                    5: 'Чет',
                    6: 'Пят',
                    7: 'Суб'
                }
            },
            monthsTitles: {
                en: {
                    0: 'January',
                    1: 'February',
                    2: 'March',
                    3: 'April',
                    4: 'May',
                    5: 'June',
                    6: 'July',
                    7: 'August',
                    8: 'September',
                    9: 'October',
                    10: 'November',
                    11: 'December'
                },
                ru: {
                    0: 'Январь',
                    1: 'Февраль',
                    2: 'Март',
                    3: 'Апрель',
                    4: 'Май',
                    5: 'Июнь',
                    6: 'Июль',
                    7: 'Август',
                    8: 'Сентябрь',
                    9: 'Октябрь',
                    10: 'Ноябрь',
                    11: 'Декабрь'
                }
            }
        }
    },
    created() {
        var date = new Date(Date.parse(this.date));
        this.monthId = date.getMonth();
        this.year = date.getFullYear();
        this.selectedDay = date.getDate();
        this.changeMonth();
        this.showSelectedDate(this.selectedDay);
    },
    computed: {
        formattedCurrentDate() {
            return this.selectedDate.toLocaleDateString('en-GB');
        }
    },
    methods: {
        changeMonth() {
            var date = new Date(this.year, this.monthId, 1);
            var dayOfWeek = date.getDay() + 1;
            var daysInMonth = new Date(this.year, this.monthId + 1, 0).getDate();
            this.days = {};

            for(var i = 1; i < dayOfWeek; i++) {
                if (this.days[i] === undefined)
                    this.days[i] = [];

                this.days[i].push('');
            }

            for(var i = 1; i <= daysInMonth; i++) {
                if (this.days[dayOfWeek] === undefined)
                    this.days[dayOfWeek] = [];

                this.days[dayOfWeek].push(i);

                dayOfWeek = dayOfWeek == 7 ? 1 : dayOfWeek + 1;
            }
        },
        addMonth() {
            if (this.monthId === 11) {
                this.monthId = 0;
                this.year++;
            } else {
                this.monthId++;
            }
            this.changeMonth();
        },
        subtractMonth() {
            if (this.monthId === 0) {
                this.monthId = 11;
                this.year--;
            } else {
                this.monthId--;
            }
            this.changeMonth();
        },

        rightArrowClick() {
            this.addMonth();
        },

        leftArrowClick() {
            this.subtractMonth();
        },

        showSelectedDate(day) {
            if (day !== "") {
                this.selectedDay = day;
                this.selectedDate = new Date(this.year, this.monthId, day);
            }
        },

        isDayActive(day) {
            return (day === this.selectedDay) && (this.selectedDate.getMonth() === this.monthId) && (this.selectedDate.getFullYear() === this.year);
        }
    }
}
</script>
