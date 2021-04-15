<template>
    <div class="container">
        <div class="main">
            <div class="main-top">
                <img src="img/top.png" alt="">
            </div>
            <div class="main-left">
                <div class="main-title">
                    Запишитесь на тест-драйв<br>
                    новой Toyota Camry
                    <div class="steps">
                        <div class="steps-text">
                            <span v-bind:class="{'opacity-0': this.step <= 0}">Шаг {{ this.step }} из 3</span>
                        </div>
                        <div class="steps-progress" v-bind:class="{'opacity-0': this.step <= 0}">
                            <div class="steps-progress-value" v-bind:style="`width: ${this.step_progress}%`"></div>
                        </div>
                    </div>
                </div>
                <div class="main-left-content">
                    <transition name="fade">
                        <info-component v-if="this.step === 0 && this.allowAnimation" v-bind:step="this.step"
                                        @add-step="addStep"></info-component>
                        <div v-if="this.step > 0 && this.allowAnimation" class="form">
                            <div class="form-title">{{ titles[step] }}</div>
                            <div v-if="this.step === 1">
                                <div class="car-select">
                                    <label v-for="car in this.cars">
                                        <input type="radio" v-model="form.car" v-bind:value="car.id" name="car-select"
                                               @click="selectCar(car)">
                                        <div class="fake-radio"></div>
                                        <span>{{ car.name }}</span>
                                    </label>
                                </div>
                                <div class="car-info" v-if="currentCar.id">
                                    <p>Смешанный цикл (л/100 км) - <b>{{ this.currentCar.info_one }}</b></p>
                                    <p>Максимальная скорость - <b>{{ this.currentCar.info_two }}</b></p>
                                    <p>Время разгона 0-100 км/час - <b>{{ this.currentCar.info_three }}</b></p>
                                </div>
                            </div>
                            <div v-if="this.step === 2">
                                <div class="time-select">
                                    <label class="time" v-for="time in times"
                                           v-bind:class="{'disabled' : time.booked === '1'}">
                                        <input type="radio" name="select-time" v-bind:value="time.id"
                                               v-model="form.time" @change="selected_time_name = time.name" v-if="time.booked !== '1'">
                                        <div class="fake-radio-tab">
                                            {{ time.name }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div v-if="this.step === 3">
                                <div class="form-final">
                                    <label>
                                        <span>Фамилия<sup>*</sup></span>
                                        <input type="text" name="last_name" placeholder="Иванов"
                                               v-model="form.user_data.last_name">
                                    </label>
                                    <label>
                                        <span>Имя<sup>*</sup></span>
                                        <input type="text" name="name" placeholder="Иван" v-model="form.user_data.name">
                                    </label>
                                    <label>
                                        <span>Телефон<sup>*</sup></span>
                                        <input type="text" name="phone" placeholder="+7(___)___-__-__"
                                               v-model="form.user_data.phone">
                                    </label>
                                    <label>
                                        <span>E-mail<sup>*</sup></span>
                                        <input type="email" name="email" placeholder="example@newcamry.ru"
                                               v-model="form.user_data.email">
                                    </label>
                                </div>
                            </div>

                            <div class="form-buttons">
                                <div class="btn btn-outline-light"
                                     @click="removeStep">Назад
                                </div>
                                <div class="btn btn-danger"
                                     @click="addStep" v-if="step < 3">Далее
                                </div>
                                <div class="btn btn-danger"
                                     @click="submit" v-if="step >= 3">Подтвердить
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="main-right">
                <img src="img/car_cropped.png" alt="">
            </div>
        </div>
        <transition name="slide-fade">
            <div class="done-modal-overflow" v-if="done">
                <div class="done-modal">
                    <div class="modal-title">Почти готово...</div>
                    <div class="modal-text">
                        Осталось только подтвердить почту. Сделайте это в течении 15 минут, иначе бронь будет отменена.
                    </div>
                    <div class="modal-info">
                        <div class="modal-info-item">
                            <div class="modal-info-title">
                                Время
                            </div>
                            <div class="modal-info-info">{{ selected_time_name }}</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-title">
                                Дата
                            </div>
                            <div class="modal-info-info">24 апреля 2021 года</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-title">
                                Адрес
                            </div>
                            <div class="modal-info-info">г. Тамбов, ул. Киквидзе 69а</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="done-modal-overflow" v-if="error">
                <div class="done-modal done-modal--small">
                    <div class="modal-title">Ошибка! :(</div>
                    <div class="modal-text">
                        {{ error_text }}
                    </div>
                </div>
            </div>
        </transition>

    </div>
</template>

<script>
import InfoComponent from "./infoComponent";
import TimeComponent from "./timeComponent";

export default {
    components: {TimeComponent, InfoComponent},
    data: () => ({
        step: 0,
        form: {
            car: null,
            time: null,
            user_data: {
                name: null,
                last_name: null,
                phone: null,
                email: null,
            }
        },
        allowAnimation: true,
        cars: {},
        currentCar: {},
        times: {},
        titles: {
            1: 'Выберите объем двигателя',
            2: 'Выберите время',
            3: 'Заполните форму'
        },
        done: false,
        error: false,
        error_text: null,
        selected_time_name: null,
    }),
    mounted() {
        axios.get('/api/cars', {}).then(res => {
            this.cars = res.data;
        })
    },
    methods: {
        addStep() {
            if (!this.checker()) {

            } else {
                this.allowAnimation = false;
                this.step++;
                setTimeout(() => this.allowAnimation = true, 500);
                if (this.step === 2) {
                    axios.post('/api/times', {
                        body: this.currentCar
                    }).then(res => {
                        this.times = res.data;
                    })
                }
            }
        },
        removeStep() {
            this.allowAnimation = false;
            this.step--;
            setTimeout(() => this.allowAnimation = true, 500);
        },
        selectCar(car) {
            this.currentCar = car;
        },
        checker() {
            let name = this.form.user_data.name,
                last_name = this.form.user_data.last_name,
                phone = this.form.user_data.phone,
                email = this.form.user_data.email;

            let ok_input = true;
            if (!name || !last_name || !phone || !email)
                ok_input = false;
            if (this.step === 0) {
                return true;
            }
            return !(this.step === 1 && this.form.car === null ||
                this.step === 2 && this.form.time === null ||
                this.step === 3 && !ok_input);

        },
        submit() {
            let form_check = true;
            for (let i in this.form.user_data) {
                let data = this.form.user_data[i];
                if (!data) {
                    let error_field = document.querySelector(`input[name=${i}]`);
                    error_field.classList.add('error');
                    setTimeout(() => error_field.classList.remove('error'), 300);
                    form_check = false;
                } else {
                    form_check = true;
                }
            }
            if (form_check) {
                axios.post('/api/apply', {
                    body: this.form
                }).then(res => {
                    if (res.data.status === 'ok')
                        this.done = true;
                    else
                        this.error = true;
                }).catch(error => {
                });
            }
        }
    },
    computed: {
        step_progress: function () {
            return this.step * 33.33;
        },
    }
}
</script>

<style scoped>

.fade-enter-active, .fade-leave-active {
    transition: .3s all ease-in-out;
}

.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
{
    opacity: 0;
}

.slide-fade-enter-active {
    transition: all .3s ease;
}

.slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active до версии 2.1.8 */
{
    transform: translateX(10px);
    opacity: 0;
}

</style>
