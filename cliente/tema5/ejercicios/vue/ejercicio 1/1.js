new Vue({
    el: '#app',
    data: {
        images: [
            'https://www.ngenespanol.com/wp-content/uploads/2023/12/descubren-que-los-humanos-influimos-en-el-color-de-ojos-de-los-perros-770x431.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTDQDWLkiuEw4WbThYeFfWgyXOOP42PoWOMqYswh2Bq1gBzpyCOBe3YXX3lKOVcK6bFM0&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVuFAxpmo9er2e5oPCzy4SqUpl1gSWaxJukZLEA7cER_nQ_LgsnWqIexc4WOdUhhGsvx0&usqp=CAU'
        ],
        currentImage: 'https://www.ngenespanol.com/wp-content/uploads/2023/12/descubren-que-los-humanos-influimos-en-el-color-de-ojos-de-los-perros-770x431.jpg'
    },
    methods: {
        changeImage() {
            const randomIndex = Math.floor(Math.random() * this.images.length);
            this.currentImage = this.images[randomIndex];
        }
    }
});