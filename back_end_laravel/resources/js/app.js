/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

// this validation ask confirm before delete records

const deleteButtons = document.querySelectorAll(".delete-post-form");

for (let i = 0; i < deleteButtons.length; i++) {
    let iteration = deleteButtons[i];

    // console.log("iterazione", iteration);

    iteration.addEventListener("submit", function(event) {
        const confirm = window.confirm("Are you sure to delete?");

        if (!confirm) {
            event.preventDefault();
        }
    });
}

// this validation ask confirm if save new record or not

const confirmCreate = document.querySelectorAll(".create-new");

for (let i = 0; i < confirmCreate.length; i++) {
    let iteration = confirmCreate[i];

    // console.log("iterazione", iteration);

    iteration.addEventListener("submit", function(event) {
        const confirm = window.confirm("Are you sure to save?");

        if (!confirm) {
            event.preventDefault();
        }
    });
}

// this validation ask confirm before update exist record

const confirmUpdate = document.querySelectorAll(".update-form");

for (let i = 0; i < confirmUpdate.length; i++) {
    let iteration = confirmUpdate[i];

    // console.log("iterazione", iteration);

    iteration.addEventListener("submit", function(event) {
        const confirm = window.confirm("Are you sure to update?");

        if (!confirm) {
            event.preventDefault();
        }
    });
}

// hide food edit message

const hideMessage = document.querySelectorAll(".radius");

const message = document.getElementById("message-visibility");

// console.log(message);

for (let i = 0; i < hideMessage.length; i++) {
    let iteration = hideMessage[i];

    // console.log("iterazione", iteration);

    iteration.addEventListener("click", function(event) {
        message.style.display = "none";
    });
}

// montly stats graph

const axios = require("axios");

let incassi = [
    // { months: "June 2021", sums: 100.2 },
    // { months: "July 2021", sums: 67.2 },
    // { months: "August 2021", sums: 18 }
];

let mesi = [];
let fatturato = [];

axios.get("http://127.0.0.1:8000/admin/orders/stats").then(res => {
    // console.log(res.data);
    incassi = res.data;

    incassi.forEach(element => {
        mesi.push(element.months);
    });
    incassi.forEach(element => {
        fatturato.push(element.sums);
    });
    // console.log(mesi);
    // console.log(fatturato);
    var ctx = document.getElementById("myChart").getContext("2d");

    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: mesi,
            datasets: [
                {
                    label: "€ Fatturato mensile",
                    data: fatturato,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
