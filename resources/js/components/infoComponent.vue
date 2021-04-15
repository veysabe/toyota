<template>
    <div class="info-block">
        <div class="info-block-text">
            Обновленная Toyota Camry — это качественно новое воплощение самых передовых технологий и премиального
            комфорта. Стильный дизайн
            с динамичными линиями кузова, модульная архитектура TNGA¹
            и современное техническое оснащение — легендарный бизнес-седан вдохновляет на успех как на дороге, так и
            в
            жизни.
        </div>
        <div class="info-block-text">
            Новые мощные двигатели объемом 2 литра (150 л.с.) и 2,5 литра (200 л.с.) эффективно работают на бензине
            АИ92
            без потери характеристик
            и снижения ресурса, позволяя экономить на каждой заправке. Новое сочетание двигателя 2,5 л с
            8‑ступенчатой
            коробкой передач обеспечивают более мягкое и быстрое переключение, демонстрируя впечатляющую динамику и
            снижая расходы на топливо.
            <div class="info-block-mini-text mt-3 mb-1">
                ¹ TNGA (Toyota New Global Architecture) — Тойота Нью Глобал Архитектур
            </div>
        </div>
        <div class="button-container">
            <div class="btn btn-danger" @click="addStep()">Записаться на тест-драйв</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['step'],
    name: "infoComponent",
    methods: {
        addStep() {
            this.$emit('add-step')
        }
    }
}
</script>

<style scoped>

</style>
