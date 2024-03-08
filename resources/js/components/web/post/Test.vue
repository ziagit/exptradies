<template>
  <div>
    <ul>
        <li v-for="step in service.steps" :key="step.id" @click="selectStep(step)">
            {{ step.title }} <br>
            <TestOption :options="step.options" stepId:step.id></TestOption>
        </li>
    </ul>
  </div>
</template>
<script>
import localData from "../../shared/services/localData";
import TestOption from "./TestOption.vue";

export default{
    data: () => ({
        stepNumber:1,
        service: {
            id: 1,
            title: 'Cleaning',
            steps: [
                {
                    id: 1,
                    title: 'Service types',
                    options: [
                        {
                            id: 1,
                            title: 'House',
                            suboptions: [
                                {
                                    id: 1,
                                    title: 'Inside'
                                },
                                {
                                    id: 2,
                                    title: 'Outside'
                                }
                            ]
                        },
                        {
                            id: 2,
                            title: 'Office',
                            suboptions: [
                                {
                                    id: 1,
                                    title: 'Two desks'
                                },
                                {
                                    id: 2,
                                    title: 'Three desks'
                                }
                            ]
                        }
                    ]
                },
                {
                    id: 1,
                    title: 'Date',
                    options: [
                        {
                            id: 1,
                            title: 'Today',
                            suboptions: [
                                {
                                    id: 1,
                                    title: '09:00'
                                },
                                {
                                    id: 2,
                                    title: '10:00'
                                }
                            ]
                        },
                        {
                            id: 2,
                            title: 'Tomorrow',
                            suboptions: [
                                {
                                    id: 1,
                                    title: '09:00'
                                },
                                {
                                    id: 2,
                                    title: '10:00'
                                }
                            ]
                        }
                    ]
                },
                {
                    id: 1,
                    title: 'Cost',
                    options: [
                        {
                            id: 1,
                            title: '1000.0',
                        },
                        {
                            id: 2,
                            title: '12000.0',
                        }
                    ]
                },
            ]
        }
    }),
    methods: {
        back() {
            localData.save("prev-route", "contact");
            this.$router.back();
        }
    },
    components: { TestOption }
}
</script>
<style scoped>
li{
    background: red;
}
</style>